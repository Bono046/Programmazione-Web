@extends('layouts.master')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Gare</h1>
    <a href="{{ route('races.create') }}" class="btn btn-primary">Nuova Gara</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="table-responsive">
    <table class="table table-hover align-middle text-center">
        <thead class="table-dark">
            <tr>
                <th>Nome</th>
                <th>Inizio</th>
                <th>Fine</th>
                <th>Descrizione</th>
                <th>Azioni</th>
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
                        <a href="{{ route('races.show', $race) }}" class="btn btn-sm btn-secondary">
                            <i class="bi bi-info-circle"></i> Dettagli
                        </a>
                        <a href="{{ route('races.manage', $race) }}" class="btn btn-sm btn-info">
                            <i class="bi bi-gear"></i> Gestisci
                        </a>
                        @if(auth()->user()->role != 'operator')
                            <a href="{{ route('races.edit', $race) }}" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil-square"></i> Modifica
                            </a>
                            <form action="{{ route('races.confirmDelete', $race) }}" method="GET" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash"></i> Elimina
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Nessuna gara disponibile</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
