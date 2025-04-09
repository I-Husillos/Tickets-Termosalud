@extends('tickets.app')

@section('title', 'Mis Tickets')

@section('content')
    <h2>Mis Tickets</h2>

    <a href="{{ route('tickets.add') }}" class="btn btn-primary">Crear Nuevo Ticket</a>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @elseif(session('error'))
        <p>{{ session('error') }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Prioridad</th>
                <th>Status</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @if($tickets->isEmpty()) <!-- Si no hay tickets -->
                <tr>
                    <td colspan="5">No has creado ningún ticket todavía.</td> <!-- Mensaje indicando que no hay tickets -->
                </tr>
            @else
                @foreach($tickets as $ticket)
                    <tr>
                        <td>{{ $ticket->id }}</td>
                        <td>{{ $ticket->title }}</td>
                        <td>{{ ucfirst($ticket->priority) }}</td>
                        <td>{{ ucfirst($ticket->status) }}</td>
                        <td>
                            <a href="{{ route('tickets.edit', $ticket->id) }}">Editar</a>
                            
                            <!-- Formulario para eliminar el ticket -->
                            <form action="{{ route('tickets.delete', $ticket->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('POST') <!-- Esto indica que se está realizando un POST para eliminar -->
                                <button type="submit" onclick="return confirm('¿Estás seguro de eliminar este ticket?')" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
@endsection
