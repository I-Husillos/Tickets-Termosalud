@extends('layouts.frontoffice')

@section('title', 'Gestionar Tickets')

@section('content')
<div class="container mt-5">
    <h2 class="text-center">Lista de Tickets</h2>
    <div class="d-flex justify-content-end mt-4">
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="btn btn-danger">Cerrar Sesión</button>
        </form>
    </div>
    <form method="GET" action="{{ route('admin.manage.tickets') }}" class="mt-4">
        <div class="form-row">
            <div class="col">
                <select name="status" class="form-control">
                    <option value="">Estado</option>
                    <option value="new">New</option>
                    <option value="in_progress">In Progress</option>
                    <option value="resolved">Resolved</option>
                    <option value="closed">Closed</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>
            <div class="col">
                <select name="priority" class="form-control">
                    <option value="">Prioridad</option>
                    <option value="low">Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>
                    <option value="critical">Critical</option>
                </select>
            </div>
            <div class="col">
                <button type="submit" class="btn btn-primary">Filtrar</button>
            </div>
        </div>
    </form>
    <table class="table table-striped mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Estado</th>
                <th>Prioridad</th>
                <th>Tipo</th>
                <th>Asignado a</th>
                <th style="text-align: center;">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tickets as $ticket)
            <tr>
                <td>{{ $ticket->id }}</td>
                <td>{{ $ticket->title }}</td>
                <td>{{ ucfirst($ticket->status) }}</td>
                <td>{{ ucfirst($ticket->priority) }}</td>
                <td>{{ ucfirst($ticket->type) }}</td>
                <td>{{ $ticket->admin ? $ticket->admin->name : 'Sin Asignar' }}</td>
                <td>
                    <a href="{{ route('admin.view.ticket', $ticket->id) }}" class="btn btn-info btn-sm">Ver Acciones</a>
                </td>
                @if ($ticket->status === 'closed')
                    <td>
                        <form method="POST" action="{{ route('admin.reopen.ticket', $ticket->id) }}">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm">Reabrir ticket</button>
                        </form>
                    </td>
                @else
                    <td>
                        <form method="POST" action="{{ route('admin.close.ticket', $ticket->id) }}">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Cerrar</button>
                        </form>
                    </td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center mt-4">
        {{ $tickets->links('pagination::bootstrap-4') }}
    </div>
    <a href="{{ route('admin.notifications') }}" class="btn btn-warning">
        Notificaciones 
        @if (Auth::user()->unreadNotifications->count() > 0)
            <span class="badge badge-danger">{{ Auth::user()->unreadNotifications->count() }}</span>
        @endif
    </a>
    <div class="text-center mt-4">
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Volver al menú de principal</a>
    </div>
</div>

@endsection
