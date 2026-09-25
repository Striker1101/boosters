<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

/**
 * Staff administration. Super admins only — enforced by route middleware.
 *
 * Every admin carries a unique tag. The tag is what the admin shares in the
 * links they hand out, so engagement can be attributed to the admin who ran
 * the campaign.
 */
class AdminController extends Controller
{
    public function index(Request $request)
    {
        $admins = User::query()
            ->staff()
            ->when(
                $request->filled('search'),
                fn ($query) => $query->where(function ($q) use ($request) {
                    $search = $request->string('search');
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('referral_code', 'like', "%{$search}%");
                })
            )
            ->withCount('campaigns')
            ->orderBy('name')
            ->get();

        return view('admins.index', compact('admins'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:190', 'unique:users,email'],
            'role' => ['required', Rule::in([User::ROLE_ADMIN, User::ROLE_SUPER_ADMIN])],
            'password' => ['required', 'string', 'min:12', 'confirmed'],
        ]);

        $tag = User::generateTag();

        $admin = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'role' => $data['role'],
            'password' => Hash::make($data['password']),
            'referral_code' => $tag,
            'referral_id' => $tag,
            'email_verified_at' => now(),
        ]);

        return back()->with('success', "{$admin->name} created. Their unique tag is {$admin->referral_code}.");
    }

    public function update(Request $request, User $admin)
    {
        $data = $request->validate([
            'role' => ['required', Rule::in([User::ROLE_ADMIN, User::ROLE_SUPER_ADMIN])],
        ]);

        if ($this->wouldRemoveLastSuperAdmin($admin, $data['role'])) {
            return back()->withErrors(['role' => 'At least one super admin must remain.']);
        }

        if ($admin->is($request->user()) && $data['role'] !== User::ROLE_SUPER_ADMIN) {
            return back()->withErrors(['role' => 'You cannot remove your own super admin role.']);
        }

        $admin->update(['role' => $data['role']]);

        return back()->with('success', "{$admin->name} is now a {$data['role']}.");
    }

    /** Rotate an admin's tag. Old links stop being attributable to them. */
    public function rotateTag(Request $request, User $admin)
    {
        $admin->update([
            'referral_code' => User::generateTag(),
        ]);

        return back()->with('success', "{$admin->name}'s tag is now {$admin->referral_code}.");
    }

    public function toggle(Request $request, User $admin)
    {
        if ($admin->is($request->user())) {
            return back()->withErrors(['admin' => 'You cannot disable your own account.']);
        }

        if (! $admin->is_disabled && $this->wouldRemoveLastSuperAdmin($admin, User::ROLE_ADMIN)) {
            return back()->withErrors(['admin' => 'At least one active super admin must remain.']);
        }

        $admin->update(['is_disabled' => ! $admin->is_disabled]);

        return back()->with('success', $admin->is_disabled
            ? "{$admin->name} has been disabled."
            : "{$admin->name} has been re-enabled.");
    }

    public function destroy(Request $request, User $admin)
    {
        if ($admin->is($request->user())) {
            return back()->withErrors(['admin' => 'You cannot delete your own account.']);
        }

        if ($this->wouldRemoveLastSuperAdmin($admin, User::ROLE_ADMIN)) {
            return back()->withErrors(['admin' => 'At least one super admin must remain.']);
        }

        $admin->delete();

        return back()->with('success', 'Staff account deleted.');
    }

    /**
     * Would changing $admin to $newRole leave the system with no usable
     * super admin?
     */
    private function wouldRemoveLastSuperAdmin(User $admin, string $newRole): bool
    {
        if (! $admin->isSuperAdmin() || $newRole === User::ROLE_SUPER_ADMIN) {
            return false;
        }

        return User::query()
            ->staff()
            ->where('role', User::ROLE_SUPER_ADMIN)
            ->whereKeyNot($admin->getKey())
            ->where(fn ($q) => $q->whereNull('is_disabled')->orWhere('is_disabled', false))
            ->doesntExist();
    }
}
