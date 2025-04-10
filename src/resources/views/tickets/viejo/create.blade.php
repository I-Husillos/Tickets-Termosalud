@extends('tickets.app')

@section('title', 'Crear Ticket')

@section('content')
    <div class="form-container">
        <h2>Crear Nuevo Ticket</h2>
        <form action="{{ route('tickets.store') }}" method="POST">
            @csrf

            <div class="input-group">
                <label for="title">Título:</label>
                <input type="text" name="title" id="title" required>
            </div>

            <div class="input-group">
                <label for="description">Descripción:</label>
                <textarea name="description" id="description" required></textarea>
            </div>

            <div class="input-group">
                <label for="type">Tipo:</label>
                <select name="type" id="type" required>
                    <option value="bug">Bug</option>
                    <option value="improvement">Mejora</option>
                    <option value="request">Solicitud</option>
                </select>
            </div>

            <div class="input-group">
                <label for="priority">Prioridad:</label>
                <select name="priority" id="priority" required>
                    <option value="low">Baja</option>
                    <option value="medium">Media</option>
                    <option value="high">Alta</option>
                </select>
            </div>

            <div class="input-group">
                <label for="status">Estado:</label>
                <select name="status" id="status" required>
                    <option value="new">Nuevo</option>
                    <option value="in_progress">En Progreso</option>
                    <option value="pending">Pendiente</option>
                    <option value="resolved">Resuelto</option>
                    <option value="closed">Cerrado</option>
                </select>
            </div>

            <div class="input-group">
                <label for="user_id">ID de Usuario:</label>
                <input type="number" name="user_id" id="user_id" required>
            </div>

            <div class="input-group">
                <label for="admin_id">ID de Administrador (opcional):</label>
                <input type="number" name="admin_id" id="admin_id">
            </div>

            <div class="input-group">
                <label for="resolved_at">Fecha de Resolución (opcional):</label>
                <input type="date" name="resolved_at" id="resolved_at">
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Crear Ticket</button>
                <a href="{{ route('tickets.show') }}" class="btn btn-secondary">Volver</a>
            </div>
        </form>
    </div>
@endsection
