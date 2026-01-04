<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserBidContorller extends Controller
{
    public function index(Request $request)
{
    $userId = Auth::id();
    $filters = ['deleted' => $request->boolean('deleted'),
    ...$request->only(['by','order'])];

    return inertia('UserBid/Index', [
        'listings' => Listing::query()
            // 🔹 hanya listing yang pernah dibid user ini
            ->whereHas('offers', function ($q) use ($userId) {
                $q->where('bidder_id', $userId);
            })
            // 🔹 hitung offer user ini saja
            ->withCount([
                'images',
                'offers as offers_count' => function ($q) use ($userId) {
                    $q->where('bidder_id', $userId);
                }
            ])
            ->filter($filters)
            ->paginate(5)
            ->withQueryString()
    ]);
}

}
