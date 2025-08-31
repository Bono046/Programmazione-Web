@extends('layouts.master')

@section('content')
<div class="container">

    <div class="mb-3">
        <a href="{{ route('races.index') }}" class="btn btn-outline-primary">&larr; Torna alla lista gare</a>
    </div>
    <h1>Gestisci Gara: {{ $race->name }}</h1>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="mb-4">
        <p><strong>Data inizio:</strong> {{ $race->start_date }}</p>
        <p><strong>Data fine:</strong> {{ $race->end_date }}</p>
    </div>

    <hr>

    <h3>Seleziona Dispositivi</h3>

    <!-- Form gestione dispositivi -->
    <form action="{{ route('races.updateDevices', $race) }}" method="POST">
        @csrf

        <!-- Filtro per modello -->
        <div class="row mb-3">
            <div class="col-md-4">
            <label for="modelFilter" class="form-label">Filtra per modello</label>
            <select id="modelFilter" class="form-select">
                <option value="">-- Tutti --</option>
                @foreach($models as $model)
                <option value="{{ $model->id }}">{{ $model->name }}</option>
                @endforeach
            </select>
            </div>
            <div class="col-md-6 align-self-end">
            <label for="deviceSearch" class="form-label">Cerca dispositivo</label>
            <input type="text" id="deviceSearch" class="form-control" placeholder="Cerca per seriale, IMEI, ICCID o modello...">
            </div>
        </div>

        <!-- Tabella dispositivi -->
        <table class="table table-bordered table-striped" id="devicesTable">
            <thead>
                <tr>
                    <th>Seleziona</th>
                    <th>Seriale</th>
                    <th>IMEI</th>
                    <th>ICCID</th>
                    <th>Modello</th>
                </tr>
            </thead>
            <tbody>
                @foreach($devices as $device)
                    <tr data-model="{{ $device->device_model_id }}">
                        <td>
                            <input type="checkbox" name="devices[]" value="{{ $device->id }}"
                                {{ $race->devices->contains($device->id) ? 'checked' : '' }}>
                        </td>
                        <td>{{ $device->serial }}</td>
                        <td>{{ $device->imei }}</td>
                        <td>{{ $device->iccid }}</td>
                        <td>
                            {{ $models->firstWhere('id', $device->device_model_id)?->name ?? 'N/A' }}
                        </td>       
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-3">
            <button type="submit" class="btn btn-success">Aggiorna Dispositivi</button>
            
        </div>
    </form>
</div>

<!-- Script JS per filtro -->
<script>
document.getElementById('modelFilter').addEventListener('change', filterDevices);
document.getElementById('deviceSearch').addEventListener('input', filterDevices);

function filterDevices() {
    let selectedModel = document.getElementById('modelFilter').value.toLowerCase();
    let searchTerm = document.getElementById('deviceSearch').value.toLowerCase();

    document.querySelectorAll('#devicesTable tbody tr').forEach(row => {
        let matchesModel = !selectedModel || row.getAttribute('data-model') === selectedModel;
        let rowText = row.innerText.toLowerCase();
        let matchesSearch = !searchTerm || rowText.includes(searchTerm);

        // Mostra solo se soddisfa entrambi i filtri
        if (matchesModel && matchesSearch) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}
</script>

@endsection
