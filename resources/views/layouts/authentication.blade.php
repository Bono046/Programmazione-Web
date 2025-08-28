<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Login')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

    <!-- Navbar semplice -->
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand mx-auto" href="{{ route('getLogin') }}">
                Welcome
            </a>
        </div>
    </nav>

    <!-- Contenuto -->
    <main class="flex-fill">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-2 mt-auto">
        <small>&copy; 2025 - PW project - UniBs</small>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
