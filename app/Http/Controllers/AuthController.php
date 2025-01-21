<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PesertaMagang;
use App\Models\Mentor;
use App\Models\Koordinator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // Show the login form
    public function index() 
    {
        return view('auth.login', ['title' => 'Login']);
    }

    // Show the sign-up form
    public function showSignUpForm() 
    {
        return view('auth.daftar', ['title' => 'Daftar Akun']);
    }

    // Handle login logic
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        // dd($credentials);
        // $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            // arahkan berdasarkan role
            if ($user->role == 'peserta') {
                return redirect()->route('pesertaMagang.dashboard');
            } elseif ($user->role == 'mentor') {
                return redirect()->route('mentor.dashboard');
            } elseif ($user->role == 'koordinator') {
                return redirect()->route('koordinator.dashboard');
            }
        }

        // throw ValidationException::withMessages([
        //     'email' => ['The provided credentials are incorrect.'],
        // ]);

        return back()->withErrors(['email' => 'Login gagal! Periksa email dan kata sandi Anda.'])->withInput();
    }

    

    // Handle logout logic
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
