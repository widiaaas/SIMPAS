<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\PesertaMagang;
use App\Models\Instansi;
use App\Models\PendaftaranMagang;

class PendaftaranMagangController extends Controller
{
    public function create()
    {   
        // Ambil data instansi untuk dropdown
        $instansis = Instansi::all();

        
        if ($instansis->isEmpty()) {
            return "Data instansi kosong.";
        }

        // Ambil data peserta magang berdasarkan user yang login
        $pesertaMagang = Auth::user()->pesertaMagang;
        
        if (!$pesertaMagang) {
            return redirect()->route('home')->with('error', 'Data peserta magang tidak ditemukan.');
        }

        return view('pesertaMagang.daftar_magang', compact('instansis', 'pesertaMagang'));
    }


    /**
     * Menyimpan data pendaftaran magang ke database.
     */
    public function store(Request $request)
    {   
         // dd($request);
         
        // return $request->file('suratpengantar')->store('post-file');
        // Mendapatkan data peserta magang berdasarkan user yang sedang login
        $pesertaMagang = Auth::user()->pesertaMagang;
        // dd($pesertaMagang);
        if (!$pesertaMagang) {
            return redirect()->back()->with('error', 'Data peserta magang tidak ditemukan.');
        }
        // dd($request);
        // Validasi input
        $validateData = $request->validate([
            'dinas' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'spkl' => 'required|file|mimes:pdf|max:1024', // Maksimal 1MB
            'cv' => 'required|file|mimes:pdf|max:1024', // Maksimal 1MB
            'proposal' => 'required|file|mimes:pdf|max:102400', // Maksimal 100MB
        ]);
        
        // dd($validateData);
        // // Memastikan file berhasil di-upload dan menyimpan path-nya
        // $spklPath = $cvPath = $proposalPath = null;

        // if ($request->hasFile('spkl') && $request->file('spkl')->isValid()) {
        //     $spklPath = $request->file('spkl')->store('spkl');
        // }

        // if ($request->hasFile('cv') && $request->file('cv')->isValid()) {
        //     $cvPath = $request->file('cv')->store('cv');
        // }

        // if ($request->hasFile('proposal') && $request->file('proposal')->isValid()) {
        //     $proposalPath = $request->file('proposal')->store('proposal');
        // }

        $spklPath = $request->file('spkl')->store('spkl');
        $cvPath = $request->file('cv')->store('cv');
        $proposalPath = $request->file('proposal')->store('proposal');


        // Menyimpan data pendaftaran magang
        // try {
        //     PendaftaranMagang::create([
        //         'nip_peserta' => $pesertaMagang->nip_peserta,
        //         'kode_instansi' => $request->kode_instansi,
        //         'tanggal_mulai' => $request->tanggal_mulai,
        //         'tanggal_selesai' => $request->tanggal_selesai,
        //         'spkl' => $spklPath,
        //         'cv' => $cvPath,
        //         'proposal' => $proposalPath,
        //     ]);

        //     // Redirect dengan pesan sukses jika data berhasil disimpan
        //     return redirect()->route('pendaftaran.magang.create')->with('success', 'Pendaftaran magang berhasil dikirim!');
        // } catch (\Exception $e) {
        //     // Menangani error jika terjadi masalah saat menyimpan data
        //     return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        // }
        
        // dd([
        //     'nip_peserta' => $pesertaMagang->nip_peserta,
        //     'kode_instansi' => $request->dinas,
        //     'tanggal_mulai' => $request->tanggal_mulai,
        //     'tanggal_selesai' => $request->tanggal_selesai,
        //     'spkl' => $spklPath,
        //     'cv' => $cvPath,
        //     'proposal' => $proposalPath,
        // ]);
        
        PendaftaranMagang::create([
            'nip_peserta' => $pesertaMagang->nip_peserta,
            'kode_instansi' => $request->dinas,
            'spkl' => $spklPath,
            'cv' => $cvPath,
            'proposal' => $proposalPath,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
        ]);

        return redirect()->back()->with('success', 'Pendaftaran magang berhasil!');

        
    }

}