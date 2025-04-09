@extends('layouts.layout')

@section('title', 'Inicio de Sesión - Usuario')

@section('content')
    <div class="form-container">
        <h2>Iniciar sesión como Usuario</h2>
        <form action="{{ route('login.submit') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="email">Correo Electrónico</label>
                <input type="email" id="email" name="email" placeholder="Introduce tu correo" required>
            </div>
            
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" placeholder="Introduce tu contraseña" required>
            </div>

            <button type="submit" class="button">Iniciar Sesión</button>

        </form>
        <button type="button" onclick="window.history.back();" class="back-button">Volver atrás</button>
    </div>
@endsection
