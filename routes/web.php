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
          

<<<<<<< HEAD
// Mentor
Route::get('/mtrDashboard', function () {
=======
Route::get('mentor/dashboard', function () {
>>>>>>> 546b7640544824b474b0f9ec4777806c28d600ad
    return view('mentor.dashboard');
});
Route::get('/koor/dashboard', function () {
    return view('koordinator.dashboard');
});
<<<<<<< HEAD
Route::get('/mtrProfil', function () {
    return view('mentor.profil');
});
Route::get('/mtrEditProfil', function () {
=======

Route::get('mentor/profil', function () {
    return view('mentor.profil');
});

Route::get('mentor/editProfil', function () {
>>>>>>> 546b7640544824b474b0f9ec4777806c28d600ad
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
