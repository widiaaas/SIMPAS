<?php

namespace App\Http\Controllers;

use App\Models\Koordinator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KoordinatorController extends Controller
{
    public function dashboard()
    {
        // Ambil data koordinator berdasarkan user yang login
        $currentLogin = auth()->user()->id;
        $koordinator = Koordinator::where('user_id', $currentLogin)->first();
        
        // Hitung total peserta dengan status 'Aktif'
        $totalPeserta = DB::table('peserta_magangs')
                        ->where('status_magang', '=', 'Aktif')
                        ->count();

        // Hitung jumlah peserta per instansi
        $pesertaPerInstansi = DB::table('peserta_magangs')
                            ->join('instansis', 'peserta_magangs.kode_instansi', '=', 'instansis.kode_instansi')
                            ->where('status_magang', '=', 'Aktif')
                            ->select('instansis.nama_instansi', DB::raw('count(*) as total'))
                            ->groupBy('instansis.nama_instansi')
                            ->orderByDesc('total')
                            ->get();
        
        // Ambil 5 instansi teratas
        $top5Instansi = $pesertaPerInstansi->take(5);
        
        // Gabungkan sisanya ke dalam kategori 'dll.'
        $otherInstansiCount = $pesertaPerInstansi->slice(5)->sum('total');
        
        // Persiapkan data untuk diagram
        $instansiLabels = $top5Instansi->pluck('nama_instansi')->toArray();
        $instansiCounts = $top5Instansi->pluck('total')->toArray();
        
        // Tambahkan kategori 'dll.' jika ada instansi lain
        if ($otherInstansiCount > 0) {
            $instansiLabels[] = 'dll.';
            $instansiCounts[] = $otherInstansiCount;
        }

        // Hitung total peserta dengan status 'Aktif'
        $totalPendaftar = DB::table('pendaftaran_magangs')
                        ->count();

        $diterima = DB::table('peserta_magangs')
                    ->where('status_pendaftaran', 'Disetujui')
                    ->whereNull('nip_mentor')
                    ->count();
        
        $diproses = DB::table('peserta_magangs')
                    ->where('status_pendaftaran', 'Diproses')
                    ->count();

        // Kirim data ke view
        return view('koordinator.dashboard', compact('koordinator', 'totalPeserta', 'totalPendaftar', 'diterima', 'diproses', 'instansiLabels', 
            'instansiCounts'));
    }


    
}
