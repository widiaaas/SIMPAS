<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KoordinatorController;
use App\Http\Controllers\SKLController;
use App\Http\Controllers\PesertaMagangController;
use App\Http\Controllers\MentorController;

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

Route::get('/daftarakun', [AuthController::class, 'showSignUpForm'])->name('daftarakun');

//Koor
Route::get('/unduh-skl', [SKLController::class, 'unduhSKL'])->name('unduh-skl');   
Route::get('/detail-pendaftaran', function () {
    return view('pesertaMagang.detail-pendaftaran');
});

// Koor
Route::prefix('koordinator')->middleware('auth')->group(function () {
    Route::get('/dashboard', [KoordinatorController::class, 'dashboard'])->name('koordinator.dashboard');
}); 

Route::get('/koor/pembagianMagang', function () {
    return view('koordinator.pembagianMagang');
});

Route::get('/koor/pembagianMagang/detailPendaftarMagang', function () {
    return view('koordinator.detailPendaftarMagang');
});



Route::get('/koor/pembagianMagang/plottingMentor', function () {
    return view('koordinator.plottingMentor');
});

Route::get('/koor/penilaianPeserta', function () {
    return view('koordinator.penilaianPeserta');
});

Route::get('/koor/penilaianPeserta/detailNilaiPeserta', function () {
    return view('koordinator.detailNilaiPeserta');
});

//Mentor
Route::prefix('mentor')->middleware('auth')->group(function () {
    Route::get('/dashboard', [MentorController::class, 'dashboard'])->name('mentor.dashboard');
}); 

Route::get('/mentor/profil', [MentorController::class, 'showProfile'])->middleware('auth')->name('mentor.profil');
//menampilkan form edit profil
Route::get('/mentor/edit/{nip_mentor}',[MentorController::class,'showProfileEdit'])->middleware('auth')->name('mentor.profilEdit');
//meyimpan perubahan profil
Route::put('/mentor/edit/{nip_mentor}',[MentorController::class,'update'])->middleware('auth')->name('mentor.update');
//halaman profil
Route::get('/mentor/profil',[MentorController::class,'showProfile'])->middleware('auth')->name('mentor.profil');
//daftar peserta
Route::get('/mentor/daftarPeserta',[MentorController::class,'daftarPeserta'])->middleware('auth');




// Route::get('mentor/daftarPeserta', function () {
//     return view('mentor.daftarPeserta');
// });

Route::get('mentor/penilaianPeserta', function () {
    return view('mentor.penilaianPeserta');
});

Route::get('mentor/detail', function () {
    return view('mentor.detail');
});

Route::get('mentor/beriNilai', function () {
    return view('mentor.beriNilai');
});