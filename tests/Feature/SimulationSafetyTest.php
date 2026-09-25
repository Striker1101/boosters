<?php

namespace Tests\Feature;

use App\Models\Campaign;
use App\Models\CampaignTarget;
use App\Models\SimulationEvent;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

/**
 * These tests pin down the safety properties of the platform. If any of them
 * starts failing, the tool has become able to capture credentials and must not
 * be deployed.
 */
class SimulationSafetyTest extends TestCase
{
    use RefreshDatabase;

    private const SECRET = 'CorrectHorseBatteryStaple!42';

    private const TYPED_EMAIL = 'typed-into-the-form@example.com';

    private function superAdmin(): User
    {
        return User::factory()->create([
            'role' => User::ROLE_SUPER_ADMIN,
            'email_verified_at' => now(),
        ]);
    }

    private function activeCampaign(User $owner): Campaign
    {
        return Campaign::create([
            'user_id' => $owner->getKey(),
            'name' => 'Test campaign',
            'slug' => 'test-campaign',
            'platform' => 'social',
            'status' => 'active',
            'authorized_by' => 'Test Authorizer',
            'authorized_email' => 'authorizer@example.com',
            'authorization_ref' => 'REF-1',
            'scope' => 'A scope long enough to satisfy the minimum length rule.',
            'authorized_at' => now(),
            'authorization_expires_at' => now()->addMonth(),
        ]);
    }

    public function test_no_table_can_store_a_submitted_password(): void
    {
        $this->assertFalse(
            Schema::hasColumn('logs', 'password'),
            'The legacy password column must stay dropped.'
        );

        // Guard the new tables too: an email or password column appearing here
        // would mean the simulation had turned into a credential harvester.
        foreach (['campaign_targets', 'simulation_events'] as $table) {
            $this->assertFalse(Schema::hasColumn($table, 'password'));
            $this->assertFalse(Schema::hasColumn($table, 'submitted_password'));
        }
    }

    public function test_a_submitted_password_is_never_persisted_anywhere(): void
    {
        $owner = $this->superAdmin();
        $campaign = $this->activeCampaign($owner);
        $target = $campaign->targets()->create([
            'name' => 'Participant',
            'email' => 'participant@example.com',
        ]);

        $response = $this->post(route('simulation.submit', [
            'campaign' => $campaign->slug,
            't' => $target->token,
        ]), [
            // Even if a future edit starts POSTing these, they must be dropped.
            'password' => self::SECRET,
            'password_entered' => '1',
            'email' => self::TYPED_EMAIL,
        ]);

        // Straight to the debrief. No second attempt, no password re-prompt.
        $response->assertRedirect(route('simulation.debrief', [
            'campaign' => $campaign->slug,
            't' => $target->token,
        ]));

        // Submission is recorded as a boolean, and the value itself is absent
        // from every row of every table in the database.
        $this->assertNotNull($target->fresh()->submitted_at);

        $event = SimulationEvent::where('event_type', SimulationEvent::SUBMITTED)->firstOrFail();
        $this->assertSame(1, $event->meta['field_count']);

        $dump = $this->dumpEveryTable();

        $this->assertStringNotContainsString(self::SECRET, $dump);
        // The address typed into the form is not kept; only the address the
        // participant was enrolled under legitimately exists.
        $this->assertStringNotContainsString(self::TYPED_EMAIL, $dump);
        $this->assertStringContainsString('participant@example.com', $dump);
    }

    public function test_the_simulated_form_does_not_submit_the_credential_fields(): void
    {
        $owner = $this->superAdmin();
        $campaign = $this->activeCampaign($owner);
        $target = $campaign->targets()->create([
            'name' => 'Participant',
            'email' => 'participant@example.com',
        ]);

        $html = $this->get(route('simulation.login', [
            'campaign' => $campaign->slug,
            't' => $target->token,
        ]))->assertOk()->getContent();

        // The password input must carry no name attribute, so the browser never
        // transmits what the participant types.
        $this->assertMatchesRegularExpression(
            '/<input[^>]*id="pw"[^>]*>/',
            $html,
            'The simulated password input should be present.'
        );

        preg_match('/<input[^>]*id="pw"[^>]*>/', $html, $matches);
        $this->assertStringNotContainsString('name=', $matches[0]);

        preg_match('/<input[^>]*id="contact"[^>]*>/', $html, $matches);
        $this->assertStringNotContainsString('name=', $matches[0]);
    }

