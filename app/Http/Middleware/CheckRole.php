<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Allow the request when the authenticated user has one of the given roles.
     *
     * Usage: ->middleware(CheckRole::class . ':admin')
     *        ->middleware(CheckRole::class . ':admin,super_admin')
     *
     * Super admins always pass, since they sit above every other role.
     */
    public function handle(Request $request, Closure $next, string ...$roles)
    {
        $user = Auth::user();

        if (! $user) {
            abort(403, 'Unauthorized');
        }

        if ($user->isSuperAdmin()) {
            return $next($request);
        }

        if (! in_array($user->role, $roles, true)) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
