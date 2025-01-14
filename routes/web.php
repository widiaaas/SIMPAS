<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DaftarAkunController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login'); 
Route::get('/daftarakun', [DaftarAkunController::class, 'showSignUpForm'])->name('daftarakun'); 