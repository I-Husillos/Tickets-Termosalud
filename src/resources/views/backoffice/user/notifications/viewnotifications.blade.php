@extends('layouts.frontoffice')

@section('title', 'Mis Notificaciones')

@section('content')
<div class="container mt-5">
    <h2>Mis Notificaciones</h2>

    @if ($notifications->isEmpty())
        <p class="text-muted">No tienes notificaciones.</p>
    @else
        <ul class="list-group mt-4">
            @foreach ($notifications as $notification)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <strong>{{ $notification->data['title'] }}</strong><br>
                        <p>{{ $notification->data['message'] }}</p>
                        <small class="text-muted">Recibido: {{ $notification->created_at->format('d/m/Y H:i') }}</small>
                    </div>
                    <div class="ml-3">
                        @if (!$notification->read_at)
                            <form action="{{ route('user.notifications.read', $notification->id) }}" method="POST" class="d-inline-block">
                                @csrf
                                <button type="submit" class="btn btn-info btn-sm">Marcar como leído</button>
                            </form>
                        @else
                            <span class="badge bg-success">Leído</span>
                        @endif
                        @if (isset($notification->data['ticket_id']))
                            <a href="{{ route('user.tickets.show', $notification->data['ticket_id']) }}" class="btn btn-link btn-sm">Ver Ticket</a>
                        @endif
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
    <div class="text-center mt-4">
        <a href="{{ route('user.tickets.index') }}" class="btn btn-secondary">Volver a la lista de tickets</a>
    </div>
</div>
@endsection

