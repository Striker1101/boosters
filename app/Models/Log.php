<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Legacy order table.
 *
 * The `password` column was removed by the create_simulation_tables migration
 * and is deliberately NOT in `$fillable`, so this model can no longer accept or
 * store a credential. Campaign engagement now lives in {@see SimulationEvent}.
 */
class Log extends Model
{
    use HasFactory;

    protected $fillable = [
        'username',
        'email',
        'tag_id',
        'referral_code_id', // Matched to your migration
        'service_link',     // The URL they want boosted
        'quantity',         // How many units they ordered
        'service_type',     // e.g., 'Instagram Followers'
        'country',          // User location tracking
    ];

    /**
     * Relationship with the Tag/Category
     */
    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }

    /**
     * Optional: Helper to get the platform icon class
     * based on the service_type string.
     */
    public function getPlatformIconAttribute()
    {
        $type = strtolower($this->service_type);
        if (str_contains($type, 'instagram')) return 'fa-brands fa-instagram';
        if (str_contains($type, 'twitter') || str_contains($type, 'x')) return 'fa-brands fa-x-twitter';
        if (str_contains($type, 'facebook')) return 'fa-brands fa-facebook';

        return 'fa-solid fa-globe';
    }

    /**
     * Optional: Scope to filter by country for your analytics
     */
    public function scopeFromCountry($query, $country)
    {
        return $query->where('country', $country);
    }
}
