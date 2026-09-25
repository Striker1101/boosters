<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * A participant enrolled in a campaign.
 *
 * A lure is only ever served when a valid per-participant token is present, so
 * the simulation cannot be pointed at someone who was not enrolled.
 */
class CampaignTarget extends Model
{
    use HasFactory;

    protected $fillable = [
        'campaign_id',
        'name',
        'email',
        'department',
        'token',
        'enrolled_at',
        'first_opened_at',
        'first_clicked_at',
        'submitted_at',
        'reported_at',
        'debrief_seen_at',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'enrolled_at' => 'datetime',
            'first_opened_at' => 'datetime',
            'first_clicked_at' => 'datetime',
            'submitted_at' => 'datetime',
            'reported_at' => 'datetime',
            'debrief_seen_at' => 'datetime',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (self $target) {
            $target->token ??= Str::random(48);
            $target->enrolled_at ??= now();
        });
    }

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function events()
    {
        return $this->hasMany(SimulationEvent::class);
    }

    /** Engagement status for the admin table. Never a submitted value. */
    public function statusLabel(): string
    {
        return match (true) {
            $this->reported_at !== null => 'Reported',
            $this->submitted_at !== null => 'Submitted data',
            $this->first_clicked_at !== null => 'Clicked',
            $this->first_opened_at !== null => 'Opened',
            default => 'Not engaged',
        };
    }
}
