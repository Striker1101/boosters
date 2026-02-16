<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Tag;
use App\Models\Log;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin'),
            'referral_code'=> '0000',
            'referral_id'=> '0000',
            'referral_user_id' => '0000',
            'email_verified_at' => now(),
            'role' => 'admin',
        ]);

        // Create tags with matching image URLs
        $tags = [
            [
                'name' => 'facebook',
                'image' => 'https://www.pngkit.com/png/full/326-32651_facebook-twitter-instagram-icons-png-social-media-icons.png'
            ],
            [
                'name' => 'instagram',
                'image' => 'https://www.pngkit.com/png/full/326-32651_facebook-twitter-instagram-icons-png-social-media-icons.png'
            ],
            [
                'name' => 'twitter',
                'image' => 'https://www.pngkit.com/png/full/326-32651_facebook-twitter-instagram-icons-png-social-media-icons.png'
            ],
        ];

        foreach ($tags as $tagData) {
            Tag::create($tagData);
        }

        // Seed logs
        Log::factory(20)->create();
    }
}
