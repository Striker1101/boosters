<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\CampaignTarget;
use App\Models\SimulationEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CampaignTargetController extends Controller
{
    /** Enroll a single participant. */
    public function store(Request $request, Campaign $campaign)
    {
        $this->authorizeCampaign($request, $campaign);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:190'],
            'department' => ['nullable', 'string', 'max:120'],
        ]);

        $campaign->targets()->create([
            ...$data,
            'token' => Str::random(48),
            'enrolled_at' => now(),
        ]);

        SimulationEvent::record($campaign, null, SimulationEvent::SENT, $request, ['surface' => 'enrolment']);

        return back()->with('success', "{$data['name']} enrolled.");
    }

    /**
     * Bulk-enroll participants from a pasted list.
     *
     * Accepts one participant per line as `Name <email>` or a bare email.
     */
    public function import(Request $request, Campaign $campaign)
    {
        $this->authorizeCampaign($request, $campaign);

        $request->validate([
            'participants' => ['required', 'string', 'max:20000'],
        ]);

        $created = 0;
        $skipped = 0;

        foreach (preg_split('/\r\n|\r|\n/', (string) $request->input('participants')) as $line) {
            $line = trim($line);

            if ($line === '') {
                continue;
            }

            if (preg_match('/^(.*)<([^>]+)>$/', $line, $matches)) {
                $name = trim($matches[1], " \t\"'");
                $email = trim($matches[2]);
            } else {
                $email = $line;
                $name = Str::before($email, '@');
            }

            if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $skipped++;

                continue;
            }

            $exists = $campaign->targets()->where('email', $email)->exists();

            if ($exists) {
                $skipped++;

                continue;
            }

            $campaign->targets()->create([
                'name' => $name !== '' ? $name : Str::before($email, '@'),
                'email' => $email,
                'token' => Str::random(48),
                'enrolled_at' => now(),
            ]);

            $created++;
        }

        SimulationEvent::record($campaign, null, SimulationEvent::SENT, $request, [
            'surface' => 'enrolment',
            'field_count' => $created,
        ]);

        return back()->with('success', "{$created} participant(s) enrolled, {$skipped} skipped.");
    }

    public function destroy(Request $request, Campaign $campaign, CampaignTarget $target)
    {
        $this->authorizeCampaign($request, $campaign);

        abort_unless($target->campaign_id === $campaign->getKey(), 404);

        $target->delete();

        return back()->with('success', 'Participant removed.');
    }

    private function authorizeCampaign(Request $request, Campaign $campaign): void
    {
        $user = $request->user();

        if (! $user->isSuperAdmin() && $campaign->user_id !== $user->getKey()) {
            abort(403, 'This campaign belongs to another admin.');
        }
    }
}
