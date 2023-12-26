{{-- Form for creating a trip --}}
<form method="post" action="{{ route('trips.store') }}">
    @csrf
    <label for="date">Date:</label>
    <input type="date" name="date" required><br>

    <label for="location_id">Location:</label>
    <select name="location_id" required>
        @foreach ($locations as $location)
            <option value="{{ $location->id }}">{{ $location->name }}</option>
        @endforeach
    </select><br>

    <button type="submit">Create Trip</button>
</form>
