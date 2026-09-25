<?php

namespace Database\Seeders;

use App\Models\Campaign;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // A super admin approves authorizations and activates campaigns.
        $superAdmin = User::firstOrCreate(
            ['email' => 'owner@example.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
                'role' => User::ROLE_SUPER_ADMIN,
                'referral_code' => 'OWNER1',
                'referral_id' => 'OWNER1',
                'email_verified_at' => now(),
            ]
        );

        // A plain admin runs campaigns and sees only their own results.
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
                'role' => User::ROLE_ADMIN,
                'referral_code' => 'ADMIN1',
                'referral_id' => 'ADMIN1',
                'email_verified_at' => now(),
            ]
        );

        // Legacy service categories. The simulation module uses the lure themes
        // in config/lures.php instead.
        foreach (['facebook', 'instagram', 'twitter'] as $name) {
            Tag::firstOrCreate(['name' => $name]);
        }

        $this->seedDemoCampaign($admin);
    }

    /**
     * A fully authorized, active demo campaign so the whole funnel can be walked
     * immediately after seeding. Delete it before running a real exercise.
     */
    private function seedDemoCampaign(User $admin): void
    {
        $campaign = Campaign::firstOrCreate(
            ['slug' => 'demo-awareness-campaign'],
            [
                'user_id' => $admin->getKey(),
                'name' => 'Demo awareness campaign',
                'platform' => 'social',
                'status' => 'active',
                'authorized_by' => 'Super Admin (owner@example.com)',
                'authorized_email' => 'owner@example.com',
                'authorization_ref' => 'DEMO-0001',
                'scope' => 'Demonstration campaign seeded for local development. It exists so you can walk the '
                    .'participant funnel end to end. Remove it before running a real exercise against real people.',
                'authorized_at' => now(),
                'authorization_expires_at' => now()->addYear(),
            ]
        );

        if ($campaign->targets()->exists()) {
            return;
        }

        foreach ([
            ['name' => 'Demo Participant One', 'email' => 'participant.one@example.com', 'department' => 'Finance'],
            ['name' => 'Demo Participant Two', 'email' => 'participant.two@example.com', 'department' => 'Sales'],
            ['name' => 'Demo Participant Three', 'email' => 'participant.three@example.com', 'department' => 'Support'],
        ] as $participant) {
            $campaign->targets()->create([
                ...$participant,
                'token' => Str::random(48),
                'enrolled_at' => now(),
            ]);
        }
    }
}
