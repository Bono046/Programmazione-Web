@extends('layouts.master')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Gare</h1>
    <a href="{{ route('races.create') }}" class="btn btn-primary">Nuova Gara</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Inizio</th>
            <th>Fine</th>
            <th>Descrizione</th>
        </tr>
    </thead>
    <tbody>
        @forelse($races as $race)
            <tr>
                <td>{{ $race->name }}</td>
                <td>{{ $race->start_date->format('d/m/Y') }}</td>
                <td>{{ $race->end_date->format('d/m/Y') }}</td>
                <td>{{ $race->description }}</td>
                <td>
                    <a href="{{ route('races.show', $race) }}" class="btn btn-sm btn-info">Dettagli</a>
                    <a href="{{ route('races.manage', $race) }}" class="btn btn-sm btn-secondary">Gestisci</a>
                    <a href="{{ route('races.edit', $race) }}" class="btn btn-sm btn-warning">Modifica</a>
                    <form action="{{ route('races.destroy', $race) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger"
                        onclick="return confirm('Sei sicuro di voler eliminare questa gara?')">Elimina</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="4" class="text-center">Nessuna gara disponibile</td></tr>
        @endforelse
    </tbody>
</table>
@endsection
