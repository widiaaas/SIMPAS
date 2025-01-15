<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', [AuthController::class, 'showLoginForm'])->name('login'); 

Route::get('pesertaMagang/dashboard', function () {
    return view('pesertaMagang.dashboard');
});

Route::get('pesertaMagang/profil', function () {
    return view('pesertaMagang.profil');});

Route::get('mentor/dashboard', function () {
    return view('mentor.dashboard');
});

Route::get('mentor/profil', function () {
    return view('mentor.profil');
});

Route::get('mentor/editProfil', function () {
    return view('mentor.profilEdit');
});
