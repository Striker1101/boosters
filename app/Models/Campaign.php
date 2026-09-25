<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * A single authorized security-awareness simulation exercise.
 *
 * A campaign cannot run without a complete, current authorization record.
 * That is the control that keeps this tool scoped to people covered by an
 * approved exercise rather than usable against the general public.
 */
class Campaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'platform',
        'status',
        'authorized_by',
        'authorized_email',
        'authorization_ref',
        'scope',
        'authorized_at',
        'authorization_expires_at',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'authorized_at' => 'datetime',
            'authorization_expires_at' => 'datetime',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function targets()
    {
        return $this->hasMany(CampaignTarget::class);
    }

    public function events()
    {
        return $this->hasMany(SimulationEvent::class);
    }

    /** Has someone with authority signed this off, and is that sign-off current? */
    public function isAuthorized(): bool
    {
        if (blank($this->authorized_by) || blank($this->authorized_email) || blank($this->authorization_ref)) {
            return false;
        }

        if ($this->authorized_at === null) {
            return false;
        }

        return $this->authorization_expires_at === null
            || $this->authorization_expires_at->isFuture();
    }

    public function isActive(): bool
    {
        return $this->status === 'active' && $this->isAuthorized();
    }

    public function canBeActivated(): bool
    {
        return $this->isAuthorized();
    }

    /**
     * Aggregate results only. Individual participants are shown an engagement
     * status, never the contents of anything they typed.
     *
     * @return array<string, int|float>
     */
    public function metrics(): array
    {
        $total = $this->targets()->count();
        $opened = $this->targets()->whereNotNull('first_opened_at')->count();
        $clicked = $this->targets()->whereNotNull('first_clicked_at')->count();
        $submitted = $this->targets()->whereNotNull('submitted_at')->count();
        $reported = $this->targets()->whereNotNull('reported_at')->count();
        $debriefed = $this->targets()->whereNotNull('debrief_seen_at')->count();

        $percent = static fn (int $value): float => $total > 0 ? round($value / $total * 100, 1) : 0.0;

        return [
            'total' => $total,
            'opened' => $opened,
            'clicked' => $clicked,
            'submitted' => $submitted,
            'reported' => $reported,
            'debriefed' => $debriefed,
            'open_rate' => $percent($opened),
            'click_rate' => $percent($clicked),
            'submit_rate' => $percent($submitted),
            'report_rate' => $percent($reported),
            'debrief_rate' => $percent($debriefed),
            // Higher is better: participants who did NOT hand anything over,
            // plus those who went further and reported the attempt.
            'resilience' => $percent(($total - $submitted) + $reported),
        ];
    }

    /** The per-participant link an admin copies out of the dashboard. */
    public function linkFor(CampaignTarget $target): string
    {
        return route('simulation.lure', [
            'campaign' => $this->slug,
            't' => $target->token,
        ]);
    }

    public function baseLink(): string
    {
        return route('simulation.lure', ['campaign' => $this->slug]);
    }
}
