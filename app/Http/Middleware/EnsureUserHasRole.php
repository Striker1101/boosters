<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Restricts a route group to the given roles.
 *
 * Usage: ->middleware('role:admin,super_admin')
 */
class EnsureUserHasRole
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        if (! $user) {
            return redirect()->route('login');
        }

        if (! $user->hasAnyRole(...$roles)) {
            abort(403, 'Your account does not have access to this area.');
        }

        if ($user->is_disabled) {
            abort(403, 'This account has been disabled.');
        }

        return $next($request);
    }
}
