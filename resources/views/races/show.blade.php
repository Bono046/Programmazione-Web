@extends('layouts.master')

@section('content')
<h1>Dettaglio Gara</h1>

<div class="card mb-3">
    <div class="card-body">
        <h5 class="card-title">{{ $race->name }}</h5>
        <p class="card-text"><strong>Inizio:</strong> {{ $race->start_date->format('d/m/Y') }}</p>
        <p class="card-text"><strong>Fine:</strong> {{ $race->end_date->format('d/m/Y') }}</p>
        <p class="card-text"><strong>Descrizione:</strong> {{ $race->description }}</p>

    </div>
</div>

<a href="{{ route('races.edit', $race) }}" class="btn btn-warning">Modifica</a>

<form action="{{ route('races.destroy', $race) }}" method="POST" class="d-inline">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger" onclick="return confirm('Sei sicuro di voler eliminare questa gara?')">
        Elimina
    </button>
</form>

<a href="{{ route('races.index') }}" class="btn btn-secondary">Torna alla lista</a>
@endsection
