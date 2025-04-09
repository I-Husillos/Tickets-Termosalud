<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Aplicación Laravel')</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>


<body>
    <header>
        <div class="container">
            <h1>Mi Aplicación Laravel</h1>
            <nav>
                <a href="{{ route('tickets.show') }}" class="nav-link">Inicio</a>
                <a href="{{ route('tickets.add') }}" class="nav-link">Crear Ticket</a>
            </nav>
        </div>
    </header>

    <main>
        <div class="container">
            @yield('content') <!-- Aquí se insertará el contenido de cada vista específica -->
        </div>
    </main>

    <footer>
        <div class="container">
            <p>&copy; {{ date('Y') }} - Mi Aplicación Laravel</p>
        </div>
    </footer>
</body>

</html>
