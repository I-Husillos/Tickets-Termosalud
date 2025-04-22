@extends('layouts.frontoffice')

@section('title', 'Detalles del Ticket')

@section('content')
<div class="container mt-5">
    <h2>Detalles del Ticket #{{ $ticket->id }}</h2>
    <ul class="list-group mt-4">
        <li class="list-group-item"><strong>Título:</strong> {{ $ticket->title }}</li>
        <li class="list-group-item"><strong>Descripción:</strong> {{ $ticket->description }}</li>
        <li class="list-group-item"><strong>Estado:</strong> {{ ucfirst($ticket->status) }}</li>
        <li class="list-group-item"><strong>Prioridad:</strong> {{ ucfirst($ticket->priority) }}</li>
    </ul>
    
    <div class="mt-4">
        <form action="{{ route('admin.update.ticket', $ticket->id) }}" method="POST">
            @csrf
            @method('PATCH')

            @php
                // Definir las transiciones válidas según el estado actual del ticket
                $allowedStatusTransitions = match($ticket->status) {
                    'new' => ['in_progress'],  // nuevo -> en curso
                    'in_progress' => ['pending', 'resolved'],  // en curso -> pendiente | resuelto
                    'pending' => ['in_progress'],  // pendiente -> en curso
                    'resolved' => ['closed'],  // resuelto -> cerrado
                    default => [],
                };
            @endphp
            
            <div class="form-group">
                <label for="status">Actualizar Estado</label>
                <select name="status" id="status" class="form-control">
                    <option value="">Seleccionar...</option>
                    @foreach($allowedStatusTransitions as $status)
                        <option value="{{ $status }}" {{ $ticket->status == $status ? 'selected' : '' }}>
                            {{ ucfirst(str_replace('_', ' ', $status)) }}
                        </option>
                    @endforeach
                    @if ($ticket->status != 'resolved')
                        <option value="resolved">Resolved</option>
                    @endif
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>

            <div class="form-group mt-3">
                <label for="priority">Actualizar Tipo</label>
                <select name="type" id="type" class="form-control">
                    <option value="bug" {{ $ticket->type == 'bug' ? 'selected' : '' }}>Bug</option>
                    <option value="improvement" {{ $ticket->type == 'improvement' ? 'selected' : '' }}>Improvement</option>
                    <option value="request" {{ $ticket->type == 'request' ? 'selected' : '' }}>Request</option>
                    <option value="other">Other</option> <!-- Siempre muestra la opción Other -->
                </select>
            </div>

            <div class="form-group mt-3">
                <label for="priority">Actualizar Prioridad</label>
                <select name="priority" id="priority" class="form-control">
                    <option value="low" {{ $ticket->priority == 'low' ? 'selected' : '' }}>Baja</option>
                    <option value="medium" {{ $ticket->priority == 'medium' ? 'selected' : '' }}>Media</option>
                    <option value="high" {{ $ticket->priority == 'high' ? 'selected' : '' }}>Alta</option>
                    <option value="critical" {{ $ticket->priority == 'critical' ? 'selected' : '' }}>Crítica</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success mt-3">Actualizar Ticket</button>
        </form>
    </div>

    @if (Auth::guard('admin')->user()->superadmin) <!-- Solo si el usuario es un superadmin -->
    <div class="mt-4">
        <form action="{{ route('admin.assign.ticket', $ticket->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="admin_id">Reasignar a Administrador</label>
                <select name="admin" id="admin_id" class="form-control">
                    @foreach ($admins as $admin)
                        <option value="{{ $admin->id }}" {{ $ticket->admin_id == $admin->id ? 'selected' : '' }}>
                            {{ $admin->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-warning mt-3">Reasignar</button>
        </form>
    </div>
    @endif

    <div class="mt-5">
        <h4>Comentarios</h4>

        @if ($ticket->comments->isEmpty())
            <p class="text-muted">No hay comentarios para este ticket.</p>
        @else
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Autor</th>
                        <th>Mensaje</th>
                        <th>Fecha</th>
                        <th>Acciones</th> <!-- Opcional para eliminar comentarios -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ticket->comments as $comment)
                        <tr>
                            <td>{{ $comment->author->name }}</td>
                            <td>{{ $comment->message }}</td>
                            <td>{{ $comment->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                {{-- Botón para eliminar comentario --}}
                                <form method="POST" action="{{ route('admin.delete.comment', $comment->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <div class="mt-4">
        <h5>Añadir un Comentario</h5>
        <form method="POST" action="{{ route('admin.add.comment', $ticket->id) }}">
            @csrf
            <div class="form-group">
                <textarea name="message" class="form-control" rows="4" placeholder="Escribe tu comentario aquí..." required></textarea>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Añadir Comentario</button>
        </form>
    </div>

    <div class="text-center mt-4">
        <a href="{{ route('admin.manage.tickets') }}" class="btn btn-secondary">Volver al menú de gestión</a>
    </div>
</div>

@endsection


