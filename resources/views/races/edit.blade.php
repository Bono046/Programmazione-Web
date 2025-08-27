@extends('layouts.master')

@section('content')
<h1>Modifica Gara</h1>

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $errore)
                <li>{{ $errore }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('races.update', $race) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="name" class="form-label">Nome Gara</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $race->name) }}" required>
    </div>

    <div class="mb-3">
        <label for="start_date" class="form-label">Data Inizio</label>
        <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date', $race->start_date->format('Y-m-d')) }}" required>
    </div>

    <div class="mb-3">
        <label for="end_date" class="form-label">Data Fine</label>
        <input type="date" class="form-control" id="end_date" name="end_date" value="{{ old('end_date', $race->end_date->format('Y-m-d')) }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Dispositivi</label>
        <div class="border p-2 rounded" style="max-height: 200px; overflow-y: auto;">
            @foreach($devices as $device)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="devices[]" value="{{ $device->id }}" id="device_{{ $device->id }}"
                        {{ $race->devices->contains($device->id) ? 'checked' : '' }}>
                    <label class="form-check-label" for="device_{{ $device->id }}">
                        {{ $device->imei }}
                    </label>
                </div>
            @endforeach
        </div>
    </div>

    <button type="submit" class="btn btn-success">Aggiorna</button>
    <a href="{{ route('races.index') }}" class="btn btn-secondary">Annulla</a>
</form>
@endsection
