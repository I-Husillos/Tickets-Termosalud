<?php

use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

Route::get('/ticket', [TicketController::class, 'showAll']) -> name('tickets.show');
Route::get('/ticket/add', [TicketController::class, 'showForm']) -> name('tickets.add');
Route::post('/ticket/add', [TicketController::class, 'addTicket']) -> name('tickets.store');
Route::get('/ticket/{id}/edit', [TicketController::class, 'showEditForm']) -> name('tickets.edit');
Route::post('/ticket/{id}/update', [TicketController::class, 'updated']) -> name('tickets.update');
Route::post('/ticket/search', [TicketController::class, 'searchTicket'])->name('tickets.search');
Route::post('/ticket/{id}/delete', [TicketController::class, 'deleted']) -> name('tickets.delete');
