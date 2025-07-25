@extends('layouts.app')

@section('content')

<style>
    #calendar {
        background-color: white;
        padding: 10px;
        border-radius: 10px;
    }
</style>

<div class="container">
    <h2 class="mb-4">Fixtures Calendar View</h2>

    <a href="{{ route('fixtures.index') }}" class="btn btn-secondary mb-3">Switch to List View</a>

    <div id='calendar'></div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        height: 650,
        events: [
            @foreach($fixtures as $fixture)
            {
                title: '{{ $fixture->home_team }} vs {{ $fixture->away_team }}',
                start: '{{ $fixture->date }}T{{ $fixture->time }}',
                url: '{{ route("fixtures.show", $fixture->id) }}',
                allDay: false
            },
            @endforeach
        ],
        eventClick: function(info) {
            info.jsEvent.preventDefault(); // Prevent redirect
            window.location.href = info.event.url;
        }
    });

    calendar.render();
});
</script>
@endsection
