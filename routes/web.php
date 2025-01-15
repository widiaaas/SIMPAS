<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KoorController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login'); 
Route::get('/daftarakun', [AuthController::class, 'showSignUpForm'])->name('daftarakun');
Route::get('/mentorDashboard', function () {
    return view('mentorDashboard');
});

Route::get('/koorDashboard', [KoorController::class, 'koorDashboard'])->name('koorDashboard');