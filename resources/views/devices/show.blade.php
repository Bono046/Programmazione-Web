@extends('layouts.master')

@section('title', 'Dettaglio Device')

@section('content')

@if(!empty($confirmDelete))
    <h2 class="mb-4 text-danger">Conferma eliminazione device</h2>
    <div class="alert alert-warning">
        <strong>Attenzione!</strong> Stai per eliminare il device <strong>{{ $device->serial }}</strong>. Questa operazione è irreversibile.<br>
        Il device verrà rimosso dal sistema e non sarà più associato a nessuna gara.
    </div>
@else
    <h2 class="mb-4">Dettaglio Device</h2>
    <div class="mb-3">
        <a href="{{ route('devices.index') }}" class="btn btn-outline-primary">&larr; Torna alla lista device</a>
    </div>
@endif

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="row g-4">
    <div class="col-12 col-md-6">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">Informazioni Device</h5>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush mb-3">
                    <li class="list-group-item"><strong>Serial:</strong> {{ $device->serial }}</li>
                    <li class="list-group-item"><strong>IMEI:</strong> {{ $device->imei }}</li>
                    <li class="list-group-item"><strong>ICCID:</strong> {{ $device->iccid }}</li>
                    <li class="list-group-item"><strong>Modello:</strong> {{ $device->deviceModel?->name ?? 'N/A' }}</li>
                    @if($device->category)
                        <li class="list-group-item"><strong>Categoria:</strong> {{ $device->category }}</li>
                    @endif
                </ul>
                @if(!empty($confirmDelete))
                    <div class="row g-2">
                        <div class="col-6">
                            <form action="{{ route('devices.destroy', $device) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger w-100">
                                    <i class="bi bi-trash"></i> Elimina definitivamente
                                </button>
                            </form>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('devices.index') }}" class="btn btn-secondary w-100">
                                <i class="bi bi-arrow-left"></i> Annulla
                            </a>
                        </div>
                    </div>
                @else
                    <div class="row g-2">
                        <div class="col-6">
                            <a href="{{ route('devices.edit', $device) }}" class="btn btn-warning w-100">
                                <i class="bi bi-pencil-square"></i> Modifica
                            </a>
                        </div>
                        <div class="col-6">
                            <form action="{{ route('devices.confirmDelete', $device) }}" method="GET">
                                @csrf
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
                <h5 class="mb-0">Gare associate</h5>
            </div>
            <div class="card-body p-0" style="max-height: 280px; overflow-y: auto;">
                @if($device->races->isEmpty())
                    <p class="m-3 text-muted">Nessuna gara associata a questo device.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover align-middle text-center mb-0">
                            <thead class="table-primary">
                                <tr>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Azioni</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($device->races as $race)
                                    <tr>
                                        <td>{{ $race->name ?? 'Gara #' . $race->id }}</td>
                                        <td>
                                            <a href="{{ route('races.show', $race) }}" class="btn btn-sm btn-secondary">
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
