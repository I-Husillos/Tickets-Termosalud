@extends('layouts.frontoffice')

@section('title', 'Mis Notificaciones')

@section('content')
<div class="container mt-5">
    <h2 class="text-center">Mis Notificaciones</h2>

    @if ($notifications->isEmpty())
        <p>No tienes notificaciones.</p>
    @else
    <form method="GET" action="{{ route('user.notifications') }}" class="mb-4">
        <div class="form-row">
            <div class="col-md-4">
            <select name="type" class="form-control">
                <option value="">-- Filtrar por tipo --</option>
                <option value="status" {{ request('type') == 'status' ? 'selected' : '' }}>Cambio de estado</option>
                <option value="comment" {{ request('type') == 'comment' ? 'selected' : '' }}>Comentario añadido</option>
            </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Filtrar</button>
            </div>
        </div>
    </form>

        <div class="list-group mt-4">
            @foreach ($notifications as $notification)
                <a href="{{ route('user.tickets.show', $notification->data['ticket_id']) }}" class="list-group-item list-group-item-action
                    @if ($notification->read_at) 
                        list-group-item-light 
                    @else
                        list-group-item-info 
                    @endif
                ">
                    <!-- Mensaje principal -->
                    <strong>{{ $notification->data['message'] }}</strong><br>

                    <!-- Si es cambio de estado -->
                    @isset($notification->data['status'])
                        <p><strong>Nuevo estado:</strong> {{ ucfirst($notification->data['status']) }}</p>
                    @endisset

                    <!-- Si tiene autor -->
                    @isset($notification->data['author'])
                        <p><strong>Autor:</strong> {{ $notification->data['author'] }}</p>
                    @endisset

                    <!-- Si tiene contenido del comentario -->
                    @isset($notification->data['comment'])
                        <p><strong>Comentario:</strong> "{{ $notification->data['comment'] }}"</p>
                    @endisset

                    <!-- Si tiene info del que actualizó -->
                    @isset($notification->data['updated_by'])
                        <p><strong>Actualizado por:</strong> {{ $notification->data['updated_by'] }}</p>
                    @endisset

                    <!-- Fecha -->
                    <small>Recibido: {{ $notification->created_at->format('d/m/Y H:i') }}</small>

                    <!-- Marcar como leído -->
                    @if (!$notification->read_at)
                        <form action="{{ route('user.notifications.read', $notification->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-sm btn-outline-secondary float-right">Marcar como leída</button>
                        </form>
                    @else
                        <span class="badge badge-success float-right">Leído</span>
                    @endif
                </a>
            @endforeach
        </div>
    @endif

    <div class="text-center mt-4">
        <a href="{{ route('user.tickets.index') }}" class="btn btn-secondary">Volver a mis tickets</a>
    </div>
</div>
@endsection
