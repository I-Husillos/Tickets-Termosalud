@extends('layouts.frontoffice')

@section('title', 'Panel del Técnico')

@section('content')
<div class="container mt-5">
    <h2 class="text-center">Bienvenido, {{ Auth::guard('admin')->user()->name }}</h2>

    <div class="d-flex justify-content-end mt-4">
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="btn btn-danger">Cerrar Sesión</button>
        </form>
    </div>

    {{-- Notificaciones --}}
    <div class="mt-5">
        <h4>Notificaciones recientes</h4>

        @if($notifications->isEmpty())
            <div class="alert alert-info">No tienes notificaciones.</div>
        @else
            <ul class="list-group">
                @foreach($notifications as $notification)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <strong>{{ $notification->data['title'] }}</strong><br>
                            {{ $notification->data['message'] }}<br>
                            <small>Creado por: {{ $notification->data['created_by'] }}</small>
                        </div>
                        <span class="badge badge-light">
                            {{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}
                        </span>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    {{-- Tabla de tickets --}}
    <div class="mt-5">
        <h3>Todos los Tickets</h3>
        @if ($tickets->isEmpty())
            <div class="alert alert-info">No hay tickets por el momento.</div>
        @else
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Estado</th>
                        <th>Prioridad</th>
                        <th>Creado por</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tickets as $ticket)
                        <tr>
                            <td>{{ $ticket->id }}</td>
                            <td>{{ $ticket->title }}</td>
                            <td>{{ ucfirst($ticket->status) }}</td>
                            <td>{{ ucfirst($ticket->priority) }}</td>
                            <td>{{ $ticket->user->name ?? 'Sin asignar' }}</td>
                            <td>{{ $ticket->created_at->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('admin.view.ticket', $ticket->id) }}" class="btn btn-info btn-sm">Ver</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection
