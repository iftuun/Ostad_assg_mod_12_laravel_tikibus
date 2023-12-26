{{-- Form for purchasing a ticket --}}
<form method="post" action="{{ route('seat_allocations.store', $trip) }}">
    @csrf
    <label for="seat_number">Select Seat:</label>
    <select name="seat_number" required>
        @foreach ($availableSeats as $seat)
            <option value="{{ $seat }}">{{ $seat }}</option>
        @endforeach
    </select><br>

    <button type="submit">Purchase Ticket</button>
</form>
