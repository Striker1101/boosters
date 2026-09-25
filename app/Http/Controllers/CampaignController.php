<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CampaignController extends Controller
{
    public function index()
    {
        return redirect()->route('dashboard');
    }

    public function create()
    {
        return view('campaigns.create', [
            'platforms' => config('lures'),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'platform' => ['required', 'string', Rule::in(array_keys(config('lures')))],
            'scope' => ['required', 'string', 'min:20', 'max:2000'],
            'authorized_by' => ['required', 'string', 'max:120'],
            'authorized_email' => ['required', 'email', 'max:190'],
            'authorization_ref' => ['required', 'string', 'max:120'],
            'authorization_expires_at' => ['required', 'date', 'after:today'],
        ]);

        $data['user_id'] = $request->user()->getKey();
        $data['slug'] = $this->uniqueSlug($data['name']);
        $data['authorized_at'] = now();
        $data['status'] = 'draft';

        $campaign = Campaign::create($data);

        return redirect()
            ->route('campaigns.show', $campaign)
            ->with('success', 'Campaign created as a draft. A super admin must activate it before any link will work.');
    }

    public function show(Request $request, Campaign $campaign)
    {
        $this->authorizeCampaign($request, $campaign);

        $campaign->load(['owner', 'targets' => fn ($q) => $q->orderBy('name')]);

        $links = $campaign->targets->mapWithKeys(fn ($target) => [
            $target->getKey() => $campaign->linkFor($target),
        ]);

        return view('campaigns.show', [
            'campaign' => $campaign,
            'targets' => $campaign->targets,
            'links' => $links,
            'metrics' => $campaign->metrics(),
            'platforms' => config('lures'),
        ]);
    }

    public function edit(Request $request, Campaign $campaign)
    {
        $this->authorizeCampaign($request, $campaign);

        return view('campaigns.edit', [
            'campaign' => $campaign,
            'platforms' => config('lures'),
        ]);
    }

    public function update(Request $request, Campaign $campaign)
    {
        $this->authorizeCampaign($request, $campaign);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'platform' => ['required', 'string', Rule::in(array_keys(config('lures')))],
            'scope' => ['required', 'string', 'min:20', 'max:2000'],
            'authorized_by' => ['required', 'string', 'max:120'],
            'authorized_email' => ['required', 'email', 'max:190'],
            'authorization_ref' => ['required', 'string', 'max:120'],
            'authorization_expires_at' => ['required', 'date'],
        ]);

        // Editing the authorization details invalidates the previous sign-off
        // until a super admin re-confirms the campaign.
        $authorizationChanged = collect(['authorized_by', 'authorized_email', 'authorization_ref', 'scope'])
            ->contains(fn ($field) => ($campaign->{$field} ?? '') !== ($data[$field] ?? ''));

        $campaign->update($data);

        if ($authorizationChanged && ! $request->user()->isSuperAdmin()) {
            $campaign->update(['status' => 'draft', 'authorized_at' => now()]);

            return redirect()
                ->route('campaigns.show', $campaign)
                ->with('success', 'Campaign updated. Because the authorization details changed it is back in draft and needs super admin approval.');
        }

        return redirect()
            ->route('campaigns.show', $campaign)
            ->with('success', 'Campaign updated.');
    }

    /** Status changes are a super admin control. */
    public function updateStatus(Request $request, Campaign $campaign)
    {
        if (! $request->user()->isSuperAdmin()) {
            abort(403, 'Only a super admin can change a campaign status.');
        }

        $data = $request->validate([
            'status' => ['required', Rule::in(['draft', 'active', 'paused', 'completed'])],
        ]);

        if ($data['status'] === 'active' && ! $campaign->canBeActivated()) {
            return back()->withErrors([
                'status' => 'This campaign has no current authorization on record, so it cannot be activated.',
            ]);
        }

        $campaign->update(['status' => $data['status']]);

        return back()->with('success', "Campaign marked as {$data['status']}.");
    }

    public function destroy(Request $request, Campaign $campaign)
    {
        $this->authorizeCampaign($request, $campaign);

        $campaign->delete();

        return redirect()
            ->route('dashboard')
            ->with('success', 'Campaign deleted.');
    }

    /** Owners see their own campaign; super admins see everything. */
    private function authorizeCampaign(Request $request, Campaign $campaign): void
    {
        $user = $request->user();

        if (! $user->isSuperAdmin() && $campaign->user_id !== $user->getKey()) {
            abort(403, 'This campaign belongs to another admin.');
        }
    }

    private function uniqueSlug(string $name): string
    {
        $base = Str::slug($name) ?: 'campaign';
        $slug = $base;
        $suffix = 2;

        while (Campaign::where('slug', $slug)->exists()) {
            $slug = "{$base}-{$suffix}";
            $suffix++;
        }

        return $slug;
    }
}
