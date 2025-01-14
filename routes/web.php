<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', [AuthController::class, 'showLoginForm'])->name('login'); 
Route::get('/mentorDashboard', function () {
    return view('mentorDashboard');
});
