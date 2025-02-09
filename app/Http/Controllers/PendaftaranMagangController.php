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
use App\Models\Penilaian;

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
            return redirect()->route('pesertaMagang.dashboard')->with('error', 'Data peserta magang tidak ditemukan.');
        }

        // Cek status pendaftaran magang
        if ($pesertaMagang->status_pendaftaran == 'Diproses' || $pesertaMagang->status_pendaftaran == 'Disetujui') {
            return view('pesertaMagang.daftar_magang', compact('instansis', 'pesertaMagang'))
                ->with('error', 'Pendaftaran magang sudah ditutup karena status Anda sedang ' . $pesertaMagang->status_pendaftaran);
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
            'tanggal_mulai' => 'required|date|after_or_equal:today',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai|after_or_equal:'.now()->addDays(30)->format('Y-m-d'),
            'spkl' => 'required|file|mimes:pdf|max:1024', // Maksimal 1MB
            'cv' => 'required|file|mimes:pdf|max:1024', // Maksimal 1MB
            'proposal' => 'required|file|mimes:pdf|max:102400', // Maksimal 100MB
        ]);
    
        $spklPath = $request->file('spkl')->store('spkl');
        $cvPath = $request->file('cv')->store('cv');
        $proposalPath = $request->file('proposal')->store('proposal');

        
        // Menggunakan updateOrCreate untuk memperbarui atau membuat entri baru
        PendaftaranMagang::updateOrCreate(
            ['nip_peserta' => $pesertaMagang->nip_peserta],
            [
                'kode_instansi' => $request->dinas,
                'spkl' => $spklPath,
                'cv' => $cvPath,
                'proposal' => $proposalPath,
                'tanggal_mulai' => $request->tanggal_mulai,
                'tanggal_selesai' => $request->tanggal_selesai,
                'nip_mentor'=>null
            ]
        );



        // Mengatur kolom nilai1 hingga nilai_total menjadi null di tabel penilaian
        Penilaian::where('nip_peserta', $pesertaMagang->nip_peserta)
        ->update([
            'nilai1' => null,
            'nilai2' => null,
            'nilai3' => null,
            'nilai4' => null,
            'nilai5' => null,
            'nilai6' => null,
            'nilai7' => null,
            'nilai8' => null,
            'nilai9' => null,
            'nilai10' => null,
            'nilai_total' => null,
            'nip_mentor' => null,
        ]);


        $pesertaMagang->update([
            'kode_instansi' => $request->dinas,
            'status_pendaftaran' => 'Diproses',
            'status_magang' => 'Tidak aktif',
            'status_skl' => 'Belum diterbitkan',
            'nip_mentor'=> null,
        ]);

        return redirect()->back()->with('success', 'Pendaftaran magang berhasil!');

    }


    public function detailPendaftaran (){
        $pesertaMagang = Auth::user()->pesertaMagang;
        $pendaftaranMagang = PendaftaranMagang::where('nip_peserta', $pesertaMagang->nip_peserta)->first();
        $instansi = $pesertaMagang->instansi;
        $mentor = $pesertaMagang->mentor;

        return view('pesertaMagang.detail_pendaftaran', compact('instansi', 'pesertaMagang','pendaftaranMagang','mentor'));
    }

}