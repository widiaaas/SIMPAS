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

Route::get('/koor/dashboard', function () {
    return view('koordinator.dashboard');
});

Route::get('/koor/pembagianMagang', function () {
    return view('koordinator.pembagianMagang');
});

Route::get('/koor/pembagianMagang/detailPendaftarMagang', function () {
    return view('koordinator.detailPendaftarMagang');
});

Route::get('/mtrProfil', function () {
    return view('mentor.profil');
});

Route::get('/mtrEditProfil', function () {
    return view('mentor.profilEdit');
});
