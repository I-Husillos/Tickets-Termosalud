<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title', 'Sistema de Tickets')</title>
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    </head>
    <body>
        <header>
            <div class="container">
                <h1>Bienvenido al Sistema de Tickets</h1>
            </div>
        </header>

        <main>
            <div class="container">
                @yield('content')
            </div>
        </main>

    </body>
</html>
