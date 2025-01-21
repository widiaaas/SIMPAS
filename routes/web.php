<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KoorController;
use App\Http\Controllers\SKLController;
use App\Http\Controllers\PesertaMagangController;

Route::get('/', function () {
    return view('auth.login'); 
});

// Route::get('/', [AuthController::class, 'index'])->name('login'); 
Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');

Route::get('/daftarakun', [AuthController::class, 'showSignUpForm'])->name('daftarakun');

//Peserta Magang 
Route::prefix('mahasiswa')->middleware('auth')->group(function () {
    Route::get('/dashboard', [PesertaMagangController::class, 'index'])->name('pesertaMagang.dashboard');
}); 
// Route::get('pesertaMagang/dashboard', function () {
//     return view('pesertaMagang.dashboard');
// });      
Route::get('pesertaMagang/profil', function () {
    return view('pesertaMagang.profil');});
Route::get('pesertaMagang/daftar-magang', function () {
    return view('pesertaMagang.daftar-magang');});
Route::get('pesertaMagang/kumpul-laporan', function () {
    return view('pesertaMagang.kumpul-laporan');});
Route::get('pesertaMagang/skl', function () {
    return view('pesertaMagang.skl');});
Route::get('/unduh-skl', [SKLController::class, 'unduhSKL'])->name('unduh-skl');   
Route::get('/detail-pendaftaran', function () {
    return view('pesertaMagang.detail-pendaftaran');
});

// Koor
Route::get('/koor/dashboard', function () {
    return view('koordinator.dashboard');
});

Route::get('/koor/pembagianMagang', function () {
    return view('koordinator.pembagianMagang');
});

Route::get('/koor/pembagianMagang/detailPendaftarMagang', function () {
});
    return view('koordinator.detailPendaftarMagang');

//Mentor
Route::get('mentor/dashboard', function () {
    return view('mentor.dashboard');
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