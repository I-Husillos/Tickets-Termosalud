@extends('layouts.frontoffice')

@section('title', 'Listado de Tickets')

@section('content')
<div class="container mt-5">
    <h2 class="text-center">Mis Tickets</h2>
    

    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <h3>Lista de Tickets</h3>
        <a href="{{ route('user.tickets.create') }}" class="btn btn-primary">Crear Nuevo Ticket</a>
    </div>

    @if ($tickets->isEmpty())
        <div class="alert alert-info text-center">
            No tienes tickets creados. Haz clic en "Crear Nuevo Ticket" para comenzar.
        </div>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Estado</th>
                    <th>Prioridad</th>
                    <th>Comentarios</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tickets as $ticket)
                    <tr>
                        <td>{{ $ticket->id }}</td>
                        <td>{{ $ticket->title }}</td>
                        <td>
                            <span class="badge 
                                @if($ticket->status === 'new') badge-primary 
                                @elseif($ticket->status === 'resolved') badge-success 
                                @elseif($ticket->status === 'pending') badge-warning 
                                @else badge-secondary 
                                @endif">
                                {{ ucfirst($ticket->status) }}
                            </span>
                        </td>
                        <td>{{ ucfirst($ticket->priority) }}</td>
                        <td>{{ $ticket->comments->count() }}</td>
                        <td>{{ $ticket->created_at->format('d/m/Y') }}</td>
                        <td>
                            <a href="{{ route('user.tickets.show', $ticket->id) }}" class="btn btn-info btn-sm">Ver Detalles</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('user.notifications') }}" class="nav-link">Mis Notificaciones</a>

    @endif

    <div class="d-flex justify-content-end mt-4">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-danger">Cerrar Sesión</button>
        </form>
    </div>
</div>
@endsection

