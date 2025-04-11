<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center text-primary">Bienvenido al Sistema de Tickets</h1>
        <p class="text-center text-muted">Por favor, selecciona cómo deseas iniciar sesión:</p>

        <div class="row justify-content-center mt-4">
            <div class="col-md-6 mb-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-center">Iniciar sesión como Usuario</h5>
                        <a href="{{ route('login') }}" class="btn btn-primary d-block mt-3">Iniciar sesión como Usuario</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-center">Iniciar sesión como Administrador</h5>
                        <a href="{{ route('admin.login') }}" class="btn btn-danger d-block mt-3">Iniciar sesión como Administrador</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enlace al JavaScript de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
