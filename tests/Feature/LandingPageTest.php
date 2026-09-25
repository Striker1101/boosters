<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LandingPageTest extends TestCase
{
    use RefreshDatabase;

    /** The root URL is the one public page: no session required. */
    public function test_the_landing_page_is_public(): void
    {
        $this->get('/')->assertOk()->assertSee('Phishing simulations', false);
    }

    /** It advertises the service without exposing any operator surface. */
    public function test_the_landing_page_exposes_no_operator_functionality(): void
    {
        $response = $this->get('/');

        $response->assertOk();

        // No campaign data, no participant links, no admin table.
        $this->assertDatabaseCount('campaigns', 0);
        $response->assertDontSee('Sign out');
        $response->assertDontSee('/s/', false);
        $response->assertDontSee('name="_token"', false);
    }

    /** Signed-in staff get a route into the console. */
    public function test_signed_in_staff_see_a_link_to_the_console(): void
    {
        $admin = User::factory()->create([
            'role' => User::ROLE_ADMIN,
            'email_verified_at' => now(),
        ]);

        $this->actingAs($admin)
            ->get('/')
            ->assertOk()
            ->assertSee(route('dashboard'), false);
    }
}
