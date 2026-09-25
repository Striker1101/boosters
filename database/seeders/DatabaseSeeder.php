<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\Log;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create the default admin and super admin accounts
        $this->call(AdminUsersSeeder::class);

        // Create tags with matching image URLs
        $tags = [
            ['name' => 'facebook', 'image' => 'images/facebook_1.png'],
            ['name' => 'instagram', 'image' => 'images/instagram_1.png'],
            ['name' => 'twitter', 'image' => 'images/twitter_1.png'],
            ['name' => 'tiktok', 'image' => 'images/tictok_1.png'],
            ['name' => 'youtube', 'image' => 'images/youtube_1.png'],
            ['name' => 'telegram', 'image' => 'images/telegram_1.png'],
            ['name' => 'linkedin', 'image' => 'images/linkedin_1.png'],
            ['name' => 'spotify', 'image' => 'images/spotify_2.png'],
            ['name' => 'twitch', 'image' => 'images/twitch_1.png'],
            ['name' => 'pinterest', 'image' => 'images/pinterest_1.png'],
            ['name' => 'threads', 'image' => 'images/threads_1.png'],
        ];

        foreach ($tags as $tagData) {
            Tag::firstOrCreate(['name' => $tagData['name']], $tagData);
        }

        // Seed logs
        Log::factory(20)->create();
    }
}
