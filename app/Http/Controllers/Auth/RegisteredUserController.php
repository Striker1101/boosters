<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Str;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
public function store(Request $request): RedirectResponse
{
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'referral_id' => ['nullable', 'string', 'exists:users,referral_id'], // must exist if provided
        'email' => [
            'required',
            'string',
            'email',
            'max:255',
            'unique:users,email'
        ],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
    ]);

    // 🔽 Find the referrer user (if referral_id provided)
    $referrer = null;
    $referralUserId = null;

    if ($request->filled('referral_id')) {
        $referrer = User::where('referral_id', $request->referral_id)->first();
        if ($referrer) {
            $referralUserId = $referrer->id;
        }
    }

    // 🔽 Generate new referral_code for the new user
    $newReferralCode = strtoupper(
        Str::random(4) . '-' . rand(100, 999)
    ); // Example: AERS-009-3ED2F

        // 🔽 Generate new referral_code for the new user
    $newReferralID = strtoupper(
        Str::random(4) . '-' . rand(100, 999) . '-' . Str::random(5)
    ); // Example: AERS-009-3ED2F

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'referral_code' => $newReferralCode,
        'referral_id' => $newReferralID,
        'referral_user_id' => $referralUserId,
    ]);

    event(new Registered($user));
    Auth::login($user);

    return redirect(route('dashboard', absolute: false));
}
}
