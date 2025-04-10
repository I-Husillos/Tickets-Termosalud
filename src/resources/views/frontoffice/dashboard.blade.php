@extends('layouts.frontoffice') <!-- Utiliza tu layout base para la interfaz del usuario -->

@section('title', 'Dashboard')

@section('content')
<div class="container mt-5">
    <!-- Bienvenida al usuario -->
    <h2 class="text-center">Bienvenido, {{ Auth::user()->name }}</h2>

    <!-- Enlace para crear un nuevo ticket -->
    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <h3>Tus Tickets</h3>
        <a href="{{ route('tickets.create') }}" class="btn btn-primary">Crear Nuevo Ticket</a>
    </div>

    <!-- Mostrar lista de tickets del usuario -->
    @if ($tickets->isEmpty())
        <div class="alert alert-info">No tienes tickets creados. Haz clic en "Crear Nuevo Ticket" para comenzar.</div>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Estado</th>
                    <th>Prioridad</th>
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
                        <td>{{ $ticket->created_at->format('d/m/Y') }}</td>
                        <td>
                            <a href="{{ route('tickets.show', $ticket->id) }}" class="btn btn-info btn-sm">Ver Detalles</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
    @endif
</div>
@endsection
