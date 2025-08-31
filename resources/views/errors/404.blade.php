@extends('layouts.master')

@section('content')
<div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 60vh;">
    <h1 class="display-4 text-danger mb-3">404</h1>
    <h2 class="mb-3">Pagina non trovata</h2>
    <p class="text-muted mb-4">Ci dispiace, ma la pagina che stai cercando non esiste o è stata rimossa.</p>
    <a href="{{ route('home') }}" class="btn btn-lg btn-primary shadow">
        Torna alla Home
    </a>
</div>
@endsection