@extends('layouts.frontoffice')

@section('title', 'Detalles del Ticket')

@section('content')
<div class="container mt-5">
    <h2>Detalles del Ticket #{{ $ticket->id }}</h2>
    <ul class="list-group mt-4">
        <li class="list-group-item"><strong>Título:</strong> {{ $ticket->title }}</li>
        <li class="list-group-item"><strong>Descripción:</strong> {{ $ticket->description }}</li>
        <li class="list-group-item"><strong>Estado:</strong> {{ ucfirst($ticket->status) }}</li>
        <li class="list-group-item"><strong>Prioridad:</strong> {{ ucfirst($ticket->priority) }}</li>
    </ul>
    <div class="mt-4">
        <form action="{{ route('admin.update.ticket', $ticket->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="status">Actualizar Estado</label>
                <select name="status" id="status" class="form-control">
                    <option value="in_progress">En Curso</option>
                    <option value="pending">Pendiente</option>
                    <option value="resolved">Resuelto</option>
                    <option value="closed">Cerrado</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success mt-3">Actualizar</button>
        </form>
    </div>
    <div class="mt-4">
        <form action="{{ route('admin.assign.ticket', $ticket->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="admin_id">Reasignar a Administrador</label>
                <select name="admin_id" id="admin_id" class="form-control">
                    @foreach ($admins as $admin)
                    <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-warning mt-3">Reasignar</button>
        </form>
    </div>
</div>
@endsection
