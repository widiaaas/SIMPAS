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
    //menampilkan profil mentor
    Route::get('/profil', [MentorController::class, 'showProfile'])->name('mentor.profil');
    //menampilkan form edit profil
    Route::get('/edit/{nip_mentor}',[MentorController::class,'showProfileEdit'])->name('mentor.profilEdit');
    //meyimpan perubahan profil
    Route::put('/edit/{nip_mentor}',[MentorController::class,'update'])->name('mentor.update');
    //halaman profil
    Route::get('/profil',[MentorController::class,'showProfile'])->name('mentor.profil');
    //daftar peserta
    Route::get('/daftarPeserta',[MentorController::class,'daftarPeserta'])->name('mentor.daftarPeserta');
    //detail tiap peserta
    Route::get("/detail/{nip_peserta}",[MentorController::class,'detailPeserta'])->name('mentor.detail');
}); 








Route::get('mentor/penilaianPeserta', function () {
    return view('mentor.penilaianPeserta');
});


Route::get('mentor/beriNilai', function () {
    return view('mentor.beriNilai');
});