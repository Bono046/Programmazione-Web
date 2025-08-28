@extends('layouts.authentication')

@section('title', 'Change Password')

@section('content')
<div class="container container-fluid d-flex justify-content-center align-items-center" style="min-height: 70vh;">
    <div class="card shadow p-4" style="width: 400px; margin-top: 20px;">
        <h2 class="text-center mb-4">Cambia Password</h2>
        <form method="POST" action="{{ route('password.reset') }}">
            @csrf
            
          

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" 
                       class="form-control @error('email') is-invalid @enderror" 
                       id="email" 
                       name="email" 
                       value="{{ old('email') }}" 
                       required autofocus>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


            <!-- Old Password -->
            <div class="mb-3">
                <label for="old_password" class="form-label">Vecchia Password</label>
                <input type="password" 
                       class="form-control @error('old_password') is-invalid @enderror" 
                       id="old_password" 
                       name="old_password" 
                       required>
                @error('old_password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- New Password -->
            <div class="mb-3">
                <label for="password" class="form-label">Nuova Password</label>
                <input type="password" 
                       class="form-control @error('password') is-invalid @enderror" 
                       id="password" 
                       name="password" 
                       required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Conferma Password -->
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Conferma Password</label>
                <input type="password" 
                       class="form-control" 
                       id="password_confirmation" 
                       name="password_confirmation" 
                       required>
            </div>


            <!-- Submit -->
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Cambia Password</button>
            </div>
        </form>
    </div>
</div>
@endsection
