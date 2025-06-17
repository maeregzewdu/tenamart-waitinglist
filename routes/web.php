<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WaitingListController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/register', [WaitingListController::class, 'store']);