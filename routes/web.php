<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WaitingListController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AgreementController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [RegisteredUserController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [RegisteredUserController::class, 'login'])->middleware('guest');
Route::post('/waiting-list', [WaitingListController::class, 'store']);
Route::get('/terms', [AgreementController::class, 'terms']);
Route::get('/privacy-policy', [AgreementController::class, 'privacyPolicy']);
Route::get('/data-processing', [AgreementController::class, 'dataProcessing']);

Route::middleware(['auth'])->group(function () {
    Route::post('/create-admin', [RegisteredUserController::class, 'createAdmin']);
    Route::get('/admins', [RegisteredUserController::class, 'admins']);
    Route::post('/logout', [RegisteredUserController::class, 'logout'])->name('logout');
    Route::delete('/delete-account', [RegisteredUserController::class, 'deleteAccount'])->name('delete-account');
    Route::get('/current-user', [RegisteredUserController::class, 'currentUser']);
    Route::get('/dashboard', [DashboardController::class, 'dashboard']);
    Route::get('/waiting-list', [DashboardController::class, 'index']);
    Route::get('/waiting-list/stats', [DashboardController::class, 'stats']);
    Route::get('/stats/pdf', [DashboardController::class, 'exportStatsPdf']);

    Route::put('/current-user', [RegisteredUserController::class, 'update']);
    Route::put('/current-user/password', [RegisteredUserController::class, 'updatePassword']);

    Route::get('/waiting-list/export', [WaitingListController::class, 'export']);

    Route::get('/waiting-list/{waitingList}', [WaitingListController::class, 'show']);
    Route::put('/waiting-list/{waitingList}', [DashboardController::class, 'update']);
    Route::delete('/waiting-list/{waitingList}', [DashboardController::class, 'destroy']);

    Route::post('/waiting-list/{waitingList}/edit', [WaitingListController::class, 'update']);
    Route::post('/waiting-list/{waitingList}/delete', [WaitingListController::class, 'delete']);
});
