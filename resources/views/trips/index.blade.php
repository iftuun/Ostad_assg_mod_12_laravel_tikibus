{{-- Display a list of trips --}}
@foreach ($trips as $trip)
    {{ $trip->date }} - {{ $trip->location->name }}<br>
@endforeach
