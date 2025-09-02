@extends('layouts.master')

@section('content')

@if(!empty($confirmDelete))
    <h2 class="mb-4 text-danger">Conferma eliminazione gara</h2>
    <div class="alert alert-warning">
        <strong>Attenzione!</strong> Stai per eliminare la gara <strong>{{ $race->name }}</strong>. Questa operazione è irreversibile.<br>
        Tutti i dispositivi associati resteranno nel sistema ma non saranno più collegati a questa gara.
    </div>
@else
    <h2 class="mb-4">Dettaglio Gara</h2>
    <div class="mb-3">
        <a href="{{ route('races.index') }}" class="btn btn-outline-primary">
            <i class="bi bi-arrow-left"></i> Torna alla lista gare
        </a>
    </div>
@endif

<div class="row g-4">
    <div class="col-12 col-md-6">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">Informazioni Gara</h5>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush mb-3">
                    <li class="list-group-item"><strong>Nome:</strong> {{ $race->name }}</li>
                    <li class="list-group-item"><strong>Inizio:</strong> {{ $race->start_date->format('d/m/Y') }}</li>
                    <li class="list-group-item"><strong>Fine:</strong> {{ $race->end_date->format('d/m/Y') }}</li>
                    <li class="list-group-item"><strong>Descrizione:</strong> {{ $race->description }}</li>
                </ul>
                @if(!empty($confirmDelete))
                    <div class="row g-2">
                        <div class="col-6">
                            <form action="{{ route('races.destroy', $race) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger w-100">
                                    <i class="bi bi-trash"></i> Elimina definitivamente
                                </button>
                            </form>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('races.index') }}" class="btn btn-secondary w-100">
                                <i class="bi bi-arrow-left"></i> Annulla
                            </a>
                        </div>
                    </div>
                @else
                    <div class="row g-2">
                        <div class="col-4">
                            <a href="{{ route('races.manage', $race) }}" class="btn btn-secondary w-100">
                                <i class="bi bi-gear"></i> Gestisci
                            </a>
                        </div>
                        <div class="col-4">
                            <a href="{{ route('races.edit', $race) }}" class="btn btn-warning w-100">
                                <i class="bi bi-pencil-square"></i> Modifica
                            </a>
                        </div>
                        <div class="col-4">
                            <form action="{{ route('races.destroy', $race) }}" method="POST" onsubmit="return confirm('Sei sicuro di voler eliminare questa gara?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger w-100">
                                    <i class="bi bi-trash"></i> Elimina
                                </button>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">Dispositivi associati</h5>
            </div>
            <div class="card-body p-0" style="max-height: 340px; overflow-y: auto;">
                @if($race->devices->isEmpty())
                    <p class="m-3 text-muted">Nessun dispositivo associato a questa gara.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover align-middle text-center mb-0">
                            <thead class="table-primary">
                                <tr>
                                    <th scope="col">Serial</th>
                                    <th scope="col">IMEI</th>
                                    <th scope="col">ICCID</th>
                                    <th scope="col">Modello</th>
                                    <th scope="col">Azioni</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($race->devices as $device)
                                    <tr>
                                        <td>{{ $device->serial }}</td>
                                        <td>{{ $device->imei }}</td>
                                        <td>{{ $device->iccid }}</td>
                                        <td>{{ $device->deviceModel?->name ?? 'N/A' }}</td>
                                        <td>
                                            <a href="{{ route('devices.show', $device) }}" class="btn btn-sm btn-secondary">
                                                <i class="bi bi-info-circle"></i> Dettagli
                                            </a>
                    
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
