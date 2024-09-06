<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Traits\RateableTrait;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    use RateableTrait;
    public $place;
    public function __construct(Place $place)
    {
        $this->place = $place;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $places =  $this->place->orderBy('view_count', 'desc')->take(3)->get();
        // return view('welcome', 'places');
        return view('welcome', ['places' => Place::orderBy('view_count', 'desc')->take(3)->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Place $place)
    {
        $place = $place::withCount('reviews')->with(['reviews' => function ($query) {
            $query->with('user');
            $query->withCount('likes');
        }])->find($place->id);

        $avg = $this->averageRating($place);
        $total = $avg['total'];
        $serviceRating = $avg['service_rating'];
        $qualityRating = $avg['quality_rating'];
        $cleanlinessRating = $avg['cleanliness_rating'];
        $pricingRating = $avg['pricing_rating'];
        return view('places.details', compact('place', 'total', 'serviceRating', 'qualityRating', 'cleanlinessRating', 'pricingRating'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Place $place)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Place $place)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Place $place)
    {
        //
    }
}
