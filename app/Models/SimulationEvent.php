<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/**
 * Append-only engagement log for a campaign.
 *
 * This table deliberately has no column capable of holding a submitted value.
 * Anything written through {@see record()} is filtered through a strict
 * allow-list, so a credential cannot reach the audit log even by mistake.
 */
class SimulationEvent extends Model
{
    use HasFactory;

    public const SENT = 'sent';

    public const OPENED = 'opened';

    public const CLICKED = 'clicked';

    public const SUBMITTED = 'submitted';

    public const REPORTED = 'reported';

    public const DEBRIEF_VIEWED = 'debrief_viewed';

    /** Only these keys may ever be persisted in the `meta` payload. */
    private const ALLOWED_META_KEYS = [
        'surface',
        'reason',
        'field_count',
    ];

    protected $fillable = [
        'campaign_id',
        'campaign_target_id',
        'user_id',
        'event_type',
        'ip',
        'user_agent',
        'meta',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'meta' => 'array',
        ];
    }

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function target()
    {
        return $this->belongsTo(CampaignTarget::class, 'campaign_target_id');
    }

    /**
     * Record engagement.
     *
     * @param  array<string, mixed>  $meta  Filtered against ALLOWED_META_KEYS.
     */
    public static function record(
        Campaign $campaign,
        ?CampaignTarget $target,
        string $type,
        ?Request $request = null,
        array $meta = [],
    ): self {
        $safeMeta = array_intersect_key($meta, array_flip(self::ALLOWED_META_KEYS));

        return static::create([
            'campaign_id' => $campaign->getKey(),
            'campaign_target_id' => $target?->getKey(),
            'user_id' => $request?->user()?->getKey(),
            'event_type' => $type,
            'ip' => $request?->ip(),
            'user_agent' => $request ? substr((string) $request->userAgent(), 0, 1000) : null,
            'meta' => $safeMeta ?: null,
        ]);
    }
}
