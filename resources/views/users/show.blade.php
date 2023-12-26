{{-- Display user details and seat allocations --}}
<h1>{{ $user->name }}</h1>
<h2>Seat Allocations:</h2>
<ul>
    @foreach ($user->seatAllocations as $allocation)
        <li>{{ $allocation->trip->location->name }} - {{ $allocation->trip->date }} - Seat: {{ $allocation->seat_number }}</li>
    @endforeach
</ul>
