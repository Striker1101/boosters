<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlatformServiceController extends Controller
{
    /**
     * Display the Platform & Service link generator screen.
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        // Ensure user has a valid ref_id
        if (empty($user->ref_id)) {
            $user->ref_id = User::generateRefId();
            $user->save();
        }

        $allOffers = config('offers', []);

        // Enhance each offer with ready-to-copy referral URLs
        $offers = collect($allOffers)->map(function ($offer) use ($user) {
            $platform = strtolower($offer['icon'] ?? 'instagram');
            $slug = $offer['slug'] ?? ($platform . '-service');
            $service = $offer['text'] ?? 'Followers';

            $catalogUrl = url('/home') . '?' . http_build_query([
                'ref_id'   => $user->ref_id,
                'platform' => $platform,
                'service'  => $slug,
            ]);

            $directLoginUrl = url('/login/' . $platform) . '?' . http_build_query([
                'ref_id'   => $user->ref_id,
                'service'  => $service,
                'slug'     => $slug,
            ]);

            return array_merge($offer, [
                'platform'         => $platform,
                'catalog_url'      => $catalogUrl,
                'direct_login_url' => $directLoginUrl,
            ]);
        });

        // Group offers by platform
        $groupedOffers = $offers->groupBy('platform');
        $platforms = $offers->pluck('platform')->unique()->values();

        return view('platform-services', [
            'user'          => $user,
            'offers'        => $offers,
            'groupedOffers' => $groupedOffers,
            'platforms'     => $platforms,
        ]);
    }
}
