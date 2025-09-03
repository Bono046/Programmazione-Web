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

    @php
    // Se c'è activeTab in sessione, usalo; altrimenti 'partenza'
    $activeTab = session('activeTab', 'partenza');
    @endphp


    <!-- Tabs -->
    <div class="row">
        <div>
            <ul class="nav nav-tabs mb-3 justify-content-end">
                <li class="nav-item">
                    <a class="nav-link {{ $activeTab === 'partenza' ? 'active' : '' }}" data-bs-toggle="tab" href="#partenza">Partenza</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $activeTab === 'rientro' ? 'active' : '' }}" data-bs-toggle="tab" href="#rientro">Rientro</a>
                </li>
            </ul>

        </div>
    </div>

    <div class="tab-content">
        <!-- TAB PARTENZA -->
        <div class="tab-pane fade {{ $activeTab === 'partenza' ? 'show active' : '' }}" id="partenza">
            <h3>Seleziona Dispositivi</h3>


            <form action="{{ route('races.updateDevices', $race) }}" method="POST">
                @csrf

                <!-- Filtri -->
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
                <div style="max-height: 350px; overflow-y: auto;">
                    <table class="table table-bordered table-striped mb-0" id="devicesTable">
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
                                <tr data-model="{{ $device->device_model_id }}" style="cursor:pointer;" onclick="if(event.target.tagName !== 'INPUT'){ let cb = this.querySelector('input[type=checkbox]'); cb.checked = !cb.checked; cb.dispatchEvent(new Event('change')); }">
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
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-success">Aggiorna Dispositivi</button>
                </div>
            </form>
        </div>

        <!-- TAB RIENTRO -->
        <div class="tab-pane fade {{ $activeTab === 'rientro' ? 'show active' : '' }}" id="rientro">
            <h3>Segnala dispositivi mancanti</h3>


            <form action="{{ route('races.markMissing', $race) }}" method="POST">
                @csrf

                <!-- Filtri -->
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="modelFilterReturn" class="form-label">Filtra per modello</label>
                        <select id="modelFilterReturn" class="form-select">
                            <option value="">-- Tutti --</option>
                            @foreach($models as $model)
                                <option value="{{ $model->id }}">{{ $model->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 align-self-end">
                        <label for="deviceSearchReturn" class="form-label">Cerca dispositivo</label>
                        <input type="text" id="deviceSearchReturn" class="form-control" placeholder="Cerca per seriale, IMEI, ICCID o modello...">
                    </div>
                </div>

                <table class="table table-hover table-bordered table-striped" id="missingDevicesTable">
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
                        @foreach($race->devices as $device)
                            <tr data-model="{{ $device->device_model_id }}" style="cursor:pointer;" 
                                onclick="if(event.target.tagName !== 'INPUT'){ 
                                            let cb = this.querySelector('input[type=checkbox]'); 
                                            cb.checked = !cb.checked; 
                                            cb.dispatchEvent(new Event('change')); }">
                                <td>
                                    <input type="checkbox" name="missing[]" value="{{ $device->id }}">
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
                <button type="submit" class="btn btn-danger">Segnala Mancanti</button>
            </form>

            <hr>

            <h3>Dispositivi mancanti registrati</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Dispositivo</th>
                        <th>Gara</th>
                        <th>Stato</th>
                        <th>Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($missingDevices as $missing)
                        <tr>
                            <td>{{ $missing->device->serial }} ({{ $missing->device->imei }})</td>
                            <td>{{ $missing->race->name }}</td>
                            <td>
                                @if($missing->returned)
                                    ✅ Rientrato
                                @else
                                    ❌ Non rientrato
                                @endif
                            </td>
                            <td>
                                @if(!$missing->returned)
                                    <form action="{{ route('races.markReturned', $missing) }}" method="POST">
                                        @csrf
                                        <button class="btn btn-success btn-sm">Segna rientrato</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Script JS per filtro -->
<script>
// Filtro tabella partenza
function filterDevicesTable() {
    let selectedModel = document.getElementById('modelFilter').value.toLowerCase();
    let searchTerm = document.getElementById('deviceSearch').value.toLowerCase();
    document.querySelectorAll('#devicesTable tbody tr').forEach(row => {
        let matchesModel = !selectedModel || row.getAttribute('data-model') === selectedModel;
        let rowText = row.innerText.toLowerCase();
        let matchesSearch = !searchTerm || rowText.includes(searchTerm);
        row.style.display = (matchesModel && matchesSearch) ? '' : 'none';
    });
}

// Filtro tabella rientro
function filterMissingDevicesTable() {
    let selectedModel = document.getElementById('modelFilterReturn').value.toLowerCase();
    let searchTerm = document.getElementById('deviceSearchReturn').value.toLowerCase();
    document.querySelectorAll('#missingDevicesTable tbody tr').forEach(row => {
        let matchesModel = !selectedModel || row.getAttribute('data-model') === selectedModel;
        let rowText = row.innerText.toLowerCase();
        let matchesSearch = !searchTerm || rowText.includes(searchTerm);
        row.style.display = (matchesModel && matchesSearch) ? '' : 'none';
    });
}

document.getElementById('modelFilter').addEventListener('change', filterDevicesTable);
document.getElementById('deviceSearch').addEventListener('input', filterDevicesTable);
document.getElementById('modelFilterReturn').addEventListener('change', filterMissingDevicesTable);
document.getElementById('deviceSearchReturn').addEventListener('input', filterMissingDevicesTable);
</script>
@endsection
