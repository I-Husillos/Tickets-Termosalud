@extends('layouts.frontoffice')

@section('title', 'Detalles del Ticket')

@section('content')
<div class="container mt-5">
    <h2>Detalles del Ticket #{{ $ticket->id }}</h2>
    <div class="row">
        <div class="col-md-6">
            <ul class="list-group mt-4">
                <li class="list-group-item"><strong>Título:</strong> {{ $ticket->title }}</li>
                <li class="list-group-item"><strong>Descripción:</strong> {{ $ticket->description }}</li>
                <li class="list-group-item"><strong>Estado:</strong> {{ ucfirst($ticket->status) }}</li>
                <li class="list-group-item"><strong>Prioridad:</strong> {{ ucfirst($ticket->priority) }}</li>
                <li class="list-group-item"><strong>Tipo:</strong> {{ ucfirst($ticket->type) }}</li>
                <li class="list-group-item"><strong>Asignado a:</strong> {{ $ticket->admin ? $ticket->admin->name : 'Sin Asignar' }}</li>
                <li class="list-group-item"><strong>Fecha de Creación:</strong> {{ $ticket->created_at->format('d/m/Y') }}</li>
                <li class="list-group-item"><strong>Fecha de la última Actualización:</strong> {{ $ticket->updated_at->format('d/m/Y') }}</li>
            </ul>
        </div>
        <div class="col-md-6">
            <form action="{{ route('admin.update.ticket', $ticket->id) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="form-group">
                    <label for="status">Estado</label>
                    <select name="status" id="status" class="form-control">
                        <option value="">Seleccionar...</option>
                        @foreach(['new', 'in_progress', 'pending', 'resolved', 'closed'] as $status)
                            <option value="{{ $status }}" {{ $ticket->status == $status ? 'selected' : '' }}>
                                {{ ucfirst($status) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="priority">Prioridad</label>
                    <select name="priority" id="priority" class="form-control">
                        <option value="">Seleccionar...</option>
                        @foreach(['low', 'medium', 'high', 'critical'] as $priority)
                            <option value="{{ $priority }}" {{ $ticket->priority == $priority ? 'selected' : '' }}>
                                {{ ucfirst($priority) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="type">Tipo</label>
                    <select name="type" id="type" class="form-control">
                        <option value="">Seleccionar...</option>
                        @foreach(['bug', 'improvement', 'request', 'other'] as $type)
                            <option value="{{ $type }}" {{ $ticket->type == $type ? 'selected' : '' }}>
                                {{ ucfirst($type) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                @if (Auth::guard('admin')->user()->superadmin)
                <div class="form-group">
                    <label for="assigned_to">Asignado a</label>
                    <select name="assigned_to" id="assigned_to" class="form-control">
                        <option value="">Sin Asignar</option>
                        @foreach($admins as $admin)
                            <option value="{{ $admin->id }}" {{ $ticket->admin_id == $admin->id ? 'selected' : '' }}>
                                {{ $admin->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @endif

                <div class="form-group">
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

                    <div class="form-group">
                        <h5>Añadir un Comentario</h5>
                            <form method="POST" action="{{ route('admin.add.comment', $ticket->id) }}">
                                @csrf
                                <div class="form-group">
                                    <textarea name="message" class="form-control" rows="4" placeholder="Escribe tu comentario aquí..." required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Añadir Comentario</button>
                            </form>
                    </div>
                </div>
                
                <div class="mt-4"></div>

                <div class="form-group">
                    <form method="POST" action="{{ route('admin.update.ticket', $ticket->id) }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </form>
                </div>
            </form>
        </div>
        <div class="text-center mt-5">
                <a href="{{ route('admin.manage.tickets') }}" class="btn btn-secondary">Volver al menú de principal</a>
            </div>
    </div>
</div>
@endsection

