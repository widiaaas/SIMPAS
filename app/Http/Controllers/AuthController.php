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
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Show the login form
    public function index() 
    {
        return view('auth.login', ['title' => 'Login']);
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

    public function register(Request $request)
    {
        // Validasi input (semua wajib diisi)
        $validatedData = $request->validate([
            'nip_peserta' => 'required|string',
            'nama_peserta' => 'required|string',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'no_telp_peserta' => 'required|string',
            'asal_sekolah' => 'required|string',
            'jurusan' => 'required|string',
        ]
        // , [
        //     'nip_peserta.required' => 'NIM/NISN wajib diisi.',
        //     'nip_peserta.numeric' => 'NIM/NISN hanya boleh berupa angka.',
        //     'nip_peserta.unique' => 'NIM/NISN sudah terdaftar.',

        //     'nama_peserta.required' => 'Nama Lengkap wajib diisi.',
        //     'nama_peserta.regex' => 'Nama hanya boleh berisi huruf.',

        //     'email.required' => 'Email wajib diisi.',
        //     'email.email' => 'Format email tidak valid.',
        //     'email.unique' => 'Email sudah terdaftar.',

        //     'no_telp_peserta.required' => 'Nomor telepon wajib diisi.',
        //     'no_telp_peserta.numeric' => 'Nomor telepon hanya boleh angka.',
        //     'no_telp_peserta.regex' => 'Nomor telepon harus valid (diawali 08, panjang 10-13 digit).',

        //     'sekolah.required' => 'Asal Sekolah / Perguruan Tinggi wajib diisi.',

        //     'jurusan.required' => 'Jurusan wajib diisi.',

        //     'password.required' => 'Password wajib diisi.',
        //     'password.min' => 'Password minimal 8 karakter.',
        //     'password.regex' => 'Password harus terdiri dari huruf dan angka.',
        // ]
        );
        dd($validatedData);

        // Ambil username dari email sebelum '@'
        $username = explode('@', $request->email)[0];

        // Buat user baru di tabel users
        $user = User::create([
            'username' => $username,
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'role' => 'peserta',
        ]);

        // Simpan data ke tabel peserta_magangs
        PesertaMagang::create([
            'nip_peserta' => $validatedData['nip_peserta'],
            'email_peserta' => $validatedData['email'],
            'no_telp_peserta' => $validatedData['no_telp_peserta'],
            'asal_sekolah' => $validatedData['asal_sekolah'],
            'jurusan' => $validatedData['jurusan'],
            'status_pendaftaran' => null,
            'status_magang' => null,
            'status_skl' => null,
            'nip_dosen' => null,
            'user_id' => $user->id, // Hubungkan dengan user yang baru dibuat
        ]);

        // Kirim response JSON untuk SweetAlert
        return response()->json([
            'status' => 'success',
            'message' => 'Akun berhasil dibuat! Silakan login kembali.'
        ]);
}



    // Handle logout logic
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
