<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <div class="container">
        <h1>Bienvenido al Sistema de Tickets</h1>
        <p>Por favor, selecciona cómo deseas iniciar sesión:</p>
        
        <div class="card">
            <h2>Iniciar sesión como Usuario</h2>
            <a href="{{ route('login') }}" class="button">Iniciar sesión como Usuario</a>
        </div>
        
        <div class="card">
            <h2>Iniciar sesión como Administrador</h2>
            <a href="{{ route('admin.login') }}" class="button admin">Iniciar sesión como Administrador</a>
        </div>
    </div>
</body>
</html>
