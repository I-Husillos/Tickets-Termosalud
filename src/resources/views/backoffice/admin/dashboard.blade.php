@extends('layouts.frontoffice')

@section('title', 'Dashboard - Administrador')

@section('content')
<div class="container mt-5">
    <h1 class="text-center">Panel de Administrador</h1>
    <p class="text-center">Bienvenido, {{ Auth::guard('admin')->user()->name }}</p>
    <div class="d-flex justify-content-end mt-4">
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="btn btn-danger">Cerrar Sesión</button>
        </form>
    </div>

    @if ($isSuperAdmin)
        <!-- Si es superadmin, mostrar botones adicionales -->
        <div class="mt-4 text-center">
            <a href="{{ route('admin.manage.tickets') }}" class="btn btn-success">Gestionar Todos los Tickets</a>
        </div>
    @endif

    <div class="mt-4 text-center">
        <a href="{{ route('admin.show.assigned.tickets') }}" class="btn btn-primary btn-lg">Gestionar Tickets Asignados</a>
    </div>
</div>
@endsection


