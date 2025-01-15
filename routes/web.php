<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KoorController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login'); 

Route::get('pesertaMagang/dashboard', function () {
    return view('pesertaMagang.dashboard');
});

Route::get('pesertaMagang/profil', function () {
    return view('pesertaMagang.profil');});

Route::get('/daftarakun', [AuthController::class, 'showSignUpForm'])->name('daftarakun');
Route::get('/mtrDashboard', function () {
    return view('mentor.dashboard');
});

Route::get('/koorDashboard', [KoorController::class, 'koorDashboard'])->name('koorDashboard');