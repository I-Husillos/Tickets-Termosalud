@extends('layouts.frontoffice')

@section('title', 'Registrarse')

@section('content')
<div class="container mt-5">
    <h2 class="text-center text-primary">Registrarse</h2>
    <form method="POST" action="{{ route('register') }}" class="mt-4">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Correo Electrónico</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Registrarse</button>
    </form>

    <div class="text-center mt-4">
        <a href="{{ route('login') }}" class="btn btn-secondary">Volver al Inicio</a>
    </div>
</div>
@endsection

