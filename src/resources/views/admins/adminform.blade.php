@extends('layouts.layout')

@section('title', 'Inicio de Sesión - Administrador')

@section('content')
    <div class="form-container">
        <h2>Iniciar sesión como Administrador</h2>
        <form action="{{ route('admin.login.submit') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="email">Correo Electrónico</label>
                <input type="email" id="email" name="email" placeholder="Introduce tu correo" required>
            </div>
            
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" placeholder="Introduce tu contraseña" required>
            </div>

            <button type="submit" class="button admin">Iniciar Sesión</button>
        </form>
        
        <button type="button" onclick="window.history.back();" class="back-button">Volver atrás</button>
    </div>
@endsection
