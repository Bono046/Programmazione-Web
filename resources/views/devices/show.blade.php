@extends('layouts.master')

@section('title', 'Dettaglio Device')

@section('content')
<h2>Dettaglio Device</h2>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Serial: {{ $device->serial }}</h5>
        <p class="card-text"><strong>IMEI:</strong> {{ $device->imei }}</p>
        <p class="card-text"><strong>ICCID:</strong> {{ $device->iccid }}</p>
        <p class="card-text"><strong>Modello:</strong> {{ $device->deviceModel?->name ?? 'N/A' }}</p>
        @if($device->category)
            <p class="card-text"><strong>Categoria:</strong> {{ $device->category }}</p>
        @endif
        <a href="{{ route('devices.edit', $device) }}" class="btn btn-warning">Modifica</a>
        <a href="{{ route('devices.index') }}" class="btn btn-secondary">Torna alla lista</a>
    </div>
</div>
@endsection
