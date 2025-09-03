@extends('layouts.master')

@section('title', 'Homepage')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center mb-4">
        <div class="col-12 col-md-8 col-lg-6">
            <div class="d-flex flex-row gap-4 align-items-center justify-content-center p-4 rounded">
            <a href="{{ route('devices.index') }}" class="btn btn-lg w-50 bg-dark" style="color:#fff;">
                <i class="bi bi-phone me-2"></i> Dispositivi
            </a>
            <a href="{{ route('races.index') }}" class="btn btn-lg w-50 bg-dark" style="color:#fff;">
                <i class="bi bi-flag-fill me-2"></i> Gare
            </a>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">
                    <h4 class="mb-3"><i class="bi bi-calendar-event me-2"></i>Calendario Gare</h4>
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- FullCalendar CSS -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css" rel="stylesheet">
<!-- FullCalendar JS -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    if(calendarEl) {
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'it',
            height: 600,
            events: @json($events ?? []),
            eventColor: '#198754',
            eventTextColor: '#fff',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            eventClick: function(info) {
                if(info.event.url) {
                    window.location.href = info.event.url;
                    info.jsEvent.preventDefault();
                }
            }
        });
        calendar.render();
    }
});
</script>
@endsection