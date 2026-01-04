<?php

namespace App\Http\Controllers\Api;

use App\Models\Listing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ListingResource;

class ListingController extends Controller
{
public function index()
    {
        return ListingResource::collection(
            Listing::whereNull('sold_at')->latest()->paginate(10)
        );
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'beds'      => 'required|integer|min:0|max:255',
            'baths'     => 'required|integer|min:0|max:255',
            'area'      => 'required|integer|min:0|max:65535',
            'city'      => 'required|string',
            'code'      => 'required|string',
            'street'    => 'required|string',
            'street_nr' => 'required|string',
            'price'     => 'required|integer|min:0',
        ]);

        $data['by_user_id'] = $request->user()->id;

        $listing = Listing::create($data);

        return new ListingResource($listing);
    }

    public function show(Listing $listing)
    {
        return new ListingResource($listing);
    }

    public function update(Request $request, Listing $listing)
    {
        // optional: policy check
        // $this->authorize('update', $listing);

        $data = $request->validate([
            'beds'      => 'sometimes|integer|min:0|max:255',
            'baths'     => 'sometimes|integer|min:0|max:255',
            'area'      => 'sometimes|integer|min:0|max:65535',
            'city'      => 'sometimes|string',
            'code'      => 'sometimes|string',
            'street'    => 'sometimes|string',
            'street_nr' => 'sometimes|string',
            'price'     => 'sometimes|integer|min:0',
        ]);

        $listing->update($data);

        return new ListingResource($listing);
    }

    public function destroy(Listing $listing)
    {
        // soft delete
        $listing->delete();

        return response()->json([
            'message' => 'Listing soft deleted'
        ]);
    }

    /**
     * Mark listing as sold
     */
    public function sell(Request $request, Listing $listing)
    {
        $data = $request->validate([
            'sold_to' => 'required|integer|min:1',
        ]);

        $listing->update([
            'sold_at' => now(),
            'sold_to' => $data['sold_to'],
        ]);

        return new ListingResource($listing);
    }
}