    public function test_a_lure_is_not_served_without_an_enrolled_participant_token(): void
    {
        $owner = $this->superAdmin();
        $campaign = $this->activeCampaign($owner);

        // No token at all.
        $this->get(route('simulation.lure', $campaign->slug))->assertNotFound();

        // A made-up token.
        $this->get(route('simulation.lure', ['campaign' => $campaign->slug, 't' => 'not-a-real-token']))
            ->assertNotFound();

        // A real token belonging to a different campaign.
        $other = Campaign::create([
            'user_id' => $owner->getKey(),
            'name' => 'Other',
            'slug' => 'other-campaign',
            'platform' => 'generic',
            'status' => 'active',
            'authorized_by' => 'A',
            'authorized_email' => 'a@example.com',
            'authorization_ref' => 'R',
            'scope' => 'A scope long enough to satisfy the minimum length rule.',
            'authorized_at' => now(),
        ]);
        $foreign = $other->targets()->create(['name' => 'X', 'email' => 'x@example.com']);

        $this->get(route('simulation.lure', ['campaign' => $campaign->slug, 't' => $foreign->token]))
            ->assertNotFound();
    }

    public function test_a_paused_campaign_stops_serving_lures(): void
    {
        $owner = $this->superAdmin();
        $campaign = $this->activeCampaign($owner);
        $target = $campaign->targets()->create([
            'name' => 'Participant',
            'email' => 'participant@example.com',
        ]);

        $url = route('simulation.lure', ['campaign' => $campaign->slug, 't' => $target->token]);
        $this->get($url)->assertOk();

        $campaign->update(['status' => 'paused']);

        $this->get($url)->assertNotFound();

        // Someone who already took part can still reach the debrief.
        $this->get(route('simulation.debrief', ['campaign' => $campaign->slug, 't' => $target->token]))
            ->assertOk();
    }

    public function test_a_campaign_without_a_current_authorization_cannot_be_activated(): void
    {
        $owner = $this->superAdmin();

        $campaign = Campaign::create([
            'user_id' => $owner->getKey(),
            'name' => 'Unauthorized',
            'slug' => 'unauthorized',
            'platform' => 'generic',
            'status' => 'draft',
        ]);

        $this->assertFalse($campaign->isAuthorized());

        $this->actingAs($owner)
            ->patch(route('campaigns.status', $campaign), ['status' => 'active'])
            ->assertSessionHasErrors('status');

        $this->assertSame('draft', $campaign->fresh()->status);
    }

    public function test_an_expired_authorization_blocks_activation(): void
    {
        $owner = $this->superAdmin();
        $campaign = $this->activeCampaign($owner);
        $campaign->update(['authorization_expires_at' => now()->subDay(), 'status' => 'draft']);

        $this->assertFalse($campaign->fresh()->isAuthorized());

        $this->actingAs($owner)
            ->patch(route('campaigns.status', $campaign), ['status' => 'active'])
            ->assertSessionHasErrors('status');
    }

    public function test_guests_cannot_reach_the_console(): void
    {
        foreach (['/dashboard', '/campaigns/create', '/admins', '/tutorial'] as $path) {
            $this->get($path)->assertRedirect(route('login'));
        }
    }

    public function test_a_plain_admin_cannot_reach_staff_management(): void
    {
        $admin = User::factory()->create([
            'role' => User::ROLE_ADMIN,
            'email_verified_at' => now(),
        ]);

        $this->actingAs($admin)->get('/admins')->assertForbidden();
        $this->actingAs($admin)->get('/dashboard')->assertOk();
    }

    public function test_an_admin_cannot_open_another_admins_campaign(): void
    {
        $owner = $this->superAdmin();
        $campaign = $this->activeCampaign($owner);

        $other = User::factory()->create([
            'role' => User::ROLE_ADMIN,
            'email_verified_at' => now(),
        ]);

        $this->actingAs($other)
            ->get(route('campaigns.show', $campaign))
            ->assertForbidden();
    }

    public function test_every_user_gets_a_unique_tag(): void
    {
        $tags = collect(range(1, 12))
            ->map(fn () => User::factory()->create()->referral_code);

        $this->assertCount(12, $tags->unique());
        $this->assertNotContains(null, $tags->all());
    }

    /** Concatenate every value in every table into one string for leak checks. */
    private function dumpEveryTable(): string
    {
        $dump = '';

        foreach (DB::select('SHOW TABLES') as $row) {
            $table = array_values((array) $row)[0];

            foreach (DB::table($table)->get() as $record) {
                $dump .= json_encode((array) $record);
            }
        }

        return $dump;
    }
}
