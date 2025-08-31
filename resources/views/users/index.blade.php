@extends('layouts.master')

@section('content')
<h1>Utenti</h1>

@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $errore)
                <li>{{ $errore }}</li>
            @endforeach
        </ul>
    </div>
@endif

<a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Nuovo Utente</a>

<div class="table-responsive">
 <table class="table table-hover align-middle text-center">
    <thead class="table-dark">
        <tr>
            <th scope="col">Nome</th>
            <th scope="col">Email</th>
            <th scope="col">Ruolo</th>
            <th scope="col">Azioni</th>
        </tr>
    </thead>
 <tbody>
    @foreach($users as $user)
    <tr class="align-middle">
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>
            <span class="badge 
                @if($user->role === 'admin') bg-info
                @elseif($user->role === 'user') bg-primary
                @else bg-secondary @endif">
                {{ ucfirst($user->role) }}
            </span>
        </td>
        <td>
            @if($user->role !== 'admin' || $user->id === auth()->user()->id || auth()->user()->id == 1)
                <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-warning me-1">
                    <i class="bi bi-pencil-square"></i> Modifica
                </a>
                <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('Sei sicuro?');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">
                        <i class="bi bi-trash"></i> Elimina
                    </button>
                </form>
            @else
                <span class="text-muted"></span>
            @endif
        </td>
    </tr>
    @endforeach
</tbody>

</table>

</div>
@endsection
