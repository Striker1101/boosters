<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    /**
     * The roles that this screen manages.
     *
     * @var list<string>
     */
    private const MANAGED_ROLES = [User::ROLE_ADMIN, User::ROLE_SUPER_ADMIN];

    /**
     * Show the admin management screen.
     */
    public function index(Request $request)
    {
        $query = User::query()->whereIn('role', self::MANAGED_ROLES);

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('is_disabled')) {
            $query->where('is_disabled', $request->is_disabled);
        }

        $admins = $query
            ->orderByRaw("FIELD(role, 'super_admin', 'admin')")
            ->orderByDesc('created_at')
            ->get();

        return view('admins', compact('admins'));
    }

    /**
     * Create a new admin or super admin.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:5'],
            'role' => ['required', Rule::in(self::MANAGED_ROLES)],
        ]);

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
            'email_verified_at' => now(),
        ]);

        return redirect()
            ->route('admins.index')
            ->with('success', 'Admin created successfully');
    }

    /**
     * Toggle an admin's disabled state.
     */
    public function update($id)
    {
        $admin = $this->findManagedAdmin($id);

        if ($admin->is(Auth::user())) {
            return response()->json([
                'success' => false,
                'message' => 'You cannot disable your own account.',
            ], 422);
        }

        if ($admin->isSuperAdmin() && ! $admin->is_disabled && $this->superAdminCount() <= 1) {
            return response()->json([
                'success' => false,
                'message' => 'You cannot disable the last super admin.',
            ], 422);
        }

        $admin->is_disabled = ! $admin->is_disabled;
        $admin->save();

        return response()->json([
            'success' => true,
            'is_disabled' => $admin->is_disabled,
        ]);
    }

    /**
     * Promote or demote an admin.
     */
    public function updateRole(Request $request, $id)
    {
        $data = $request->validate([
            'role' => ['required', Rule::in(self::MANAGED_ROLES)],
        ]);

        $admin = $this->findManagedAdmin($id);

        if ($admin->is(Auth::user())) {
            return response()->json([
                'success' => false,
                'message' => 'You cannot change your own role.',
            ], 422);
        }

        if (
            $admin->isSuperAdmin()
            && $data['role'] !== User::ROLE_SUPER_ADMIN
            && $this->superAdminCount() <= 1
        ) {
            return response()->json([
                'success' => false,
                'message' => 'You cannot demote the last super admin.',
            ], 422);
        }

        $admin->role = $data['role'];
        $admin->save();

        return response()->json([
            'success' => true,
            'role' => $admin->role,
        ]);
    }

    /**
     * Update the ref id used to attribute attempts to this admin.
     */
    public function updateRefId(Request $request, $id)
    {
        $data = $request->validate([
            'ref_id' => [
                'required',
                'string',
                'max:255',
                'regex:/^[A-Za-z0-9_-]+$/',
                Rule::unique('users', 'ref_id')->ignore($id),
            ],
        ]);

        $admin = $this->findManagedAdmin($id);
        $admin->ref_id = $data['ref_id'];
        $admin->save();

        return response()->json([
            'success' => true,
            'ref_id' => $admin->ref_id,
            'ref_link' => $admin->refLink(),
        ]);
    }

    /**
     * Delete an admin.
     */
    public function destroy($id)
    {
        $admin = $this->findManagedAdmin($id);

        if ($admin->is(Auth::user())) {
            return redirect()
                ->route('admins.index')
                ->with('error', 'You cannot delete your own account.');
        }

        if ($admin->isSuperAdmin() && $this->superAdminCount() <= 1) {
            return redirect()
                ->route('admins.index')
                ->with('error', 'You cannot delete the last super admin.');
        }

        $admin->delete();

        return redirect()
            ->route('admins.index')
            ->with('success', 'Admin deleted successfully');
    }

    /**
     * Find a user that is managed from this screen.
     */
    private function findManagedAdmin($id): User
    {
        return User::whereIn('role', self::MANAGED_ROLES)->findOrFail($id);
    }

    /**
     * Count the remaining super admins.
     */
    private function superAdminCount(): int
    {
        return User::where('role', User::ROLE_SUPER_ADMIN)->count();
    }
}
