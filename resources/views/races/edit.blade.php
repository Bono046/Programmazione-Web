@extends('layouts.master')

@section('content')
<h1>{{ isset($race) && $race->exists ? 'Modifica Gara' : 'Crea Nuova Gara' }}</h1>

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ isset($race) && $race->exists ? route('races.update', $race) : route('races.store') }}" method="POST">
    @csrf
    @if(isset($race) && $race->exists)
        @method('PUT')
    @endif

    <div class="mb-3">
        <label for="name" class="form-label">Nome Gara</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $race->name ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label for="start_date" class="form-label">Data Inizio</label>
        <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date', isset($race) && $race->start_date ? $race->start_date->format('Y-m-d') : '') }}" required>
    </div>

    <div class="mb-3">
        <label for="end_date" class="form-label">Data Fine</label>
        <input type="date" class="form-control" id="end_date" name="end_date" value="{{ old('end_date', isset($race) && $race->end_date ? $race->end_date->format('Y-m-d') : '') }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Descrizione</label>
        <textarea class="form-control" name="description" rows="3">{{ old('description', $race->description ?? '') }}</textarea>
    </div>

    

    <button type="submit" class="btn btn-success">{{ isset($race) && $race->exists ? 'Aggiorna' : 'Salva' }}</button>
    <a href="{{ route('races.index') }}" class="btn btn-secondary">Annulla</a>
</form>
@endsection
