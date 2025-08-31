@extends('layouts.master')
@php
    $isEdit = isset($user);
@endphp


@section('content')
<h2>{{ $isEdit ? 'Modifica Utente' : 'Aggiungi un nuovo Utente' }}</h2>

@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $errore)
                <li>{{ $errore }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ $isEdit ? route('users.update', $user) : route('users.store') }}" method="POST">
    @csrf
    @if($isEdit)
        @method('PUT')
    @endif

    <div class="mb-3">
        <label class="form-label">Nome</label>
        <input type="text" name="name" class="form-control" 
               value="{{ old('name', $user->name ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" 
               value="{{ old('email', $user->email ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Password {{ $isEdit ? '(lascia vuoto per non cambiare)' : '' }}</label>
        <input type="password" name="password" class="form-control" {{ $isEdit ? '' : 'required' }}>
    </div>

    <div class="mb-3">
        <label class="form-label">Conferma Password {{ $isEdit ? '' : '' }}</label>
        <input type="password" name="password_confirmation" class="form-control" {{ $isEdit ? '' : 'required' }}>
    </div>

    <div class="mb-3">
        <label class="form-label">Ruolo</label>
        <select name="role" class="form-select">
        @foreach($roles as $role)
            <option value="{{ $role }}">{{ ucfirst($role) }}</option>
        @endforeach
        </select>
    </div>

    <button class="btn btn-success" type="submit">{{ $isEdit ? 'Aggiorna' : 'Salva' }}</button>
</form>
@endsection