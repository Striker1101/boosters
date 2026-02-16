<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
         'referral_code',
    'referral_id',
    'referral_user_id',
    ];

     // Users this user referred
    public function referred_users()
    {
        return $this->hasMany(
            User::class,
            'referral_user_id', // foreign key on users table
            'id'                // local key
        );
    }

    // Logs related to this user via referral_code
    public function logs()
    {
        return $this->hasMany(
            Log::class,
            'referral_code_id', // logs.referral_code_id
            'referral_code'     // users.referral_code
        );
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
