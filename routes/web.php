<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', [AuthController::class, 'showLoginForm'])->name('login'); 

Route::get('/dashboard', function () {
    return view('pesertaMagang.dashboard');
});
