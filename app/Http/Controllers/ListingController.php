<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->authorizeResource(Listing::class, 'listing');
    }
    public function index(Request $request)
    {
        $filters = $request->only([
                    'priceFrom', 'priceTo', 'beds', 'baths', 'areaFrom', 'areaTo'
        ]);
        return inertia(
            'Listing/Index',
            [
                'filters'=> $filters,
                'listings' => Listing::mostRecent()->filter($filters)->paginate(10)->withQueryString()
            ]
         );
    }

   

    /**
     * Display the specified resource.
     */
    public function show(Listing $listing)
    {
        // Auth::user()->can('view',$listing);

        return inertia(
            'Listing/Show',
            [
                'listing' => $listing
            ]
         );
    }

    /**
     * Show the form for editing the specified resource.
     */
    

    

    /**
     * Remove the specified resource from storage.
     */
    
}
