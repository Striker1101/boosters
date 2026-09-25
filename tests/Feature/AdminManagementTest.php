<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminManagementTest extends TestCase
{
    use RefreshDatabase;

    private function makeUser(string $role, array $attributes = []): User
    {
        return User::factory()->create(array_merge([
            'role' => $role,
            'email_verified_at' => now(),
        ], $attributes));
    }

    public function test_guests_are_redirected_to_login(): void
    {
        $this->get('/admins')->assertRedirect('/login');
    }

    public function test_plain_admin_cannot_access_admins_screen(): void
    {
        $admin = $this->makeUser(User::ROLE_ADMIN);

        $this->actingAs($admin)->get('/admins')->assertForbidden();
    }

    public function test_super_admin_can_access_admins_screen(): void
    {
        $superAdmin = $this->makeUser(User::ROLE_SUPER_ADMIN);

        $this->actingAs($superAdmin)->get('/admins')->assertOk();
    }

    public function test_super_admin_can_access_admin_only_routes(): void
    {
        $superAdmin = $this->makeUser(User::ROLE_SUPER_ADMIN);

        $this->actingAs($superAdmin)->get('/user')->assertOk();
    }

    public function test_super_admin_can_create_an_admin(): void
    {
        $superAdmin = $this->makeUser(User::ROLE_SUPER_ADMIN);

        $response = $this->actingAs($superAdmin)->post('/admins', [
            'name' => 'New Admin',
            'email' => 'new-admin@example.com',
            'password' => 'secret123',
            'role' => User::ROLE_ADMIN,
        ]);

        $response->assertRedirect(route('admins.index'));

        $this->assertDatabaseHas('users', [
            'email' => 'new-admin@example.com',
            'role' => User::ROLE_ADMIN,
        ]);
    }

    public function test_super_admin_can_promote_an_admin(): void
    {
        $superAdmin = $this->makeUser(User::ROLE_SUPER_ADMIN);
        $admin = $this->makeUser(User::ROLE_ADMIN);

        $this->actingAs($superAdmin)
            ->patchJson("/admins/{$admin->id}/role", ['role' => User::ROLE_SUPER_ADMIN])
            ->assertOk()
            ->assertJson(['success' => true, 'role' => User::ROLE_SUPER_ADMIN]);

        $this->assertSame(User::ROLE_SUPER_ADMIN, $admin->fresh()->role);
    }

    public function test_super_admin_cannot_change_their_own_role(): void
    {
        $superAdmin = $this->makeUser(User::ROLE_SUPER_ADMIN);

        $this->actingAs($superAdmin)
            ->patchJson("/admins/{$superAdmin->id}/role", ['role' => User::ROLE_ADMIN])
            ->assertStatus(422);

        $this->assertSame(User::ROLE_SUPER_ADMIN, $superAdmin->fresh()->role);
    }

    public function test_super_admin_cannot_disable_their_own_account(): void
    {
        $superAdmin = $this->makeUser(User::ROLE_SUPER_ADMIN);

        $this->actingAs($superAdmin)
            ->patchJson("/admins/{$superAdmin->id}")
            ->assertStatus(422);

        $this->assertFalse((bool) $superAdmin->fresh()->is_disabled);
    }

    public function test_super_admin_can_disable_another_admin(): void
    {
        $superAdmin = $this->makeUser(User::ROLE_SUPER_ADMIN);
        $admin = $this->makeUser(User::ROLE_ADMIN);

        $this->actingAs($superAdmin)
            ->patchJson("/admins/{$admin->id}")
            ->assertOk()
            ->assertJson(['success' => true, 'is_disabled' => true]);

        $this->assertTrue((bool) $admin->fresh()->is_disabled);
    }

    public function test_super_admin_cannot_delete_themselves(): void
    {
        $superAdmin = $this->makeUser(User::ROLE_SUPER_ADMIN);

        $this->actingAs($superAdmin)
            ->delete("/admins/{$superAdmin->id}")
            ->assertRedirect(route('admins.index'));

        $this->assertDatabaseHas('users', ['id' => $superAdmin->id]);
    }

    public function test_super_admin_can_delete_another_admin(): void
    {
        $superAdmin = $this->makeUser(User::ROLE_SUPER_ADMIN);
        $admin = $this->makeUser(User::ROLE_ADMIN);

        $this->actingAs($superAdmin)
            ->delete("/admins/{$admin->id}")
            ->assertRedirect(route('admins.index'));

        $this->assertDatabaseMissing('users', ['id' => $admin->id]);
    }

    public function test_disabled_user_cannot_log_in(): void
    {
        $this->makeUser(User::ROLE_ADMIN, [
            'email' => 'disabled@example.com',
            'password' => bcrypt('password'),
            'is_disabled' => true,
        ]);

        $this->post('/login', [
            'email' => 'disabled@example.com',
            'password' => 'password',
        ])->assertSessionHasErrors('email');

        $this->assertGuest();
    }
}
