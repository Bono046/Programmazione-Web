@extends('layouts.master')

@section('title', 'Homepage')

@section('content')
<div class="container text-center mt-5">
    <h1>Benvenuto nella Home</h1>
    <p class="lead">Gestisci dispositivi e gare dal pannello qui sotto.</p>

    <div class="d-flex justify-content-center gap-3 mt-4">
        <a href="{{ route('devices.index') }}" class="btn btn-primary btn-lg">
            Gestisci Dispositivi
        </a>
        <a href="{{ route('races.index') }}" class="btn btn-success btn-lg">
            Gestisci Gare
        </a>
    </div>
</div>
@endsection