@extends('layouts.frontoffice')

@section('title', 'Notificaciones')

@section('content')
<div class="container mt-5">
    <h2 class="text-center">Notificaciones</h2>

    @if ($notifications->isEmpty())
        <p>No tienes notificaciones.</p>
    @else
        <div class="list-group mt-4">
            @foreach ($notifications as $notification)
                <a href="{{ route('admin.view.ticket', $notification->data['ticket_id']) }}" class="list-group-item list-group-item-action
                    @if ($notification->read_at) 
                        list-group-item-secondary 
                    @else
                        list-group-item-primary 
                    @endif
                ">
                    <strong>{{ $notification->data['message'] }}</strong><br>
                    <small>{{ $notification->created_at->format('d/m/Y H:i') }}</small>

                    @if (!$notification->read_at)
                        <form action="{{ route('admin.notifications.read', $notification->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-sm btn-outline-secondary float-right">Marcar como leída</button>
                        </form>
                    @endif
                </a>
            @endforeach
        </div>
    @endif

    <div class="text-center mt-4">
        <a href="{{ route('admin.manage.tickets') }}" class="btn btn-secondary">Volver a la gestión de tickets</a>
    </div>
</div>
@endsection
