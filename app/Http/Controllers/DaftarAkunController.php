<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DaftarAkunController extends Controller
{
    public function showSignUpForm() 
    {
        return view('auth.daftar', ['title' => 'Daftar Akun']);
    }
}