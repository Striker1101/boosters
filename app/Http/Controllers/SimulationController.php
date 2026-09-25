<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\CampaignTarget;
use App\Models\SimulationEvent;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Public-facing side of a simulation exercise.
 *
 * Three rules hold everywhere in this class:
 *
 *  1. A lure is only served to a participant who was explicitly enrolled, via
 *     their unguessable token, and only while the campaign is active.
 *  2. A value typed into the simulated form is read solely to determine
 *     *whether* the field was filled in. It is removed from the request before
 *     anything else happens and is never written to a model, a log or a view.
 *  3. The participant is sent straight to a debrief that tells them the page
 *     was a simulation. There is no "retry your password" step anywhere.
 */
class SimulationController extends Controller
{
    public function lure(Request $request, Campaign $campaign): Response
    {
        [$target, $preview] = $this->resolve($request, $campaign, requireActive: true);

        if (! $target && ! $preview) {
            return $this->unavailable();
        }

        if ($target && $target->first_opened_at === null) {
            $target->forceFill(['first_opened_at' => now()])->save();

            SimulationEvent::record($campaign, $target, SimulationEvent::OPENED, $request, [
                'surface' => 'lure',
            ]);
        }

        return response()->view('simulation.lure', [
            'campaign' => $campaign,
            'target' => $target,
            'preview' => $preview,
            'lure' => $this->theme($campaign),
        ]);
    }

    public function login(Request $request, Campaign $campaign): Response
    {
        [$target, $preview] = $this->resolve($request, $campaign, requireActive: true);

        if (! $target && ! $preview) {
            return $this->unavailable();
        }

        if ($target && $target->first_clicked_at === null) {
            $target->forceFill(['first_clicked_at' => now()])->save();

            SimulationEvent::record($campaign, $target, SimulationEvent::CLICKED, $request, [
                'surface' => 'lure',
            ]);
        }

        return response()->view('simulation.login', [
            'campaign' => $campaign,
            'target' => $target,
            'preview' => $preview,
            'lure' => $this->theme($campaign),
        ]);
    }

    /**
     * Handle the simulated sign-in.
     *
     * The form's credential inputs carry no `name` attribute, so the browser
     * never puts their values in the request body: a typed password does not
     * leave the participant's device. All we receive is `password_entered`, a
     * boolean flag the page sets locally.
     *
     * The scrubbing below is defence in depth. If a future edit ever gives
     * those inputs a name, the values are removed from the request before any
     * other code runs and are still never persisted.
     */
    public function submit(Request $request, Campaign $campaign)
    {
        [$target, $preview] = $this->resolve($request, $campaign, requireActive: true);

        if (! $target && ! $preview) {
            return $this->unavailable();
        }

        // --- credential discard boundary -------------------------------------
        // Read presence only. Never assign these values to anything.
        $passwordWasFilled = $request->boolean('password_entered')
            || filled($request->input('password'));

        foreach (['password', 'password_entered', 'email', 'contact', 'username'] as $field) {
            $request->request->remove($field);
        }
        // ---------------------------------------------------------------------

        if ($target) {
            if ($target->submitted_at === null) {
                $target->forceFill(['submitted_at' => now()])->save();
            }

            SimulationEvent::record($campaign, $target, SimulationEvent::SUBMITTED, $request, [
                'surface' => 'login',
                'field_count' => $passwordWasFilled ? 1 : 0,
            ]);
        }

        return redirect()->route('simulation.debrief', array_filter([
            'campaign' => $campaign->slug,
            't' => $target?->token,
            'preview' => $preview ? 1 : null,
        ]));
    }

    /**
     * The immediate teachable moment. Reachable for any enrolled participant
     * even if the campaign has since been paused.
     */
    public function debrief(Request $request, Campaign $campaign): Response
    {
        [$target, $preview] = $this->resolve($request, $campaign, requireActive: false);

        if (! $target && ! $preview) {
            return $this->unavailable();
        }

        if ($target) {
            if ($target->debrief_seen_at === null) {
                $target->forceFill(['debrief_seen_at' => now()])->save();
            }

            SimulationEvent::record($campaign, $target, SimulationEvent::DEBRIEF_VIEWED, $request, [
                'surface' => 'debrief',
            ]);
        }

        return response()->view('simulation.debrief', [
            'campaign' => $campaign,
            'target' => $target,
            'preview' => $preview,
            'lure' => $this->theme($campaign),
        ]);
    }

    /** A participant flagging the message as suspicious. */
    public function report(Request $request, Campaign $campaign)
    {
        [$target, $preview] = $this->resolve($request, $campaign, requireActive: false);

        if (! $target && ! $preview) {
            return $this->unavailable();
        }

        $reason = null;

        if ($request->filled('reason') && is_string($request->input('reason'))) {
            $reason = substr($request->input('reason'), 0, 500);
        }

        // The free-text reason is allow-listed into `meta` by SimulationEvent.
        $request->request->remove('reason');

        if ($target) {
            if ($target->reported_at === null) {
                $target->forceFill(['reported_at' => now()])->save();
            }

            SimulationEvent::record($campaign, $target, SimulationEvent::REPORTED, $request, array_filter([
                'surface' => 'debrief',
                'reason' => $reason,
            ]));
        }

        return response()->view('simulation.reported', [
            'campaign' => $campaign,
            'target' => $target,
            'preview' => $preview,
        ]);
    }

    /**
     * @return array{0: CampaignTarget|null, 1: bool} target, is-preview
     */
    private function resolve(Request $request, Campaign $campaign, bool $requireActive): array
    {
        $user = $request->user();
        $viewerOwnsCampaign = $user && ($user->isSuperAdmin() || $campaign->user_id === $user->getKey());

        // Owners can walk the funnel without generating metrics.
        if ($viewerOwnsCampaign && $request->boolean('preview')) {
            return [null, true];
        }

        $token = (string) $request->query('t', (string) $request->input('t', ''));

        if ($token === '') {
            return [null, false];
        }

        $target = $campaign->targets()->where('token', $token)->first();

        if (! $target) {
            return [null, false];
        }

        if ($requireActive && ! $campaign->isActive()) {
            return [null, false];
        }

        return [$target, false];
    }

    /**
     * @return array<string, mixed>
     */
    private function theme(Campaign $campaign): array
    {
        return config("lures.{$campaign->platform}") ?? config('lures.generic');
    }

    private function unavailable(): Response
    {
        return response()->view('simulation.unavailable', [], 404);
    }
}
