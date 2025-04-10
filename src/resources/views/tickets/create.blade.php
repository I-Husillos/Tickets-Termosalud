@extends('frontoffice.layouts.app')

@section('content')
    <h1>Crear Nuevo Ticket</h1>
    <form action="{{ route('frontoffice.tickets.store') }}" method="POST">
        @csrf
        <div>
            <label for="title">Título</label>
            <input type="text" name="title" required>
        </div>
        <div>
            <label for="description">Descripción</label>
            <textarea name="description" required></textarea>
        </div>
        <div>
            <label for="priority">Prioridad</label>
            <select name="priority">
                <option value="baja">Baja</option>
                <option value="media">Media</option>
                <option value="alta">Alta</option>
                <option value="critica">Crítica</option>
            </select>
        </div>
        <button type="submit">Crear Ticket</button>
    </form>
@endsection
