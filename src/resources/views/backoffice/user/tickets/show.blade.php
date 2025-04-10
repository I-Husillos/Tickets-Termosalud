@extends('layouts.frontoffice')

@section('content')
<div class="container mt-5">
    <h2>Detalle del Ticket</h2>
    <div class="mt-3">
        <p><strong>Título:</strong> {{ $ticket->title }}</p>
        <p><strong>Descripción:</strong> {{ $ticket->description }}</p>
        <p><strong>Tipo:</strong> {{ ucfirst($ticket->type) }}</p>
        <p><strong>Prioridad:</strong> {{ ucfirst($ticket->priority) }}</p>
        <p><strong>Estado:</strong> 
            <span class="badge 
                @if($ticket->status === 'new') badge-primary 
                @elseif($ticket->status === 'resolved') badge-success 
                @elseif($ticket->status === 'pending') badge-warning 
                @else badge-secondary 
                @endif">
                {{ ucfirst($ticket->status) }}
            </span>
        </p>
        <p><strong>Creado el:</strong> {{ $ticket->created_at->format('d/m/Y') }}</p>
    </div>

    @if ($ticket->status === 'resolved')
        <form method="POST" action="{{ route('tickets.validate', $ticket->id) }}" class="mt-4">
            @csrf
            <button type="submit" name="status" value="resolved" class="btn btn-success">Validar Resolución</button>
            <button type="submit" name="status" value="pending" class="btn btn-danger">No Validar</button>
        </form>
    @endif

    <a href="{{ route('tickets.index') }}" class="btn btn-secondary mt-3">Volver a la Lista</a>
</div>
@endsection

