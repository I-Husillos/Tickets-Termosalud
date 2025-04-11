@extends('layouts.frontoffice')

@section('title', 'Inicio de Sesión - Administrador')

@section('content')
<div class="container mt-5">
    <h2 class="text-center text-primary">Iniciar sesión como Administrador</h2>
    <form action="{{ route('admin.login.submit') }}" method="POST" class="mt-4">
        @csrf
        
        <div class="mb-3">
            <label for="email" class="form-label">Correo Electrónico</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Introduce tu correo" required>
        </div>
        
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Introduce tu contraseña" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Iniciar Sesión</button>
    </form>

    <div class="text-center mt-4">
        <button type="button" onclick="window.location.href='{{ route('home') }}';" class="btn btn-secondary">Volver a Inicio</button>
    </div>
</div>
@endsection
