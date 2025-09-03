<!DOCTYPE html>
<html lang="it">
<head>
    <link rel="icon" type="image/png" href="{{ asset('img/c.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Progetto Web')</title>

     <!-- jQuery e plugin JavaScript  -->
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="{{ url('/') }}/js/bootstrap.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Icone Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body class="d-flex flex-column min-vh-100">

    <!-- Navbar fissa in alto -->
    <nav class="navbar navbar-dark bg-dark fixed-top">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <button class="btn btn-dark" type="button" data-bs-toggle="offcanvas" data-bs-target="#menuLaterale">
                <i class="bi bi-list" style="font-size: 1.5rem;"></i>
            </button>
            <a class="navbar-brand mx-auto fw-bold" href="{{ route('home') }}">Home</a>
            @if(auth()->check())
                <span class="navbar-text text-white mx-3">
                    {{ auth()->user()->name }}
                </span>
            @endif
            <form method="POST" action="{{ route('logout') }}" >
                @csrf
                <button type="submit" class="btn btn-dark" >
                    <i class="bi bi-box-arrow-right" style="font-size: 1.5rem;"></i>
                </button>
            </form>
        </div>
    </nav>

    <!-- Offcanvas Menu -->
    <style>

    </style>
    <div class="offcanvas offcanvas-start bg-dark text-white shadow" tabindex="-1" id="menuLaterale">
        <div class="offcanvas-header border-bottom border-secondary">
            <h5 class="offcanvas-title fw-semibold">Menu</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Chiudi"></button>
        </div>
        <div class="offcanvas-body px-0">
            <ul class="list-group list-group-flush">
                <li>
                    <a href="{{ route('home') }}" class="list-group-item list-group-item-action bg-dark text-white border-0 ps-4 custom-list-group-item">
                        <i class="bi bi-house-door me-2"></i> Home
                    </a>
                </li>
                <hr class="custom-divider">
                <li>
                    <a href="{{ route('devices.index') }}" class="list-group-item list-group-item-action bg-dark text-white border-0 ps-4 custom-list-group-item">
                        <i class="bi bi-phone me-2"></i> Dispositivi
                    </a>
                </li>
                <hr class="custom-divider">
                <li>
                    <a href="{{ route('races.index') }}" class="list-group-item list-group-item-action bg-dark text-white border-0 ps-4 custom-list-group-item">
                        <i class="bi bi-flag me-2"></i> Gare
                    </a>
                </li>
                @if(auth()->check() && auth()->user()->role === 'admin')
                <hr class="custom-divider">
                <li>
                    <a href="{{ route('users.index') }}" class="list-group-item list-group-item-action bg-dark text-white border-0 ps-4 custom-list-group-item">
                        <i class="bi bi-people me-2"></i> Utenti
                    </a>
                </li>
                @endif
            </ul>
        </div>
    </div>

    <!-- Contenuto principale -->
    <main class="flex-fill container mt-5 pt-5 pb-4">
        @yield('content')
    </main>

    <!-- Footer sempre in basso -->
    <footer class="bg-dark text-white text-center py-3 mt-auto">
        <p class="mb-0">&copy; 2025 - PW project - UniBs</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
