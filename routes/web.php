<?php

use App\Controllers\ApiController;
use App\Controllers\AuthController;
use App\Controllers\HomeController;
use App\Controllers\MaterialController;
use App\Controllers\TicketController;
use App\Controllers\UserController;
use Bpjs\Framework\Helpers\AuthMiddleware;
use Bpjs\Framework\Helpers\Route;
use Bpjs\Framework\Helpers\View;

Route::get('/login',[AuthController::class, 'index'])->name('auth.login');
Route::post('/login',[AuthController::class, 'onLogin'])->limit(10)->name('auth.onlogin');

// Route::get('/dashboard')
Route::group([AuthMiddleware::class], function(){
    Route::post('/logout',[AuthController::class, 'logout'])->name('auth.logout');
    Route::get('/', [HomeController::class, 'index']);
    // User
    Route::get('/users',[UserController::class,'index'])->name('users');
    Route::get('/users/getdata',[UserController::class,'getUser'])->name('users.getdata');
    Route::get('/user/{id}',[UserController::class, 'show'])->name('show.user');
    Route::post('/users',[UserController::class, 'create'])->name('users.create');
    Route::put('/user/{id}',[UserController::class, 'update'])->name('users.update');
    Route::delete('/user/{id}',[UserController::class, 'delete'])->name('users.delete');

    // Materials
    Route::get('/materials',[MaterialController::class,'index'])->name('materials');
    Route::get('/materials/getdata',[MaterialController::class,'getMaterial'])->name('materials.getdata');
    Route::get('/material/{id}',[MaterialController::class, 'show'])->name('show.material');
    Route::post('/materials',[MaterialController::class, 'create'])->name('materials.create');
    Route::put('/material/{id}',[MaterialController::class, 'update'])->name('materials.update');
    Route::delete('/material/{id}',[MaterialController::class, 'destroy'])->name('materials.delete');

    // Ticket
    Route::get('/tickets',[TicketController::class,'index'])->name('tickets');
    Route::get('/tickets/getdata',[TicketController::class,'getTicket'])->name('tickets.getdata');
    Route::get('/ticket/{id}',[TicketController::class, 'show'])->name('show.ticket');
    Route::post('/tickets',[TicketController::class, 'create'])->name('tickets.create');
    Route::put('/ticket/{id}',[TicketController::class, 'update'])->name('tickets.update');
    Route::delete('/ticket/{id}',[TicketController::class, 'destroy'])->name('tickets.delete');
    // API GET Employee
    Route::post('/emp',[ApiController::class, 'getEmployee'])->name('getemp');
});