<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', [AuthController::class, 'showLoginForm'])->name('login'); 

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
          

// Mentor
Route::get('/mtrDashboard', function () {
    return view('mentor.dashboard');
});
Route::get('/koor/dashboard', function () {
    return view('koordinator.dashboard');
});
Route::get('/mtrProfil', function () {
    return view('mentor.profil');
});
Route::get('/mtrEditProfil', function () {
    return view('mentor.profilEdit');
});
