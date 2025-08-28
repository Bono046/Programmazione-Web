@extends('layouts.authentication')

@section('title', 'Change Password')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 70vh;">
    <div class="card shadow p-4" style="width: 400px;">
        <h2 class="text-center mb-4">Cambia Password</h2>
        <form method="POST" action="{{ route('password.update') }}">
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

            <!-- old Password -->
            <div class="mb-3">
                <label for="old_password" class="form-label">Old Password</label>
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
                <label for="new_password" class="form-label">New Password</label>
                <input type="password" 
                       class="form-control @error('new_password') is-invalid @enderror" 
                       id="new_password" 
                       name="new_password" 
                       required>
                @error('new_password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
           


            <!-- Submit -->
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Cambia Password</button>
            </div>
        </form>
    </div>
</div>
@endsection
