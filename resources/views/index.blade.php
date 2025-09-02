@extends('layouts.master')

@section('title', 'Homepage')

@section('content')
<div class="container d-flex  ">
    <div class="card shadow-lg p-4 border-0 w-100" style="max-width: 500px; max-height: 500px;">
        <div class="card-body text-center d-flex flex-column justify-content-center h-100">
            <h1 class="mb-3 fw-bold text-primary">
                <i class="bi bi-house-door-fill me-2"></i>Benvenuto
            </h1>
            <p class="lead mb-4">Gestisci dispositivi e gare dal pannello qui sotto.</p>
            <div class="d-flex flex-column gap-3">
                <a href="{{ route('devices.index') }}" class="btn btn-primary btn-lg w-100">
                    <i class="bi bi-phone me-2"></i> Gestisci Dispositivi
                </a>
                <a href="{{ route('races.index') }}" class="btn btn-success btn-lg w-100">
                    <i class="bi bi-flag-fill me-2"></i> Gestisci Gare
                </a>
            </div>
        </div>
    </div>
</div>
@endsection