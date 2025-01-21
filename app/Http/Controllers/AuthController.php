<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // Show the login form
    public function showLoginForm() 
    {
        return view('auth.login', ['title' => 'Login']);
    }

    // Show the sign-up form
    public function showSignUpForm() 
    {
        return view('auth.daftar', ['title' => 'Daftar Akun']);
    }

    // Handle login logic
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Redirect user to appropriate dashboard based on role
            $user = Auth::user();

            // Handle redirection based on user role
            if ($user->role == 'peserta') {
                return redirect()->route('peserta.dashboard');
            } elseif ($user->role == 'mentor') {
                return redirect()->route('mentor.dashboard');
            } elseif ($user->role == 'koordinator') {
                return redirect()->route('koordinator.dashboard');
            }
        }

        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    // Handle sign-up logic
    public function signUp(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|in:peserta,mentor,koordinator',
        ]);

        // Create new user
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        // Log the user in after registration
        Auth::login($user);

        // Redirect to role-specific dashboard after registration
        if ($user->role == 'peserta') {
            return redirect()->route('peserta.dashboard');
        } elseif ($user->role == 'mentor') {
            return redirect()->route('mentor.dashboard');
        } elseif ($user->role == 'koordinator') {
            return redirect()->route('koordinator.dashboard');
        }
    }

    // Handle logout logic
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
