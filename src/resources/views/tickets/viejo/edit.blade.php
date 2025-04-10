@extends('tickets.app')

@section('title', 'Editar Ticket')

@section('content')
    <h2>Editar Ticket</h2>

    <form action="{{ route('tickets.update', $ticket->id) }}" method="POST">
        @csrf

        <label for="title">Título:</label>
        <input type="text" name="title" id="title" value="{{ $ticket->title }}" required><br><br>

        <label for="description">Descripción:</label>
        <textarea name="description" id="description" required>{{ $ticket->description }}</textarea><br><br>

        <label for="priority">Prioridad:</label>
        <select name="priority" id="priority" required>
            <option value="low" {{ $ticket->priority == 'low' ? 'selected' : '' }}>Baja</option>
            <option value="medium" {{ $ticket->priority == 'medium' ? 'selected' : '' }}>Media</option>
            <option value="high" {{ $ticket->priority == 'high' ? 'selected' : '' }}>Alta</option>
        </select><br><br>

        <label for="status">Estado:</label>
        <select name="status" id="status" required>
            <option value="new" {{ $ticket->status == 'new' ? 'selected' : '' }}>Nuevo</option>
            <option value="in_progress" {{ $ticket->status == 'in_progress' ? 'selected' : '' }}>En Progreso</option>
            <option value="resolved" {{ $ticket->status == 'resolved' ? 'selected' : '' }}>Resuelto</option>
            <option value="closed" {{ $ticket->status == 'closed' ? 'selected' : '' }}>Cerrado</option>
        </select><br><br>

        <button type="submit">Actualizar Ticket</button>
    </form>
@endsection
