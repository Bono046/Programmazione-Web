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

<!-- Filtri -->
<div class="row mb-3">
    <div class="col-md-4">
        <label for="modelFilter" class="form-label">Filtra per modello</label>
        <select id="modelFilter" class="form-select">
            <option value="">-- Tutti --</option>
            @foreach($deviceModels as $model)
                <option value="{{ $model->id }}">{{ $model->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6 align-self-end">
        <label for="deviceSearch" class="form-label">Cerca dispositivo</label>
        <input type="text" id="deviceSearch" class="form-control" placeholder="Cerca per seriale, IMEI, ICCID o modello...">
    </div>
</div>

<div class="table-responsive">
 <table class="table table-hover align-middle text-center" id="devicesTable">
    <thead class="table-dark">
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
            <tr data-model="{{ $device->device_model_id }}">
                <td>{{ $device->id }}</td>
                <td>{{ $device->serial }}</td>
                <td>{{ $device->imei }}</td>
                <td>{{ $device->iccid }}</td>
                <td>{{ $device->deviceModel?->name ?? 'N/A' }}</td>
                <td>
                    <a href="{{ route('devices.show', $device) }}" class="btn btn-sm btn-secondary">
                        <i class="bi bi-info-circle"></i> Dettagli
                    </a>
                    <a href="{{ route('devices.edit', $device) }}" class="btn btn-sm btn-warning">
                        <i class="bi bi-pencil-square"></i> Modifica</a>
                    <form action="{{ route('devices.confirmDelete', $device) }}" method="GET" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-danger">
                            <i class="bi bi-trash"></i> Elimina</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center">Nessun device presente</td>
            </tr>
        @endforelse
    </tbody>
</table>
</div>

<script>
function filterDevicesTable() {
    let selectedModel = document.getElementById('modelFilter').value;
    let searchTerm = document.getElementById('deviceSearch').value.toLowerCase();
    document.querySelectorAll('#devicesTable tbody tr').forEach(row => {
        let matchesModel = !selectedModel || row.getAttribute('data-model') === selectedModel;
        let rowText = row.innerText.toLowerCase();
        let matchesSearch = !searchTerm || rowText.includes(searchTerm);
        row.style.display = (matchesModel && matchesSearch) ? '' : 'none';
    });
}
document.getElementById('modelFilter').addEventListener('change', filterDevicesTable);
document.getElementById('deviceSearch').addEventListener('input', filterDevicesTable);
</script>
@endsection
