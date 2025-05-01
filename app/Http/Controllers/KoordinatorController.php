<?php

namespace App\Http\Controllers;

use App\Models\Koordinator;
use App\Models\Mentor;
use App\Models\PesertaMagang;
use App\Models\PendaftaranMagang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class KoordinatorController extends Controller
{
    public function dashboard()
    {
        // Ambil data koordinator berdasarkan user yang login
        $currentLogin = auth()->user()->id;
        $koordinator = Koordinator::where('user_id', $currentLogin)->first();
        
        // Hitung total peserta dengan status 'Aktif'
        $totalPeserta = DB::table('pendaftaran_magangs')
                        ->where('status_pendaftaran', 'Disetujui')
                        ->count();

        // Hitung jumlah peserta per instansi
        $pesertaPerInstansi = DB::table('pendaftaran_magangs')
                            ->join('instansis', 'pendaftaran_magangs.kode_instansi', '=', 'instansis.kode_instansi')
                            ->where('status_pendaftaran', 'Disetujui')
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
                        ->join('peserta_magangs', 'pendaftaran_magangs.nip_peserta', '=', 'peserta_magangs.nip_peserta')
                        ->whereNull('pendaftaran_magangs.nip_mentor')
                        ->count();

        $diterima = DB::table('pendaftaran_magangs')
                    ->join('peserta_magangs', 'pendaftaran_magangs.nip_peserta', '=', 'peserta_magangs.nip_peserta')
                    ->where('pendaftaran_magangs.status_pendaftaran', 'Disetujui')
                    ->whereNull('pendaftaran_magangs.nip_mentor')
                    ->count();
        
        $diproses = DB::table('pendaftaran_magangs')
                    ->join('peserta_magangs', 'pendaftaran_magangs.nip_peserta', '=', 'peserta_magangs.nip_peserta')
                    ->where('status_pendaftaran', 'Diproses')
                    ->whereNull('pendaftaran_magangs.nip_mentor')
                    ->count();

        // Kirim data ke view
        return view('koordinator.dashboard', compact('koordinator', 'totalPeserta', 'totalPendaftar', 'diterima', 'diproses', 'instansiLabels', 
            'instansiCounts'));
    }

    public function profil()
    {
        // Ambil data koordinator berdasarkan user yang login
        $currentLogin = auth()->user()->id;
        $koordinator = Koordinator::where('user_id', $currentLogin)->first();

        // Ambil instansi yang sesuai dengan koordinator
        $instansi = DB::table("instansis")
                    ->join('koordinators', 'instansis.kode_instansi', '=', 'koordinators.kode_instansi')
                    ->where('koordinators.user_id', $currentLogin) // Pastikan sesuai dengan koordinator yang login
                    ->select('instansis.nama_instansi')
                    ->first(); // Ambil hanya satu data instansi

        // Kirim data ke view
        return view('koordinator.profil', compact('koordinator', 'instansi'));
    }

    public function editProfil(Request $request)
    {
        $koordinator = Auth::user()->koordinator;
        $user = Auth::user();
        
        // Validasi hanya untuk field yang diubah
        $rules = [];

        if ($request->filled('phone') && $request->input('phone') !== $koordinator->no_telp) {
            $rules['phone'] = 'required|regex:/^\+?(\d.*){3,}$/|max:15|unique:koordinators,no_telp,' 
                            . $koordinator->nip_koor . ',nip_koor';
        }

        if ($request->filled('email') && $request->input('email') !== $koordinator->email) {
            $rules['email'] = 'required|email|max:30|unique:koordinators,email,' 
                            . $koordinator->nip_koor . ',nip_koor';
        }

        $request->validate($rules);
        
        // Update data peserta magang
        $koordinator->update([
            'no_telp' => $request->input('phone'),
            'email' => $request->input('email'),
        ]);

        // Update email di tabel users
        if ($user->email !== $request->input('email')) {
            $username = explode('@', $request->email)[0];
            $user->update([
                'username' => $username,
                'email' => $request->input('email'),
            ]);
        }

        return redirect()->route('koordinator.profil')->with('success', 'Profil berhasil diperbarui.');
    }

    public function pembagianMagang()
    {
        $pendaftarMagang = DB::table('peserta_magangs')
                    ->join('pendaftaran_magangs', 'peserta_magangs.nip_peserta', '=', 'pendaftaran_magangs.nip_peserta')
                    ->join('instansis', 'pendaftaran_magangs.kode_instansi', '=', 'instansis.kode_instansi')
                    ->select(
                        'peserta_magangs.nip_peserta',
                        'peserta_magangs.nama_peserta',
                        'peserta_magangs.asal_sekolah',
                        'instansis.nama_instansi',
                        'pendaftaran_magangs.tanggal_mulai',
                        'pendaftaran_magangs.tanggal_selesai'
                    )
                    ->where('pendaftaran_magangs.status_pendaftaran', 'Diproses')
                    // ->where('peserta_magangs.status_magang', 'Tidak aktif')
                    ->get();

        return view('koordinator.pembagianMagang', compact('pendaftarMagang'));
    }

    public function detailPendaftar($nip_peserta)
    {
        $pendaftar = DB::table('peserta_magangs')
            ->join('pendaftaran_magangs', 'peserta_magangs.nip_peserta', '=', 'pendaftaran_magangs.nip_peserta')
            ->join('instansis', 'pendaftaran_magangs.kode_instansi', '=', 'instansis.kode_instansi')
            ->select(
                'peserta_magangs.nama_peserta as nama',
                'peserta_magangs.asal_sekolah',
                'peserta_magangs.nip_peserta as nip',
                'peserta_magangs.jurusan',
                'peserta_magangs.email_peserta as email',
                'instansis.nama_instansi',
                'pendaftaran_magangs.tanggal_mulai',
                'pendaftaran_magangs.tanggal_selesai',
                'pendaftaran_magangs.spkl',
                'pendaftaran_magangs.cv',
                'pendaftaran_magangs.proposal'
            )
            ->where('peserta_magangs.nip_peserta', $nip_peserta) // Berikan alias tabel pada kolom
            ->first(); // Gunakan first() agar data berupa objek, bukan array

        // Periksa apakah data ditemukan
        if (!$pendaftar) {
            abort(404, 'Data tidak ditemukan');
        }

        $pendaftar->file_cv_url = Storage::url($pendaftar->cv);
        $pendaftar->file_proposal_url = Storage::url($pendaftar->proposal);
        $pendaftar->file_spkl_url = Storage::url($pendaftar->spkl);


        // Kembalikan ke view
        return view('koordinator.detailPendaftarMagang', compact('pendaftar'));
    }

    public function updateStatus(Request $request)
{
    try {
        // Validasi input
        $request->validate([
            'nip_peserta' => 'required|exists:peserta_magangs,nip_peserta',
            'status_pendaftaran' => 'required|in:Disetujui,Ditolak',
            'alasan' => 'nullable|string|required_if:status_pendaftaran,Ditolak' // Alasan wajib jika ditolak
        ]);

        // Ambil data peserta
        $peserta = PendaftaranMagang::where('nip_peserta', $request->nip_peserta)->first();
        $peserta->status_pendaftaran = $request->status_pendaftaran;

        if ($request->status_pendaftaran === 'Disetujui') {
            // Jika disetujui, otomatis mengisi alasan
            $peserta->alasan = "Berkas-berkas sudah sesuai";

            // Ambil kode_instansi dari tabel pendaftaran_magangs
            // $pendaftaran = PendaftaranMagang::where('nip_peserta', $request->nip_peserta)->first();
            // if ($pendaftaran) {
            //     $peserta->kode_instansi = $pendaftaran->kode_instansi;

            //     // DB::table('penilaians')->insert([
            //     //     'nip_peserta' => $request->nip_peserta,
            //     //     'created_at' => now(),
            //     //     'updated_at' => now(),
            //     // ]);
            // } else {
            //     return response()->json(['success' => false, 'message' => 'Data pendaftaran tidak ditemukan untuk peserta ini.'], 404);
            // }
        } 
        else if ($request->status_pendaftaran === 'Ditolak') {
            // Jika ditolak, gunakan alasan dari input
            $peserta->alasan = $request->alasan;

            // Hapus data dari tabel pendaftaran_magangs
            DB::table('pendaftaran_magangs')->where('nip_peserta', $request->nip_peserta)->delete();
        }

        $peserta->save();

        return response()->json(['success' => true, 'message' => 'Status berhasil diperbarui.']);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
    }
}

    public function plottingMentor()
    {
        // Fetching the peserta data along with instansi and mentor information
        $peserta = DB::table('peserta_magangs')
            ->join('pendaftaran_magangs', 'peserta_magangs.nip_peserta', '=', 'pendaftaran_magangs.nip_peserta')
            ->join('instansis', 'pendaftaran_magangs.kode_instansi', '=', 'instansis.kode_instansi')
            ->leftJoin('mentors', 'pendaftaran_magangs.nip_mentor', '=', 'mentors.nip_mentor') // Include mentors, if assigned
            ->select(
                'peserta_magangs.nip_peserta', 
                'peserta_magangs.nama_peserta',
                'peserta_magangs.asal_sekolah',
                'instansis.kode_instansi',
                'instansis.nama_instansi',
                'pendaftaran_magangs.tanggal_mulai',
                'pendaftaran_magangs.tanggal_selesai',
                'mentors.nama as nama_mentor'
            )
            ->where('pendaftaran_magangs.status_pendaftaran', 'Disetujui')
            ->where('pendaftaran_magangs.status_magang', 'Tidak aktif')
            ->whereNull('pendaftaran_magangs.nip_mentor') // Participants without an assigned mentor
            ->get();

        // Fetching mentors grouped by instansi
        $mentor = DB::table('mentors')
            ->select('mentors.nip_mentor', 'mentors.nama as nama_mentor', 'mentors.kode_instansi')
            ->get();

        return view('koordinator.plottingMentor', compact('peserta', 'mentor'));
    }

    public function plotMentor(Request $request)
    {
        $request->validate([
            'nip_peserta' => 'required|exists:peserta_magangs,nip_peserta',
            'nip_mentor' => 'required|exists:mentors,nip_mentor',
        ]);

        try {
            DB::beginTransaction();
    
            $updatedPeserta = DB::table('peserta_magangs')
                ->where('nip_peserta', $request->nip_peserta)
                ->update(['nip_mentor' => $request->nip_mentor]);
    
            if ($updatedPeserta) {
                DB::commit();
    
                // Check if nip_mentor is now set in the database
                $peserta = DB::table('peserta_magangs')->where('nip_peserta', $request->nip_peserta)->first();
                if ($peserta && $peserta->nip_mentor) {
                    return response()->json(['status' => 'success', 'message' => 'Mentor berhasil dipilih']);
                } else {
                    DB::rollBack(); // Rollback if nip_mentor is still not set
                    return response()->json(['status' => 'error', 'message' => 'Gagal memplot mentor (Data tidak sesuai)'], 500);
                }
    
            } else {
                DB::rollBack();
                return response()->json(['status' => 'error', 'message' => 'Gagal memperbarui data'], 500);
            }
    
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => 'Terjadi kesalahan saat memilih mentor: ' . $e->getMessage()], 500);
        }
    }

    public function getMentors(Request $request) {
        $kodeInstansi = $request->query('kode_instansi');
        // dd($mentors);
        dd($kodeInstansi);

        if (!$kodeInstansi) {
            return response()->json(['mentors' => []]);
        }
    
        $mentors = DB::table('mentors')
            ->where('kode_instansi', $kodeInstansi)
            ->get(['nip_mentor', 'nama']);
        dd($mentors);
        
        return response()->json(['mentors' => $mentors]);
    }



    public function daftarPeserta()
    {
        $peserta = DB::table('peserta_magangs')
                    ->join('pendaftaran_magangs', 'peserta_magangs.nip_peserta', '=', 'pendaftaran_magangs.nip_peserta')
                    ->join('instansis', 'pendaftaran_magangs.kode_instansi', '=', 'instansis.kode_instansi')
                    ->select(
                        'peserta_magangs.nip_peserta',
                        'peserta_magangs.nama_peserta',
                        'peserta_magangs.asal_sekolah',
                        'instansis.kode_instansi',
                        'instansis.nama_instansi',
                        'pendaftaran_magangs.tanggal_mulai',
                        'pendaftaran_magangs.tanggal_selesai'
                    )
                    ->where('pendaftaran_magangs.status_pendaftaran', 'Disetujui')
                    ->whereNotNull('pendaftaran_magangs.nip_mentor')
                    ->get();

        return view('koordinator.daftarPeserta', compact('peserta'));
    }

    public function detailPeserta($nip_peserta)
    {
        $peserta = DB::table('peserta_magangs')
            ->join('pendaftaran_magangs', 'peserta_magangs.nip_peserta', '=', 'pendaftaran_magangs.nip_peserta')
            ->join('instansis', 'pendaftaran_magangs.kode_instansi', '=', 'instansis.kode_instansi')
            ->select(
                'peserta_magangs.nama_peserta as nama',
                'peserta_magangs.asal_sekolah',
                'peserta_magangs.nip_peserta as nip',
                'peserta_magangs.jurusan',
                'peserta_magangs.email_peserta as email',
                'instansis.nama_instansi',
                'pendaftaran_magangs.tanggal_mulai',
                'pendaftaran_magangs.tanggal_selesai',
                'pendaftaran_magangs.spkl',
                'pendaftaran_magangs.cv',
                'pendaftaran_magangs.proposal'
            )
            ->where('peserta_magangs.nip_peserta', $nip_peserta) // Berikan alias tabel pada kolom
            ->first(); // Gunakan first() agar data berupa objek, bukan array

        // Periksa apakah data ditemukan
        if (!$peserta) {
            abort(404, 'Data tidak ditemukan');
        }

        // Kembalikan ke view
        return view('koordinator.detailPeserta', compact('peserta'));
    }

    public function penilaianPeserta()
    {
        $peserta = DB::table('peserta_magangs')
                    ->join('pendaftaran_magangs', 'peserta_magangs.nip_peserta', '=', 'pendaftaran_magangs.nip_peserta')
                    ->join('penilaians', 'peserta_magangs.nip_peserta', '=', 'penilaians.nip_peserta')
                    ->join('instansis', 'pendaftaran_magangs.kode_instansi', '=', 'instansis.kode_instansi')
                    ->select(
                        'peserta_magangs.nip_peserta',
                        'peserta_magangs.nama_peserta',
                        'peserta_magangs.asal_sekolah',
                        'instansis.kode_instansi',
                        'instansis.nama_instansi',
                        'pendaftaran_magangs.tanggal_mulai',
                        'pendaftaran_magangs.tanggal_selesai'
                    )
                    ->where('pendaftaran_magangs.status_pendaftaran', 'Disetujui')
                    ->whereNotNull('penilaians.nilai1')
                    ->whereNotNull('penilaians.nilai2')
                    ->whereNotNull('penilaians.nilai3')
                    ->whereNotNull('penilaians.nilai4')
                    ->whereNotNull('penilaians.nilai5')
                    ->whereNotNull('penilaians.nilai6')
                    ->whereNotNull('penilaians.nilai7')
                    ->whereNotNull('penilaians.nilai8')
                    ->whereNotNull('penilaians.nilai9')
                    ->whereNotNull('penilaians.nilai10')
                    ->whereNotNull('penilaians.nip_mentor')
                    ->where('status_skl', 'Belum diterbitkan')
                    ->get();
    
        return view('koordinator.penilaianPeserta', compact('peserta'));
    }
    

    public function detailNilaiPeserta($nip_peserta)
{
    $peserta = DB::table('peserta_magangs')
                ->join('pendaftaran_magangs', 'peserta_magangs.nip_peserta', '=', 'pendaftaran_magangs.nip_peserta')
                ->join('penilaians', 'peserta_magangs.nip_peserta', '=', 'penilaians.nip_peserta')
                ->join('instansis', 'pendaftaran_magangs.kode_instansi', '=', 'instansis.kode_instansi')
                ->select(
                    'peserta_magangs.nip_peserta as nip',
                    'peserta_magangs.nama_peserta as nama',
                    'peserta_magangs.asal_sekolah',
                    'peserta_magangs.jurusan',
                    'instansis.kode_instansi',
                    'instansis.nama_instansi',
                    'pendaftaran_magangs.tanggal_mulai',
                    'pendaftaran_magangs.tanggal_selesai',
                    'penilaians.nilai1', 'penilaians.nilai2', 'penilaians.nilai3', 
                    'penilaians.nilai4', 'penilaians.nilai5', 'penilaians.nilai6', 
                    'penilaians.nilai7', 'penilaians.nilai8', 'penilaians.nilai9', 'penilaians.nilai10'
                )
                ->where('peserta_magangs.nip_peserta', $nip_peserta) // Menyesuaikan dengan NIP peserta
                ->where('peserta_magangs.status_pendaftaran', 'Disetujui')
                ->whereNotNull('penilaians.nilai1')
                ->whereNotNull('penilaians.nilai2')
                ->whereNotNull('penilaians.nilai3')
                ->whereNotNull('penilaians.nilai4')
                ->whereNotNull('penilaians.nilai5')
                ->whereNotNull('penilaians.nilai6')
                ->whereNotNull('penilaians.nilai7')
                ->whereNotNull('penilaians.nilai8')
                ->whereNotNull('penilaians.nilai9')
                ->whereNotNull('penilaians.nilai10')
                ->whereNotNull('penilaians.nip_mentor')
                ->first();

    if (!$peserta) {
        return redirect()->route('koordinator.daftarPeserta')->with('error', 'Peserta tidak ditemukan atau belum dinilai.');
    }

    return view('koordinator.detailNilaiPeserta', compact('peserta'));
}


    public function updateNilaiPeserta(Request $request, $nip_peserta)
    {
        // Validasi data input yang diterima
        $request->validate([
            'nilai1' => 'required|integer|min:1|max:5',
            'nilai2' => 'required|integer|min:1|max:5',
            'nilai3' => 'required|integer|min:1|max:10',
            'nilai4' => 'required|integer|min:1|max:10',
            'nilai5' => 'required|integer|min:1|max:10',
            'nilai6' => 'required|integer|min:1|max:15',
            'nilai7' => 'required|integer|min:1|max:15',
            'nilai8' => 'required|integer|min:1|max:20',
            'nilai9' => 'required|integer|min:1|max:5',
            'nilai10' => 'required|integer|min:1|max:5',
        ]);

        // Hitung nilai_total
        $nilai_total = array_sum($request->only(['nilai1', 'nilai2', 'nilai3', 'nilai4', 'nilai5', 'nilai6', 'nilai7', 'nilai8', 'nilai9', 'nilai10']));

        // Update data penilaians di tabel berdasarkan nip_peserta
        try {
            DB::table('penilaians')
                ->where('nip_peserta', $nip_peserta)
                ->update([
                    'nilai1' => $request->nilai1,
                    'nilai2' => $request->nilai2,
                    'nilai3' => $request->nilai3,
                    'nilai4' => $request->nilai4,
                    'nilai5' => $request->nilai5,
                    'nilai6' => $request->nilai6,
                    'nilai7' => $request->nilai7,
                    'nilai8' => $request->nilai8,
                    'nilai9' => $request->nilai9,
                    'nilai10' => $request->nilai10,
                    'nilai_total' => $nilai_total,
                    'updated_at' => now(),
                ]);
    
            return response()->json(['message' => 'Nilai berhasil diperbarui!', 'status' => 'success']);
    
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage(), 'status' => 'error'], 500);
        }
    }

    public function konfirmasiPenilaian(Request $request, $nip_peserta)
    {
        try {
            // Update status di database
            DB::table('peserta_magangs')
                ->where('nip_peserta', $nip_peserta)
                ->update([
                    'status_skl' => 'Sudah diterbitkan',
                    'status_magang' => 'Tidak aktif',
                    'updated_at' => now()
                ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Penilaian berhasil dikonfirmasi!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengonfirmasi penilaian: ' . $e->getMessage()
            ], 500);
        }
    }

      
}