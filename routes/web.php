<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\TicketController;

Route::get('/', function () {
    return redirect('/user/dashboard');
});

// USER
Route::get('/user/dashboard', [TicketController::class, 'userIndex']);

// TICKET USER
Route::get('/tickets/create', [TicketController::class, 'create']);
Route::post('/tickets', [TicketController::class, 'store']);

// IT SUPPORT
Route::get('/tickets', [TicketController::class, 'index']);
Route::post('/tickets/{id}/process', [TicketController::class, 'process']);
Route::post('/tickets/{id}/resolve', [TicketController::class, 'resolve']);
Route::post('/tickets/{id}/close', [TicketController::class, 'close']);

// SWITCH MODE (SIMULASI ROLE)
Route::get('/switch-to-it', function () {
    Session::put('mode', 'it');
    return redirect('/tickets');
});

Route::get('/switch-to-user', function () {
    Session::put('mode', 'user');
    return redirect('/user/dashboard');
});

// DETAIL TICKET
Route::get('/tickets/{id}', [TicketController::class, 'show']);