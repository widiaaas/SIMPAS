<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('auth.login');
});

// Route::get('login', [AuthController::class, 'ShowLoginForm'])->name('login');


