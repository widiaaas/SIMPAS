<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\PesertaMagang;
use App\Models\Instansi;
use App\Models\PendaftaranMagang;
use App\Models\Penilaian;


class SKLController extends Controller
{   
    public function showPenilaian()
    {
        return view('pesertaMagang.penilaian');
    }
    
    public function nilaiPeserta()
    {
        // Mengambil data penilaian berdasarkan peserta magang yang sedang login
        $pesertaMagang = Auth::user()->pesertaMagang;
        $nilai = Penilaian::where('nip_peserta', $pesertaMagang->nip_peserta)
                        ->where('status', 'Sudah disetujui')
                        ->first(); // Mengambil satu penilaian yang sudah disetujui

        // Pastikan penilaian ditemukan
        if (!$nilai) {
            // Penanganan jika tidak ada penilaian ditemukan
            return redirect()->route('penilaian.notFound');
        }

        return view('pesertaMagang.penilaian', compact('nilai'));
    }


    public function unduhSKSM()
    {
        $pesertaMagang = Auth::user()->pesertaMagang;
        // $pendaftaranMagang = PendaftaranMagang::all();
        $pendaftaranMagang = PendaftaranMagang::where('nip_peserta', $pesertaMagang->nip_peserta)->first();
        $instansi = $pendaftaranMagang->instansi;

        $data = [
            'pesertaMagang' => $pesertaMagang,
            'instansi' => $instansi,
            'pendaftaranMagang' => $pendaftaranMagang,
        ];

        $pdf = PDF::loadView('pesertaMagang.sksm', $data);

        return $pdf->download('surat_selesai_magang.pdf');
    }

    public function unduhSertifikat()
    {
        $pesertaMagang = Auth::user()->pesertaMagang;
        // $pendaftaranMagang = PendaftaranMagang::all();
        $pendaftaranMagang = PendaftaranMagang::where('nip_peserta', $pesertaMagang->nip_peserta)->first();
        $instansi = $pendaftaranMagang->instansi;

        $data = [
            'pesertaMagang' => $pesertaMagang,
            'instansi' => $instansi,
            'pendaftaranMagang' => $pendaftaranMagang,
        ];

        // Render template sertifikat ke dalam PDF
        $pdf = Pdf::loadView('pesertaMagang/sertifikat', $data);
        $pdf->setPaper('A4', 'landscape');

        // Unduh file PDF
        return $pdf->download('sertifikat.pdf');
    }

}