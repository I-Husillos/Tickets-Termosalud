@extends('layouts.frontoffice')

@section('title', 'Iniciar Sesión')

@section('content')
<div class="container mt-5">
    <h2 class="text-center">Iniciar Sesión</h2>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group mt-3">
            <label for="email">Correo Electrónico</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
        </div>
        <div class="form-group mt-3">
            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary mt-4">Iniciar Sesión</button>
    </form>
</div>
@endsection
