<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WaitingListController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [RegisteredUserController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [RegisteredUserController::class, 'login'])->middleware('guest');
Route::post('/waiting-list', [WaitingListController::class, 'store']);

Route::middleware(['auth'])->group(function () {
    Route::post('/create-admin', [RegisteredUserController::class, 'createAdmin']);
    Route::post('/logout', [RegisteredUserController::class, 'logout'])->name('logout');
    Route::post('/delete-account', [RegisteredUserController::class, 'deleteAccount'])->name('delete-account');
    
    Route::get('/dashboard', [DashboardController::class, 'dashboard']);
    Route::get('/waiting-list', [DashboardController::class, 'index']);
    Route::get('/waiting-list/stats', [DashboardController::class, 'stats']);

    Route::get('/waiting-list/export', [WaitingListController::class, 'export']);

    Route::get('/waiting-list/{waitingList}', [DashboardController::class, 'show']);
    Route::put('/waiting-list/{waitingList}', [DashboardController::class, 'update']);
    Route::delete('/waiting-list/{waitingList}', [DashboardController::class, 'destroy']);
    
});