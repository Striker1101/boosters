<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Staff overview: campaign results, aggregate metrics, and the copy-paste
     * links each admin hands to enrolled participants.
     */
    public function index(Request $request)
    {
        $user = $request->user();

        $campaigns = Campaign::query()
            // A plain admin only ever sees their own campaigns.
            ->when(! $user->isSuperAdmin(), fn ($query) => $query->where('user_id', $user->getKey()))
            ->when(
                $request->filled('search'),
                fn ($query) => $query->where('name', 'like', '%'.$request->string('search').'%')
            )
            ->when(
                $request->filled('status'),
                fn ($query) => $query->where('status', $request->string('status'))
            )
            ->with('owner')
            ->withCount([
                'targets',
                'targets as opened_count' => fn ($q) => $q->whereNotNull('first_opened_at'),
                'targets as clicked_count' => fn ($q) => $q->whereNotNull('first_clicked_at'),
                'targets as submitted_count' => fn ($q) => $q->whereNotNull('submitted_at'),
                'targets as reported_count' => fn ($q) => $q->whereNotNull('reported_at'),
            ])
            ->latest()
            ->get();

        $adminRollup = $user->isSuperAdmin()
            ? User::query()->staff()->withCount('campaigns')->orderBy('name')->get()
            : collect();

        return view('dashboard', compact('user', 'campaigns', 'adminRollup'));
    }
}
