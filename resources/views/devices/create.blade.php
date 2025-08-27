@extends('layouts.master')

@section('title', 'Aggiungi Device')

@section('content')
<h2>Aggiungi un nuovo Device</h2>

@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $errore)
                <li>{{ $errore }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('devices.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label for="serial" class="form-label">Serial</label>
        <input type="text" name="serial" id="serial" class="form-control" value="{{ old('serial') }}" required>
    </div>

    <div class="mb-3">
        <label for="imei" class="form-label">IMEI</label>
        <input type="text" name="imei" id="imei" class="form-control" value="{{ old('imei') }}">
    </div>

    <div class="mb-3">
        <label for="iccid" class="form-label">ICCID</label>
        <input type="text" name="iccid" id="iccid" class="form-control" value="{{ old('iccid') }}">
    </div>

    <div class="mb-3">
        <label for="device_model_id" class="form-label">Modello</label>
        <select class="form-select" name="device_model_id" id="device_model_id">
            <option value="">-- Seleziona Modello --</option>
            @foreach($deviceModels as $model)
                <option value="{{ $model->id }}" {{ old('device_model_id', $device->device_model_id ?? '') == $model->id ? 'selected' : '' }}>
                    {{ $model->name }}
                </option>
            @endforeach
        </select>
    </div>


    <button type="submit" class="btn btn-success">Salva</button>
    <a href="{{ route('devices.index') }}" class="btn btn-secondary">Annulla</a>
</form>
@endsection
