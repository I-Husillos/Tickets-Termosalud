<?php

use App\Http\Controllers\TicketController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

//login forms
Route::get('/', [HomeController::class, 'showOptions']) -> name('home');

Route::get('login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('login', [UserController::class, 'login'])->name('login.submit');
Route::get('register', [UserController::class, 'showRegisterForm'])->name('register');
Route::post('register', [UserController::class, 'register']);


Route::middleware('auth:user')->prefix('user')->group(function() {
    Route::get('tickets', [TicketController::class, 'showAll'])->name('user.tickets.index');
    Route::get('tickets/create', [TicketController::class, 'create']) -> name('user.tickets.create');
    Route::post('tickets', [TicketController::class, 'store']) -> name('user.tickets.store');
    Route::get('tickets/{ticket}', [TicketController::class, 'show']) -> name('user.tickets.show');

    Route::post('tickets/{ticket}/validate', [TicketController::class, 'validateResolution'])->name('user.tickets.validate');

    Route::post('logout', [UserController::class, 'logOut'])->name('logout');
});



Route::get('/admin/login', [AdminController::class, 'showLoginForm']) -> name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login']) -> name('admin.login.submit');

Route::middleware('auth:admin')->prefix('admin')->group(function() {
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('tickets', [AdminController::class, 'manageTickets'])->name('admin.manage.tickets');
    Route::get('tickets/{ticket}', [AdminController::class, 'viewTicket'])->name('admin.view.ticket');
    Route::patch('tickets/{ticket}/update', [AdminController::class, 'updateTicketStatus'])->name('admin.update.ticket');
    Route::post('tickets/{ticket}/assign', [AdminController::class, 'assignTicket'])->name('admin.assign.ticket');
    Route::post('logout', [AdminController::class, 'logOut'])->name('admin.logout');
});



