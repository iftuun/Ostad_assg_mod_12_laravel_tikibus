<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trip;
use App\Models\Location;

class TripController extends Controller
{
    public function index()
    {
        $trips = Trip::with('location')->get();
        return view('trips.index', compact('trips'));
    }

    public function create()
    {
        $locations = Location::all();
        return view('trips.create', compact('locations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'location_id' => 'required|exists:locations,id',
        ]);

        Trip::create([
            'date' => $request->input('date'),
            'location_id' => $request->input('location_id'),
        ]);

        return redirect()->route('trips.index')->with('success', 'Trip created successfully.');
    }
}
