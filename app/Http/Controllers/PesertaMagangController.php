<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PesertaMagang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use App\Models\Instansi;
use App\Models\PendaftaranMagang;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PesertaMagangController extends Controller
{   
    // daftar akun peserta 
    public function showSignUpForm() 
    {
        return view('auth.daftar', ['title' => 'Daftar Akun']);
    }

    // dashboard
    public function showDashboard()
    {
        $pesertaMagang = Auth::user()->pesertaMagang;


        if ($pesertaMagang) {
            $pendaftaranMagang = $pesertaMagang->pendaftaranMagangs->first(); 
            
            // dd($pendaftaranMagang);
            // dd($pendaftaranMagang->status_skl);
            
            // Ambil status magang dan tanggal terkait jika ada
            $statusMagang = $pesertaMagang ? $pesertaMagang->status_magang : null;
            $tanggalMulai = $pendaftaranMagang ? \Carbon\Carbon::parse($pendaftaranMagang->tanggal_mulai)->format('d-m-Y') : null;
            $tanggalSelesai = $pendaftaranMagang ? \Carbon\Carbon::parse($pendaftaranMagang->tanggal_selesai)->format('d-m-Y') : null;
            $statusSKL = $pesertaMagang ? $pesertaMagang->status_skl : null;

            // Ambil tanggal hari ini
            $today = \Carbon\Carbon::today();

            // Tentukan status magang
            if ($tanggalMulai && $tanggalSelesai) {
                if ($today->gte($tanggalMulai) && $today->lte($tanggalSelesai)) {
                    $statusMagang = 'Aktif';
                } else {
                    $statusMagang = 'Tidak Aktif';
                }
            } else {
                $statusMagang = 'Belum Mendaftar';
            }
            return view('pesertaMagang.dashboard', compact('pesertaMagang', 'statusMagang', 'tanggalMulai', 'tanggalSelesai','statusSKL'));
        }

        return redirect()->route('login')->with('error', 'Data peserta magang tidak ditemukan.');
    }

    // daftar akun 
    // public function store(Request $request)
    // {
    //     // Validasi input
    //     $request->validate([
    //         'nip_peserta' => 'required|unique:peserta_magangs',
    //         'nama' => 'required',
    //         'email' => 'required|email|unique:peserta_magangs',
    //         'notelp' => 'required|unique:peserta_magangs',
    //         'sekolah' => 'required',
    //         'jurusan' => 'required',
    //         'password' => 'required|min:8|confirmed', 
    //     ]);

    //     // Membuat akun baru di tabel users dengan role peserta
    //     $user = User::create([
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //         'role' => 'peserta', 
    //     ]);

    //     // Menyimpan data peserta magang
    //     PesertaMagang::create([
    //         'nip_peserta' => $request->nip_peserta,
    //         'nama_peserta' => $request->nama,
    //         'email_peserta' => $request->email,
    //         'no_telp_peserta' => $request->notelp,
    //         'asal_sekolah' => $request->sekolah,
    //         'jurusan' => $request->jurusan,
    //         'user_id' => $user->id, 
    //     ]);

    //     // Redirect atau memberikan pesan sukses
    //     return redirect()->route('login')->with('success', 'Pendaftaran berhasil, silakan login');
    // }

    // Tampilin Profile
    public function showProfile()
    {
        $pesertaMagang = Auth::user()->pesertaMagang;

        return view('pesertaMagang.profile', compact('pesertaMagang'));
    }

    public function updateProfile(Request $request)
    {
        $pesertaMagang = Auth::user()->pesertaMagang;
        $user = Auth::user();
        
        // Validasi hanya untuk field yang diubah
        $rules = [];

        if ($request->filled('phone') && $request->input('phone') !== $pesertaMagang->no_telp_peserta) {
            $rules['phone'] = 'required|regex:/^\+?(\d.*){3,}$/|max:15|unique:peserta_magangs,no_telp_peserta,' 
                            . $pesertaMagang->nip_peserta . ',nip_peserta';
        }

        if ($request->filled('email') && $request->input('email') !== $pesertaMagang->email_peserta) {
            $rules['email'] = 'required|email|max:30|unique:peserta_magangs,email_peserta,' 
                            . $pesertaMagang->nip_peserta . ',nip_peserta';
        }

        $request->validate($rules);
        
        // Update data peserta magang
        $pesertaMagang->update([
            'no_telp_peserta' => $request->input('phone'),
            'email_peserta' => $request->input('email'),
        ]);

        // Update email di tabel users
        if ($user->email !== $request->input('email')) {
            $user->update([
                'email' => $request->input('email'),
            ]);
        }

        return redirect()->route('pesertaMagang.profile')->with('success', 'Profil berhasil diperbarui.');
    }


    

    // public function store(Request $request)
    // {   
    //     // dd($request);
    //     // return $request->file('spkl')->store('post-file');
    //     // Validate the input
    //     $validateData = $request->validate([
    //         'kode_instansi' => 'required|exists:instansis,kode_instansi',
    //         'tanggal_mulai' => 'required|date',
    //         'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
    //         'spkl' => 'required|file|mimes:pdf|max:1024', // Maksimal 1MB
    //         'cv' => 'required|file|mimes:pdf|max:1024', // Maksimal 1MB
    //         'proposal' => 'required|file|mimes:pdf|max:102400', // Maksimal 100MB
    //     ], [
    //         'kode_instansi.exists' => 'Kode instansi tidak valid.',
    //         'tanggal_selesai.after_or_equal' => 'Tanggal selesai harus setelah atau sama dengan tanggal mulai.',
    //         'spkl.max' => 'File SPKL tidak boleh lebih dari 1MB.',
    //         'cv.max' => 'File CV tidak boleh lebih dari 1MB.',
    //         'proposal.max' => 'File Proposal tidak boleh lebih dari 100MB.',
    //     ]);

    //     DB::beginTransaction();

    //     try {
    //         // Check if the files exist before trying to store them
    //         $spklPath = $request->hasFile('spkl') ? $request->file('spkl')->store('spkl') : null;
    //         $cvPath = $request->hasFile('cv') ? $request->file('cv')->store('cv') : null;
    //         $proposalPath = $request->hasFile('proposal') ? $request->file('proposal')->store('proposal') : null;

    //         // Get the participant data (Peserta Magang)
    //         $pesertaMagang = PesertaMagang::where('user_id', Auth::id())->first();

    //         if (!$pesertaMagang) {
    //             return redirect()->back()->with('error', 'Data peserta magang tidak ditemukan.');
    //         }

    //         // Create a new PendaftaranMagang record in the database
    //         PendaftaranMagang::create([
    //             'nip_peserta' => $pesertaMagang->nip_peserta,
    //             'kode_instansi' => $request->kode_instansi,
    //             'tanggal_mulai' => $request->tanggal_mulai,
    //             'tanggal_selesai' => $request->tanggal_selesai,
    //             'spkl' => $spklPath,
    //             'cv' => $cvPath,
    //             'proposal' => $proposalPath,
    //         ]);

    //         DB::commit();

    //         // Redirect with a success message
    //         return redirect()->route('pendaftaran.magang.store')->with('success', 'Pendaftaran magang berhasil dikirim!');
    //     } catch (\Exception $e) {
    //         DB::rollBack();

    //         // Delete files if an error occurs
    //         if (isset($spklPath)) {
    //             Storage::delete($spklPath);
    //         }
    //         if (isset($cvPath)) {
    //             Storage::delete($cvPath);
    //         }
    //         if (isset($proposalPath)) {
    //             Storage::delete($proposalPath);
    //         }

    //         return redirect('pendaftaran.magang.create')->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
    //     }
    // }

}
