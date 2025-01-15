<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', [AuthController::class, 'showLoginForm'])->name('login'); 

Route::get('pesertaMagang/dashboard', function () {
    return view('pesertaMagang.dashboard');
});

Route::get('pesertaMagang/profil', function () {
    return view('pesertaMagang.profil');});

Route::get('/mtrDashboard', function () {
    return view('mentor.dashboard');
});

Route::get('/koor/dashboard', function () {
    return view('koordinator.dashboard');
});

