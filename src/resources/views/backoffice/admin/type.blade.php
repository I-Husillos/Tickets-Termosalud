@extends('layouts.frontoffice')

@section('title', 'Ingrese el tipo de ticket personalizado')

@section('content')
<div class="container mt-5">
    <h2>Ingrese el tipo de ticket personalizado</h2>

    @if (session('info'))
        <div class="alert alert-info">{{ session('info') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.types.store') }}">
        @csrf

        <div class="form-group">
            <label for="name">Nombre del tipo personalizado</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        @if (session('ticket_id'))
            <input type="hidden" name="ticket_id" value="{{ session('ticket_id') }}">
        @endif

        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('admin.view.ticket', session('ticket_id')) }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
