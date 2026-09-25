<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PlatformServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_platform_services_screen(): void
    {
        $response = $this->get('/platform-services');
        $response->assertRedirect('/login');
    }

    public function test_authenticated_admin_can_access_platform_services_screen(): void
    {
        $admin = User::factory()->create([
            'role'   => 'admin',
            'ref_id' => 'adm-123-xyz',
        ]);

        $response = $this->actingAs($admin)->get('/platform-services');
        $response->assertOk();
        $response->assertSee('Platform & Service Links', false);
        $response->assertSee('adm-123-xyz');
        $response->assertSee('Copy Link');
    }

    public function test_home_page_renders_with_ref_id_and_service_params(): void
    {
        $response = $this->get('/home?ref_id=adm-123-xyz&platform=facebook&service=facebook-likes');
        $response->assertOk();
        $response->assertSee('ref_id_input');
        $response->assertSee('highlighted-card');
        $response->assertSee('offer-facebook-likes');
    }
}
