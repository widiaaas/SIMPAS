<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KoorController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login'); 

//Peserta Magang 
Route::get('pesertaMagang/dashboard', function () {
    return view('pesertaMagang.dashboard');
});
Route::get('pesertaMagang/profil', function () {
    return view('pesertaMagang.profil');});
Route::get('pesertaMagang/daftar-magang', function () {
    return view('pesertaMagang.daftar-magang');});
Route::get('pesertaMagang/skl', function () {
    return view('pesertaMagang.skl');});
          

Route::get('/daftarakun', [AuthController::class, 'showSignUpForm'])->name('daftarakun');

Route::get('mentor/dashboard', function () {
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

Route::get('mentor/profil', function () {
    return view('mentor.profil');
});

Route::get('mentor/editProfil', function () {
    return view('mentor.profilEdit');
});

Route::get('mentor/daftarPeserta', function () {
    return view('mentor.daftarPeserta');
});

Route::get('mentor/penilaianPeserta', function () {
    return view('mentor.penilaianPeserta');
});

Route::get('mentor/detail', function () {
    return view('mentor.detail');
});

Route::get('mentor/beriNilai', function () {
    return view('mentor.beriNilai');
});
