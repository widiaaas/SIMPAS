<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KoordinatorController;
use App\Http\Controllers\SKLController;
use App\Http\Controllers\PesertaMagangController;
use App\Http\Controllers\MentorController;
use App\Http\Controllers\PendaftaranMagangController;

Route::get('/', function () {
    return view('auth.login'); 
});

// Route::get('/', [AuthController::class, 'index'])->name('login'); 
Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');

Route::get('/daftarakun', [AuthController::class, 'showSignUpForm'])->name('daftarakun');
Route::post('/register', [AuthController::class, 'register'])->name('register');

//Peserta Magang 
Route::prefix('pesertaMagang')->middleware('auth')->group(function () {
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

Route::prefix('pesertaMagang')->middleware('auth')->group(function () {
    Route::get('/dashboard', [PesertaMagangController::class, 'showDashboard'])->name('pesertaMagang.dashboard');
    Route::get('/profile', [PesertaMagangController::class, 'showProfile'])->name('pesertaMagang.profile');
    Route::post('/profile', [PesertaMagangController::class, 'updateProfile'])->name('pesertaMagang.updateProfile');
    Route::get('/pendaftaran_magang', [PendaftaranMagangController::class, 'create'])->name('pendaftaran.magang.create');
    Route::post('/pendaftaran_magang', [PendaftaranMagangController::class, 'store'])->name('pendaftaran.magang.store');
});

//Koor
Route::get('/unduh-skl', [SKLController::class, 'unduhSKL'])->name('unduh-skl');   
Route::get('/detail-pendaftaran', function () {
    return view('pesertaMagang.detail-pendaftaran');
});

// KOORDINATOR
Route::prefix('koordinator')->middleware('auth')->group(function () {
    Route::get('/dashboard', [KoordinatorController::class, 'dashboard'])->name('koordinator.dashboard');
    Route::get('/profil', [KoordinatorController::class, 'profil'])->name('koordinator.profil');

    Route::get('/koordinator/pembagianMagang', [KoordinatorController::class, 'pembagianMagang'])->name('koordinator.pembagianMagang');
    Route::get('/koordinator/pembagianMagang/detailPendaftarMagang/{nip_peserta}', [KoordinatorController::class, 'detailPendaftar'])->name('detailPendaftar');
    Route::post('/update-status', [KoordinatorController::class, 'updateStatus'])->name('update.status');

    Route::get('/koordinator/pembagianMagang/plottingMentor', [KoordinatorController::class, 'plottingMentor']);
    Route::get('/get-mentors', [KoordinatorController::class, 'getMentors']);
    Route::post('/plot-mentor', [KoordinatorController::class, 'plotMentor'])->name('plotMentor');

    Route::get('/koordinator/daftarPeserta', [KoordinatorController::class, 'daftarPeserta']);
    Route::get('/koordinator/daftarPeserta/detailPeserta/{nip_peserta}', [KoordinatorController::class, 'detailPeserta'])->name('detailPeserta');

    Route::get('/koordinator/penilaianPeserta', [KoordinatorController::class, 'penilaianPeserta']);
    Route::get('/koordinator/penilaianPeserta/detailNilaiPeserta/{nip_peserta}', [KoordinatorController::class, 'detailNilaiPeserta'])->name('detailNilaiPeserta');
    Route::post('/update-nilai-peserta/{nip_peserta}', [KoordinatorController::class, 'updateNilaiPeserta']);
    Route::post('/konfirmasi-penilaian/{nip_peserta}', [KoordinatorController::class, 'konfirmasiPenilaian']);
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