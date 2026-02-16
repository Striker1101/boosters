<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Log;
use App\Models\User;

class DashboardController extends Controller
{
    public function get_dashboard(Request $request)
    {
        $user = Auth::user();

        $logs = Log::query()
            // Filter only if role is 'user', otherwise admin sees all
            ->when(strtolower($user->role) === 'user', function($query) use ($user) {
                $query->where('referral_code_id', $user->referral_code);
            })
            // Optional search
            ->when($request->filled('search'), function($query) use ($request) {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('username', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->with('tag')
            ->orderByDesc('created_at')
            ->get();

        // Group by username
        $groupedLogs = $logs->groupBy('username');

        return view('dashboard', compact('groupedLogs'));
    }

 public function get_users(Request $request)
    {
        $query = User::query();

        // Search by name, referral_code, referral_id or ID
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('referral_code', 'like', "%{$search}%")
                  ->orWhere('referral_id', 'like', "%{$search}%")
                  ->orWhere('id', $search);
        }

        if ($request->filled('is_disabled')) {
            $query->where('is_disabled', $request->is_disabled);
        }

        $users = $query->withCount(['logs', 'referred_users'])
                       ->orderByDesc('created_at')
                       ->get();

        return view('user', compact('users'));
    }

    // Toggle is_disabled
  public function patch_users(Request $request, $id)
{
    $user = User::findOrFail($id);
    $user->is_disabled = !$user->is_disabled;
    $user->save();

    return response()->json([
        'success' => true,
        'is_disabled' => $user->is_disabled
    ]);
}


    // Delete user
public function delete_users($id)
{
    User::findOrFail($id)->delete();

    return redirect()
        ->route('user')
        ->with('success', 'User deleted successfully');
}



    public function get_referrals($id)
{
    $user = User::findOrFail($id);

    return response()->json(
        $user->referred_users()->latest()->get()
    );
}

public function get_logs($id)
{
    $user = User::findOrFail($id);

    return response()->json(
        $user->logs()->latest()->get()
    );
}
}
