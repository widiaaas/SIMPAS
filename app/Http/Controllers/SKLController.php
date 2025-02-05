<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\PesertaMagang;
use App\Models\Instansi;
use App\Models\PendaftaranMagang;


class SKLController extends Controller
{   
    public function nilaiPeserta()
    {
        $nilai = DB::table('penilaians')
                    ->join('peserta_magangs', 'penilaians.nip_peserta', '=', 'peserta_magangs.nip_peserta')
                    ->join('mentors', 'penilaians.nip_mentor', '=', 'mentors.nip_mentor')
                    ->select(
                        'peserta_magangs.nip_peserta',
                        'mentors.nama as mentor',
                        'penilaians.nilai1', 'penilaians.nilai2', 'penilaians.nilai3', 'penilaians.nilai4', 'penilaians.nilai5', 'penilaians.nilai6', 'penilaians.nilai7', 'penilaians.nilai8', 'penilaians.nilai9', 'penilaians.nilai10'
                    )
                    ->where('peserta_magangs.status_pendaftaran', 'Disetujui')
                    ->where('status', 'Sudah disetujui')
                    ->first();

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