@extends('layouts.master')

@section('title', 'Lista Dispositivi')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Lista Dispositivi</h2>
    <a href="{{ route('devices.create') }}" class="btn btn-primary">Aggiungi Device</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Serial</th>
            <th>IMEI</th>
            <th>ICCID</th>
            <th>Modello</th>
            <th>Azioni</th>
        </tr>
    </thead>
    <tbody>
        @forelse($devices as $device)
            <tr>
                <td>{{ $device->id }}</td>
                <td>{{ $device->serial }}</td>
                <td>{{ $device->imei }}</td>
                <td>{{ $device->iccid }}</td>
                <td>{{ $device->deviceModel?->name ?? 'N/A' }}</td>


                <td>
                        <a href="{{ route('devices.show', $device) }}" class="btn btn-sm btn-info">Dettagli</a>
                        <a href="{{ route('devices.edit', $device) }}" class="btn btn-sm btn-warning">Modifica</a>
                        <form action="{{ route('devices.destroy', $device) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Sei sicuro di voler eliminare questo device?')">Elimina</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center">Nessun device presente</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection
