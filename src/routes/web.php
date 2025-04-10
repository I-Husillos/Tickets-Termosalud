<?php

use App\Http\Controllers\TicketController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

//login forms
Route::get('/', [HomeController::class, 'showOptions']) -> name('home');

Route::get('login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('login', [UserController::class, 'login']);
Route::get('register', [UserController::class, 'showRegisterForm'])->name('register');
Route::post('register', [UserController::class, 'register']);


Route::middleware('auth:user')->group(function() {
    Route::get('dashboard', [UserController::class, 'dashboard'])->name('users.dashboard');

    Route::get('tickets', [TicketController::class, 'showAll']) -> name('tickets.index');
    Route::get('tickets/create', [TicketController::class, 'create']) -> name('tickets.create');
    Route::post('tickets', [TicketController::class, 'store']) -> name('tickets.store');
    Route::get('tickets/{ticket}', [TicketController::class, 'show']) -> name('tickets.show');

    Route::post('tickets/{ticket}/validate', [TicketController::class, 'validateResolution'])->name('tickets.validate');

    Route::post('logout', [UserController::class, 'logOut'])->name('logout');
});










Route::get('/admin/login', [AdminController::class, 'showLoginForm']) -> name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login']) -> name('admin.login.submit');

