<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUsersSeeder extends Seeder
{
    /**
     * Seed the default admin and super admin accounts.
     */
    public function run(): void
    {
        // Default admin
        $this->seedAdmin('admin@example.com', [
            'name' => 'admin',
            'password' => Hash::make('admin'),
            'referral_code' => '0000',
            'referral_id' => '0000',
            'referral_user_id' => '0000',
            'role' => User::ROLE_ADMIN,
        ]);

        // Default super admin
        $this->seedAdmin('super_admin@example.com', [
            'name' => 'super_admin',
            'password' => Hash::make('admin'),
            'role' => User::ROLE_SUPER_ADMIN,
        ]);
    }

    /**
     * Create or update an admin and make sure it owns a ref id.
     */
    private function seedAdmin(string $email, array $attributes): void
    {
        $user = User::updateOrCreate(
            ['email' => $email],
            array_merge($attributes, ['email_verified_at' => now()])
        );

        // Never overwrite an existing ref id, so shared links keep working.
        if (empty($user->ref_id)) {
            $user->ref_id = User::generateRefId();
            $user->save();
        }
    }
}
