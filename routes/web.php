<?php

use App\Controllers\ApiController;
use App\Controllers\ApprovalController;
use App\Controllers\AuthController;
use App\Controllers\DetailTicketController;
use App\Controllers\HomeController;
use App\Controllers\MaterialController;
use App\Controllers\ReportController;
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
    Route::get('/', [HomeController::class, 'index'])->name('home');
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
    Route::post('/material/import',[MaterialController::class, 'import'])->name('materials.import');
    Route::put('/material/{id}',[MaterialController::class, 'update'])->name('materials.update');
    Route::delete('/material/{id}',[MaterialController::class, 'destroy'])->name('materials.delete');

    // Ticket
    Route::get('/getmaterial/ticket',[TicketController::class,'getMaterial'])->name('ticket.getmaterial');
    Route::get('/tickets',[TicketController::class,'index'])->name('tickets');
    Route::get('/tickets/getdata',[TicketController::class,'getTicket'])->name('tickets.getdata');
    Route::get('/ticket/{id}',[TicketController::class, 'show'])->name('show.ticket');
    Route::post('/tickets',[TicketController::class, 'store'])->name('tickets.create');
    Route::put('/ticket/{id}',[TicketController::class, 'update'])->name('tickets.update');
    Route::delete('/ticket/{id}',[TicketController::class, 'destroy'])->name('tickets.delete');
    Route::get('/ticket/detail/{id}',[TicketController::class, 'DetailTicket'])->name('ticket.detail.get');
    // Detail
    Route::post('/detail/ticket/req',[TicketController::class,'addDetailRequest'])->name('detail.ticket.req');
    Route::post('/detail/ticket/act',[TicketController::class,'addDetailActual'])->name('detail.ticket.act');
    Route::get('/get/detail/{id}',[DetailTicketController::class,'getDetail'])->name('detail.ticket.get');
    Route::get('/get/detailact/{id}',[DetailTicketController::class,'getDetailAct'])->name('detailact.ticket.get');
    Route::post('/detail/request',[DetailTicketController::class,'updateReq'])->name('detail.request.update');
    Route::delete('/detail/request/{id}',[DetailTicketController::class,'destroyReq'])->name('detail.request.delete');
    Route::post('/detail/actual',[DetailTicketController::class,'updateAct'])->name('detail.actual.update');
    Route::delete('/detail/actual/{id}',[DetailTicketController::class,'destroyAct'])->name('detail.actual.delete');

    // Apporval
    Route::get('/ticket-approval',[ApprovalController::class,'index'])->name('appr.index');

    // Report
    Route::get('/report',[ReportController::class,'index'])->name('report');
    // API GET Employee
    Route::post('/emp',[ApiController::class, 'getEmployee'])->name('getemp');
});