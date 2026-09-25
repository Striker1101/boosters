<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;


class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    public const ROLE_CUSTOMER = 'customer';
    public const ROLE_USER = 'user';
    public const ROLE_ADMIN = 'admin';
    public const ROLE_SUPER_ADMIN = 'super_admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'ref_id',
        'referral_code',
        'referral_id',
        'referral_user_id',
    ];

    /**
     * Whether the user has the super admin role.
     */
    public function isSuperAdmin(): bool
    {
        return $this->role === self::ROLE_SUPER_ADMIN;
    }

    /**
     * Whether the user has admin access (admin or super admin).
     */
    public function isAdmin(): bool
    {
        return in_array($this->role, [self::ROLE_ADMIN, self::ROLE_SUPER_ADMIN], true);
    }

    /**
     * Whether the account has been disabled.
     */
    public function isDisabled(): bool
    {
        return (bool) $this->is_disabled;
    }

    /**
     * Build a unique, URL friendly ref id (e.g. "34a-890-asw").
     */
    public static function generateRefId(): string
    {
        do {
            $refId = strtolower(Str::random(3)) . '-' . random_int(100, 999) . '-' . strtolower(Str::random(3));
        } while (static::where('ref_id', $refId)->exists());

        return $refId;
    }

    /**
     * The shareable catalog link that attributes attempts to this user.
     */
    public function refLink(): ?string
    {
        if (empty($this->ref_id)) {
            return null;
        }

        return url('/') . '?ref_id=' . urlencode($this->ref_id);
    }

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
     * Give new admins a ref id automatically so attempts can be attributed.
     */
    protected static function booted(): void
    {
        static::creating(function (User $user) {
            if ($user->isAdmin() && empty($user->ref_id)) {
                $user->ref_id = self::generateRefId();
            }
        });
    }

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
