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
        'referral_code',
        'referral_id',
        'referral_user_id',
        'role',
        'is_disabled',
    ];

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
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_disabled' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        // Every account gets a unique tag automatically. Admins use their tag
        // to identify the links they hand out, which is how engagement gets
        // attributed back to the admin who ran the campaign.
        static::creating(function (self $user) {
            if (blank($user->referral_code)) {
                $user->referral_code = static::generateTag();
            }

            if (blank($user->referral_id)) {
                $user->referral_id = $user->referral_code;
            }
        });
    }

    public static function generateTag(): string
    {
        do {
            $tag = strtoupper(Str::random(6));
        } while (static::where('referral_code', $tag)->exists());

        return $tag;
    }

    public function hasRole(string ...$roles): bool
    {
        $current = strtolower((string) $this->role);

        foreach ($roles as $role) {
            if ($current === strtolower($role)) {
                return true;
            }
        }

        return false;
    }

    public function hasAnyRole(string ...$roles): bool
    {
        return $this->hasRole(...$roles);
    }

    public function isSuperAdmin(): bool
    {
        return $this->hasRole(self::ROLE_SUPER_ADMIN);
    }

    /** Any staff member: a plain admin or a super admin. */
    public function isAdmin(): bool
    {
        return $this->hasRole(self::ROLE_ADMIN, self::ROLE_SUPER_ADMIN);
    }

    /** Campaigns this admin owns. */
    public function campaigns()
    {
        return $this->hasMany(Campaign::class);
    }

    /** Users this user referred. */
    public function referred_users()
    {
        return $this->hasMany(
            User::class,
            'referral_user_id', // foreign key on users table
            'id'                // local key
        );
    }

    /**
     * Legacy relation kept so older views keep resolving.
     */
    public function logs()
    {
        return $this->hasMany(
            Log::class,
            'referral_code_id', // logs.referral_code_id
            'referral_code'     // users.referral_code
        );
    }

    public function scopeStaff($query)
    {
        return $query->whereIn('role', [self::ROLE_ADMIN, self::ROLE_SUPER_ADMIN]);
    }
}
