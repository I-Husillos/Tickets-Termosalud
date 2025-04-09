<?php

use App\Http\Controllers\TicketController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

//login forms
Route::get('/', [HomeController::class, 'showOptions']) -> name('home');


Route::get('/login', [UserController::class, 'showLoginForm']) -> name('login');
Route::post('/login', [UserController::class, 'login']) -> name('login.submit');

Route::get('/admin/login', [AdminController::class, 'showLoginForm']) -> name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login']) -> name('admin.login.submit');


Route::middleware('auth:user')->group( function(){
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('');
});

Route::get('/ticket', [TicketController::class, 'showAll']) -> name('tickets.show');
Route::get('/ticket/add', [TicketController::class, 'showForm']) -> name('tickets.add');
Route::post('/ticket/add', [TicketController::class, 'addTicket']) -> name('tickets.store');
Route::get('/ticket/{id}/edit', [TicketController::class, 'showEditForm']) -> name('tickets.edit');
Route::post('/ticket/{id}/update', [TicketController::class, 'updated']) -> name('tickets.update');
Route::post('/ticket/search', [TicketController::class, 'searchTicket'])->name('tickets.search');
Route::post('/ticket/{id}/delete', [TicketController::class, 'deleted']) -> name('tickets.delete');





/*
1. frontoffice
Usuario (Empleados):
    • Registro e inicio de sesión.
    • Crear nuevos tickets.
    • Ver el listado de tickets y comentarios propios.
    • Añadir comentarios a los tickets.
    • Validar resoluciones de tickets:
        ◦ Si no se valida, el estado pasa de "resuelto" a "pendiente".
    • Mostrar notificaciones sobre cambios en estado o comentarios en sus tickets.
2. backoffice
Panel General Interno:
    • Punto de entrada para roles internos.
    • Acceso a:
        ◦ backoffice/admin: Administradores.
        ◦ backoffice/user: Usuarios internos.
    • Resumen básico de tickets abiertos o asignados (opcional).
3. backoffice/admin
Administradores (Técnicos):
    • Ver todos los tickets del sistema.
    • Filtrar tickets por estado, prioridad o tipo.
    • Actualizar estado y prioridad de tickets:
        ◦ Transiciones permitidas:
            ▪ nuevo → en curso.
            ▪ en curso → pendiente | resuelto.
            ▪ pendiente → en curso.
            ▪ resuelto → cerrado.
    • Añadir comentarios y cerrar tickets.
    • Asignar y reasignar tickets.
    • Notificaciones sobre la creación de nuevos tickets o comentarios en los tickets asignados.
4. backoffice/user
Usuarios Internos:
    • Ver los tickets asignados al usuario.
    • Añadir comentarios en los tickets asignados.
    • Cambiar el estado de los tickets asignados según las transiciones permitidas.
5. backoffice/user/tickets
Gestión Detallada de Tickets Asignados:
    • Mostrar detalles específicos de los tickets asignados:
        ◦ Estado, prioridad y descripción.
        ◦ Historial de comentarios.
    • Añadir comentarios al ticket.
    • Actualizar el estado del ticket (si está permitido).

*/
