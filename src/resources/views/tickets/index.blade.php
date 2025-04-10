@extends('frontoffice.layouts.app')

@section('content')
    <h1>Mis Tickets</h1>
    <a href="{{ route('frontoffice.tickets.create') }}" class="btn btn-primary">Crear Nuevo Ticket</a>
    <table>
        <thead>
            <tr>
                <th>Título</th>
                <th>Estado</th>
                <th>Prioridad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tickets as $ticket)
                <tr>
                    <td>{{ $ticket->title }}</td>
                    <td>{{ ucfirst($ticket->status) }}</td>
                    <td>{{ ucfirst($ticket->priority) }}</td>
                    <td>
                        <a href="{{ route('frontoffice.tickets.show', $ticket->id) }}" class="btn btn-info">Ver</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
