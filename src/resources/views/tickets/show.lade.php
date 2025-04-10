@extends('frontoffice.layouts.app')

@section('content')
    <h1>{{ $ticket->title }}</h1>
    <p>{{ $ticket->description }}</p>
    <p><strong>Estado:</strong> {{ ucfirst($ticket->status) }}</p>
    <p><strong>Prioridad:</strong> {{ ucfirst($ticket->priority) }}</p>

    <h3>Comentarios</h3>
    @foreach($ticket->comments as $comment)
        <p><strong>{{ $comment->author->name }}:</strong> {{ $comment->message }}</p>
    @endforeach

    <form action="{{ route('frontoffice.tickets.addComment', $ticket->id) }}" method="POST">
        @csrf
        <textarea name="message" required></textarea><br>
        <button type="submit">Añadir comentario</button>
    </form>

    @if($ticket->status === 'resuelto')
        <form action="{{ route('frontoffice.tickets.resolve', $ticket->id) }}" method="POST">
            @csrf
            <button type="submit">Confirmar Resolución</button>
        </form>
    @elseif($ticket->status === 'pendiente')
        <form action="{{ route('frontoffice.tickets.resolve', $ticket->id) }}" method="POST">
            @csrf
            <button type="submit">Rechazar Resolución</button>
        </form>
    @endif
@endsection
