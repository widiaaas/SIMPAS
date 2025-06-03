<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\PesertaMagang;
use App\Models\Instansi;
use App\Models\PendaftaranMagang;
use App\Models\Penilaian;


class SKLController extends Controller
{   
    public function nilaiPeserta()
    {
        // Mengambil data peserta magang yang sedang login
        $pesertaMagang = Auth::user()->pesertaMagang;

        // Ambil pendaftaran terakhir peserta magang
        $pendaftaranMagang = PendaftaranMagang::where('nip_peserta', $pesertaMagang->nip_peserta)
                                ->orderBy('created_at', 'desc')
                                ->first();

        // Pastikan pendaftaran tersedia
        if (!$pendaftaranMagang) {
            return redirect()->back()->with('error', 'Data pendaftaran tidak ditemukan.');
        }

        // Ambil data penilaian yang sesuai dengan pendaftaran (matching created_at)
        $penilaian = DB::table('penilaians')
                        ->where('nip_peserta', $pesertaMagang->nip_peserta)
                        ->where('created_at', $pendaftaranMagang->created_at)
                        ->first();

        // Ambil data status SKL (yang sudah diterbitkan) pada periode yang sama
        $nilai = PendaftaranMagang::where('nip_peserta', $pesertaMagang->nip_peserta)
                        ->where('created_at', $pendaftaranMagang->created_at)
                        ->where('status_skl', 'Sudah diterbitkan')
                        ->first();

        return view('pesertaMagang.penilaian', compact('nilai', 'pesertaMagang', 'penilaian', 'pendaftaranMagang'));
    }



    public function unduhSKSM()
    {
        $pesertaMagang = Auth::user()->pesertaMagang;

        // Ambil pendaftaran terakhir
        $pendaftaranMagang = PendaftaranMagang::where('nip_peserta', $pesertaMagang->nip_peserta)
                                ->orderBy('created_at', 'desc')
                                ->first();

        if (!$pendaftaranMagang) {
            return redirect()->back()->with('error', 'Data pendaftaran tidak ditemukan.');
        }

        $instansi = $pendaftaranMagang->instansi;

        $data = [
            'pesertaMagang' => $pesertaMagang,
            'instansi' => $instansi,
            'pendaftaranMagang' => $pendaftaranMagang,
            'logoUrl' => public_path('img/pemkot.png'),
        ];

        $pdf = PDF::loadView('pesertaMagang.sksm', $data);

        return $pdf->download('surat_selesai_magang.pdf');
    }

    public function unduhSertifikat()
    {
        $pesertaMagang = Auth::user()->pesertaMagang;

        // Ambil pendaftaran terakhir
        $pendaftaranMagang = PendaftaranMagang::where('nip_peserta', $pesertaMagang->nip_peserta)
                                ->orderBy('created_at', 'desc')
                                ->first();

        if (!$pendaftaranMagang) {
            return redirect()->back()->with('error', 'Data pendaftaran tidak ditemukan.');
        }

        $instansi = $pendaftaranMagang->instansi;

        $data = [
            'pesertaMagang' => $pesertaMagang,
            'instansi' => $instansi,
            'pendaftaranMagang' => $pendaftaranMagang,
        ];

        $pdf = PDF::loadView('pesertaMagang.sertifikat', $data);
        $pdf->setPaper('A4', 'landscape');

        return $pdf->download('sertifikat.pdf');
    }

}