<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SeatAllocation;
use App\Models\Trip;

class SeatAllocationController extends Controller
{
    public function create(Trip $trip)
    {
        // Get available seats for the trip
        $availableSeats = $this->getAvailableSeats($trip);

        return view('seat_allocations.create', compact('trip', 'availableSeats'));
    }

    public function store(Request $request, Trip $trip)
    {
        $request->validate([
            'seat_number' => 'required|integer|min:1|max:36',
        ]);

        // Check if the seat is available
        if (!$this->isSeatAvailable($trip, $request->input('seat_number'))) {
            return redirect()->back()->with('error', 'Seat is not available.');
        }

        // Reserve the seat
        SeatAllocation::create([
            'trip_id' => $trip->id,
            'user_id' => auth()->id(),
            'seat_number' => $request->input('seat_number'),
        ]);

        return redirect()->route('users.show', auth()->user())->with('success', 'Ticket purchased successfully.');
    }

    private function getAvailableSeats(Trip $trip)
    {
        $reservedSeats = $trip->seatAllocations->pluck('seat_number')->toArray();
        $availableSeats = array_diff(range(1, 36), $reservedSeats);

        return $availableSeats;
    }

    private function isSeatAvailable(Trip $trip, $seatNumber)
    {
        $reservedSeats = $trip->seatAllocations->pluck('seat_number')->toArray();
        return !in_array($seatNumber, $reservedSeats);
    }
}
