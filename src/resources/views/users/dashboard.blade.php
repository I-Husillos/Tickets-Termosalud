@extends('layouts.layout')

@section('title', 'Dashboard de Usuario')

@section('content')
    <div class="dashboard-container">
        <h2>Bienvenido, {{ Auth::user()->name }}</h2>
        <h3>Tus Tickets</h3>

        <div class="ticket-list">
            @foreach($tickets as $ticket)
                <div class="ticket">
                    <h4>{{ $ticket->title }}</h4>
                    <p>{{ $ticket->description }}</p>
                    <p>Status: {{ $ticket->status }}</p>
                    <a href="{{ route('ticket.show', $ticket->id) }}" class="button">Ver detalles</a>
                </div>
            @endforeach
        </div>

        <a href="{{ route('ticket.create') }}" class="button">Crear un nuevo ticket</a>
    </div>
@endsection
