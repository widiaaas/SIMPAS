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
        
        // Cek apakah email terdaftar
        $user = User::where('email', $credentials['email'])->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Akun tidak terdaftar.'])->withInput();
        }
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

    public function showSignUpForm(){
        return view('auth.daftar');
    }

    public function register(Request $request)
    {   
        
        // dd($request);
        // Validasi input yang diterima
        $validator = Validator::make($request->all(), [
            'nip_peserta' => 'required|numeric|unique:peserta_magangs,nip_peserta', // NIP unik
            'nama_peserta' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'no_telp_peserta' => 'required|numeric|unique:peserta_magangs',
            'alamat_peserta' => 'required|string|max:255',
            'asal_sekolah' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
            'password' => 'required|min:8|confirmed',
        ], [
            'nip_peserta.required' => 'NIP peserta wajib diisi.',
            'nip_peserta.numeric' => 'NIP peserta harus berupa angka.',
            'nip_peserta.unique' => 'NIP peserta sudah terdaftar.',

            'nama_peserta.required' => 'Nama peserta wajib diisi.',
            'nama_peserta.string' => 'Nama peserta harus berupa teks.',
            'nama_peserta.max' => 'Nama peserta tidak boleh lebih dari 255 karakter.',

            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar. Gunakan email lain.',

            'no_telp_peserta.required' => 'Nomor telepon peserta wajib diisi.',
            'no_telp_peserta.numeric' => 'Nomor telepon harus berupa angka.',
            'no_telp_peserta.unique' => 'Nomor telepon sudah terdaftar.',

            'alamat_peserta.required' => 'Alamat wajib diisi.',
            'aalamat_peserta.string' => 'Alamat harus berupa teks.',
            'alamat_peserta_sekolah.max' => 'Alamat tidak boleh lebih dari 255 karakter.',

            'asal_sekolah.required' => 'Asal sekolah wajib diisi.',
            'asal_sekolah.string' => 'Asal sekolah harus berupa teks.',
            'asal_sekolah.max' => 'Asal sekolah tidak boleh lebih dari 255 karakter.',

            'jurusan.required' => 'Jurusan wajib diisi.',
            'jurusan.string' => 'Jurusan harus berupa teks.',
            'jurusan.max' => 'Jurusan tidak boleh lebih dari 255 karakter.',

            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password harus memiliki minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak sesuai dengan password.',
        ]);

        
        // Jika validasi gagal, kirimkan error
        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()
                ->with([
                    'status' => 'error',
                    'message' => $validator->errors()->first()
                ]);
        }

        // Membuat pengguna baru
        $user = new User();
        $user->username = $request->nama_peserta; 
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role ?? 'peserta'; 
        $user->save();

        // Jika role pengguna adalah 'peserta', simpan data tambahan di tabel 'peserta_magangs'
        if ($user->role == 'peserta') {
            $pesertaMagang = new PesertaMagang();
            $pesertaMagang->nip_peserta = $request->nip_peserta;
            $pesertaMagang->nama_peserta = $request->nama_peserta;
            $pesertaMagang->email_peserta = $request->email;
            $pesertaMagang->no_telp_peserta = $request->no_telp_peserta;
            $pesertaMagang->alamat_peserta = $request->alamat_peserta;
            $pesertaMagang->asal_sekolah = $request->asal_sekolah;
            $pesertaMagang->jurusan = $request->jurusan;
            // $pesertaMagang->status_pendaftaran = "Belum Mendaftar Magang";
            // $pesertaMagang->status_magang = "Belum Mendaftar Magang"; 
            // $pesertaMagang->status_skl = "Belum Mendaftar Magang"; 
            $pesertaMagang->user_id = $user->id; // Mengaitkan user ID dengan peserta_magang
            $pesertaMagang->save();
        }

        return back()->with([
            'status' => 'success',
            'message' => 'Akun berhasil dibuat! Silakan login.'
        ]);
        
    }

    // Handle logout logic
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
