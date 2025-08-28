<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Progetto Web')</title>
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
            <form method="POST" action="{{ route('logout') }}" >
                @csrf
                <button type="submit" class="btn btn-dark" >
                    <i class="bi bi-box-arrow-right" style="font-size: 1.5rem;"></i>
                </button>
            </form>
        </div>
    </nav>

    <!-- Offcanvas Menu -->
    <div class="offcanvas offcanvas-start bg-dark text-white" tabindex="-1" id="menuLaterale">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">Menu</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="list-unstyled">
                <li><a href="{{ route('home') }}" class="text-white text-decoration-none d-block py-2">Home</a></li>
                <li><a href="{{ route('devices.index') }}" class="text-white text-decoration-none d-block py-2">Dispositivi</a></li>
                <li><a href="{{ route('races.index') }}" class="text-white text-decoration-none d-block py-2">Gare</a></li>
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
