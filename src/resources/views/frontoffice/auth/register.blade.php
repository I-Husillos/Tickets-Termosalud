@extends('layouts.frontoffice')

@section('title', 'Registrarse')

@section('content')
<div class="container mt-5">
    <h2 class="text-center">Registrarse</h2>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-group mt-3">
            <label for="name">Nombre</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>
        <div class="form-group mt-3">
            <label for="email">Correo Electrónico</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
        </div>
        <div class="form-group mt-3">
            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>
        <div class="form-group mt-3">
            <label for="password_confirmation">Confirmar Contraseña</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary mt-4">Registrarse</button>
    </form>
</div>
@endsection
