<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLoginForm() 
    {
        return view('auth.login', ['title' => 'Login']);
    }
}

class DaftarAkunController extends Controller
{
    public function showSignUpForm() 
    {
        return view('auth.daftar', ['title' => 'Daftar Akun']);
    }
}