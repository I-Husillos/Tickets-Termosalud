@extends('layouts.frontoffice')

@section('title', 'Dashboard - Administrador')

@section('content')
<div class="container mt-5">
    <h1 class="text-center">Panel de Administrador</h1>
    <p class="text-center">Bienvenido, {{ Auth::guard('admin')->user()->name }}</p>
    <div class="mt-4 text-center">
        <a href="{{ route('admin.manage.tickets') }}" class="btn btn-primary btn-lg">Gestionar todos los Tickets</a>
    </div>
    <div class="mt-4 text-center">
        <a href="{{ route('admin.manage.tickets') }}" class="btn btn-primary btn-lg">Gestionar Tickets Asignados</a>
    </div>
</div>
@endsection


