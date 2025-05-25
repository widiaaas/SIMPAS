<?php

namespace App\Http\Controllers;

use App\Models\Mentor; 
use Illuminate\Http\Request;
use App\Models\PesertaMagang;
use App\Models\PendaftaranMagang;
use App\Models\Penilaian;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class MentorController extends Controller
{
    //tampilan dashboard
   public function dashboard()
    {
        $currentLogin = auth()->user()->id;
        $user = Auth::user();
        
        if ($user->role === 'mentor' && $user->mentor) {
            $mentorName = $user->mentor->nama;
            $mentor = $user->mentor;
        } else {
            $mentorName = 'mentor tidak ditemukan';
            $mentor = null;
        } 

        // Menghitung peserta yang tanggal_selesai-nya lebih dari hari ini
        $jumlah_peserta = PendaftaranMagang::where('nip_mentor', $mentor->nip_mentor)
                            ->where('tanggal_selesai', '>', Carbon::today())
                            ->count();

        return view('mentor.dashboard', compact('mentor', 'mentorName', 'jumlah_peserta'));
    }

    public function showProfile(){
        $user=Auth::user();
        $mentor=$user->mentor;
        if ($mentor && $mentor->instansi) {
            $namaInstansi = $mentor->instansi->nama_instansi; // Ambil nama instansi
        } else {
            $namaInstansi = 'Instansi tidak ditemukan';
        }
        return view('mentor.profil',compact('mentor','namaInstansi'));
    }

    //menunjukkan profil di page profilEdit 
    public function showProfileEdit($nip_mentor){
        $user=Auth::user();
        $mentor=Mentor::where('nip_mentor',$nip_mentor)->first();
        if (!$mentor){
            return redirect()->route('mentor.profil')->with('error','Mentor tidak ditemukan.');
        }
        $namaInstansi=$mentor->instansi->nama_instansi??'Instansi tidak ditemukan ';
        return view('mentor.profilEdit',compact('mentor','namaInstansi'));
    }

    //update profil
    public function update(Request $data, $nip_mentor){
        //berdasarkan nip
        $mentor=Mentor::where('nip_mentor',$nip_mentor)->first();
        if (!$mentor) {
            // Jika mentor tidak ditemukan, arahkan kembali ke halaman profil dengan pesan error
            return redirect()->route('mentor.profil')->with('error', 'Mentor tidak ditemukan.');
        }
        //validasi input
        $data->validate([
            'nomor_telp' => 'required|string|max:15|regex:/^[0-9]+$/',
            'email' => 'required|email|max:255 | unique:users,email,' .$mentor->user->id,
            'alamat' => 'required|string|max:255',
        ],[
            'nomor_telp.regex'=>'Nomor telepon hanya boleh berisi angka.',
        ]);

        $user = $mentor->user;

        if (!$user) {
            return redirect()->route('mentor.profil')->with('error', 'User terkait mentor tidak ditemukan.');
        }
        $mentor->update([
            'nomor_telp' => $data->nomor_telp,
            'email' => $data->email,
            'alamat' => $data->alamat,
        ]);

        $user->update([
            'email' => $data->email,
        ]);

        return redirect()->route('mentor.profil')->with('success', 'Profil berhasil diperbarui');
    }

    //untuk menampilkan daftar peserta beserta untuk fitur pencarian peserta
    public function daftarPeserta(Request $data)
    {
        // Ambil data mentor berdasarkan user yang sedang login
        $mentor = Mentor::where('user_id', Auth::id())->first();

        if (!$mentor) {
            return redirect()->back()->with('error', 'Anda bukan mentor');
        }

        // Ambil nilai dari input pencarian
        $search = $data->input('search');

        // Mengambil daftar peserta dengan filter pencarian dan relasi dengan PesertaMagang dan PendaftaranMagang
        $peserta_magangs = PendaftaranMagang::where('nip_mentor', $mentor->nip_mentor)
            ->whereDate('tanggal_selesai', '>', Carbon::today()) 
            ->with('pesertaMagang')
            ->when($search, function ($query) use ($search) {
                $query->whereHas('pesertaMagang', function ($q) use ($search) {
                    $q->where('nama_peserta', 'LIKE', "%{$search}%")
                    ->orWhere('asal_sekolah', 'LIKE', "%{$search}%");
                });
            })
            ->orderBy('tanggal_mulai', 'asc')
            ->paginate(10);

        return view('mentor.daftarPeserta', compact('peserta_magangs', 'search'));
    }

    //menandai peserta selesai magang
   public function tandaiSelesai($nip_peserta)
{
// Ambil data pendaftaran terbaru berdasarkan created_at
    $pendaftaran = PendaftaranMagang::where('nip_peserta', $nip_peserta)
        ->orderBy('created_at', 'desc')
        ->firstOrFail();

    // Update status magang dan tanggal selesai
    $pendaftaran->update([
        'tanggal_selesai' => Carbon::today(),
    ]);

    // Simpan ke tabel penilaians
    $penilaian=Penilaian::updateOrCreate(
        [
            'nip_peserta' => $nip_peserta,
            'id' => $pendaftaran->id,
        ],
        [
            'nip_mentor' => Auth::user()->nip_mentor,
        ]
    );

    return redirect()->route('mentor.daftarPeserta')->with('success', 'Peserta ditandai selesai.');
    }




    //menampilkan detail tiap peserta
    public function detailPeserta($nip_peserta)
    {
    $peserta = PesertaMagang::where('nip_peserta', $nip_peserta)
        ->with(['pendaftaranTerbaru.instansi'])
        ->first();

    if (!$peserta || !$peserta->pendaftaranTerbaru) {
        return redirect()->route('mentor.daftarPeserta')->with('error', 'Data tidak ditemukan');
    }

    $pendaftaran = $peserta->pendaftaranTerbaru;

    $peserta->file_cv_url = $pendaftaran->cv ? Storage::url($pendaftaran->cv) : null;
    $peserta->file_proposal_url = $pendaftaran->proposal ? Storage::url($pendaftaran->proposal) : null;
    $peserta->file_spkl_url = $pendaftaran->spkl ? Storage::url($pendaftaran->spkl) : null;

    return view('mentor.detail', compact('peserta', 'pendaftaran'));
    }



    //page penilaian peserta
    public function penilaianPeserta(Request $data) {
    $mentor = Mentor::where('user_id', Auth::id())->first();

    if (!$mentor) {
        return redirect()->back()->with('error', 'Anda bukan mentor');
    }

    $search = $data->input('search');

    $peserta_magangs = DB::table('pendaftaran_magangs as pm')
        ->join('penilaians as p', function ($join) {
            $join->on('pm.nip_peserta', '=', 'p.nip_peserta')
                 ->on('pm.created_at', '=', 'p.created_at');
        })
        ->join('peserta_magangs as ps', 'pm.nip_peserta', '=', 'ps.nip_peserta')
        ->where('pm.nip_mentor', $mentor->nip_mentor)
        ->whereDate('pm.tanggal_selesai', '<=', Carbon::today())
        ->whereNull('p.nip_mentor')
        ->whereNull('p.nilai1')
        ->whereNull('p.nilai2')
        ->whereNull('p.nilai3')
        ->whereNull('p.nilai4')
        ->whereNull('p.nilai5')
        ->whereNull('p.nilai6')
        ->whereNull('p.nilai7')
        ->whereNull('p.nilai8')
        ->whereNull('p.nilai9')
        ->whereNull('p.nilai10')
        ->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('ps.nama_peserta', 'LIKE', "%{$search}%")
                  ->orWhere('ps.asal_sekolah', 'LIKE', "%{$search}%");
            });
        })
        ->orderBy('pm.tanggal_mulai', 'desc')
        ->select('pm.*', 'ps.nama_peserta', 'ps.asal_sekolah', 'p.nilai_total') // tambahkan sesuai kebutuhan
        ->paginate(10);

    return view('mentor.penilaianPeserta', compact('peserta_magangs', 'search'));
}

    //page riwayatPenilaian
 public function riwayatPenilaian(Request $request)
{
    $mentor = Mentor::where('user_id', Auth::id())->first();

    if (!$mentor) {
        return redirect()->back()->with('error', 'Anda bukan mentor');
    }

    $search = $request->input('search');

    $peserta_magangs = DB::table('pendaftaran_magangs')
        ->join('penilaians', function ($join) use ($mentor) {
            $join->on('pendaftaran_magangs.nip_peserta', '=', 'penilaians.nip_peserta')
                 ->whereColumn('pendaftaran_magangs.created_at', '=', 'penilaians.created_at')
                 // Pastikan penilaian sudah ada dan tidak null
                 ->whereNotNull('penilaians.nip_mentor')
                 ->whereNotNull('penilaians.nilai_total')
                 ->where('penilaians.nip_mentor', $mentor->nip_mentor);
        })
        ->join('peserta_magangs', 'pendaftaran_magangs.nip_peserta', '=', 'peserta_magangs.nip_peserta')
        ->where('pendaftaran_magangs.tanggal_selesai', '<=', Carbon::today())
        ->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('peserta_magangs.nama_peserta', 'like', "%{$search}%")
                  ->orWhere('peserta_magangs.asal_sekolah', 'like', "%{$search}%");
            });
        })
        ->select(
            'penilaians.*',
            'peserta_magangs.nama_peserta',
            'peserta_magangs.asal_sekolah',
            'pendaftaran_magangs.tanggal_mulai',
            'pendaftaran_magangs.tanggal_selesai'
        )
        ->orderBy('pendaftaran_magangs.tanggal_mulai', 'desc')
        ->paginate(10);

    return view('mentor.riwayatPenilaian', compact('peserta_magangs', 'search'));
}



    //menampilkan penilaian
    public function beriNilai($nip_peserta){
        $peserta = PendaftaranMagang::with(['pesertaMagang.instansi'])
                ->where('nip_peserta', $nip_peserta)
                ->whereHas('penilaian', function($query) use ($nip_peserta) {
                    $query->where('nip_peserta', $nip_peserta)
                        ->whereRaw('DATE(penilaians.created_at) = DATE(pendaftaran_magangs.created_at)')
                        ->whereNull('nilai_total')
                        ->whereNull('nip_mentor');
                })
                ->first();

        // Cek jika peserta tidak ditemukan
            if (!$peserta) {
                return redirect()->route('mentor.daftarPeserta')->with('error', 'Peserta tidak ditemukan');
            }
        // Ambil tanggal created_at dari pendaftaran
        $tanggalPendaftaran = $peserta->created_at->toDateString();
        $penilaian=Penilaian::where('nip_peserta',$nip_peserta)
                    ->where('created_at',$tanggalPendaftaran)
                    ->first();
        //Cek apakah nilai sudah ada
        $isLocked=$penilaian?true:false;
        if (!$peserta) {
            return redirect()->route('mentor.daftarPeserta')->with('error', 'Peserta tidak ditemukan');
        }

        return view('mentor.beriNilai', compact('peserta','penilaian','isLocked'));
    }

public function simpanPenilaian(Request $request)
{
    try {
        // 1. Validasi input
        $validatedData = $request->validate([
            'nip_peserta' => 'required|string',
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

        // 2. Hitung total
        $nilaiKeys = ['nilai1','nilai2','nilai3','nilai4','nilai5','nilai6','nilai7','nilai8','nilai9','nilai10'];
        $validatedData['nilai_total'] = collect($validatedData)->only($nilaiKeys)->sum();

        // 3. Tambahkan NIP mentor dari user login
        $validatedData['nip_mentor'] = auth()->user()->mentor->nip_mentor ?? null;

        // 4. Ambil tanggal created_at dari pendaftaran
       $pendaftaran = DB::table('pendaftaran_magangs as pm')
                    ->join('penilaians as p', function($join) {
                        $join->on('pm.nip_peserta', '=', 'p.nip_peserta')
                            ->on('pm.created_at', '=', 'p.created_at');
                    })
                    ->whereNull('p.nip_mentor')
                    ->whereNull('p.nilai_total')
                    ->select('pm.*')
                    ->first();

        if (!$pendaftaran) {
            return response()->json(['message' => 'Data pendaftaran tidak ditemukan'], 404);
        }

        $createdAt = $pendaftaran->created_at;
        

        // 5. Cari penilaian yang masih kosong (semua nilai NULL)
        $penilaian = Penilaian::where('nip_peserta', $validatedData['nip_peserta'])
            ->where('created_at', $createdAt)
            ->whereNull('nilai1')
            ->whereNull('nilai2')
            ->whereNull('nilai3')
            ->whereNull('nilai4')
            ->whereNull('nilai5')
            ->whereNull('nilai6')
            ->whereNull('nilai7')
            ->whereNull('nilai8')
            ->whereNull('nilai9')
            ->whereNull('nilai10')
            ->whereNull('nilai_total')
            ->whereNull('nip_mentor')
            ->first();
        if ($penilaian) {
            // 6. Update jika masih kosong
            $penilaian->update([
                'nilai1' => $validatedData['nilai1'],
                'nilai2' => $validatedData['nilai2'],
                'nilai3' => $validatedData['nilai3'],
                'nilai4' => $validatedData['nilai4'],
                'nilai5' => $validatedData['nilai5'],
                'nilai6' => $validatedData['nilai6'],
                'nilai7' => $validatedData['nilai7'],
                'nilai8' => $validatedData['nilai8'],
                'nilai9' => $validatedData['nilai9'],
                'nilai10' => $validatedData['nilai10'],
                'nilai_total' => $validatedData['nilai_total'],
                'nip_mentor' => $validatedData['nip_mentor'],
            ]);

            return response()->json([
                'message' => 'Penilaian berhasil diperbarui!',
                'data' => $penilaian
            ], 200);
        } else {
            // 7. Simpan baru jika belum ada penilaian dengan created_at sama
            $validatedData['created_at'] = $createdAt;

            $penilaianBaru = Penilaian::create($validatedData);

            return response()->json([
                'message' => 'Penilaian berhasil disimpan!',
                'data' => $penilaianBaru
            ], 201);
        }
    } catch (ValidationException $e) {
        return response()->json([
            'message' => 'Terjadi kesalahan validasi',
            'errors' => $e->errors()
        ], 422);
    } catch (\Exception $e) {
        \Log::error('Gagal menyimpan penilaian: ' . $e->getMessage());
        \Log::error($e->getTraceAsString());

        return response()->json([
            'message' => 'Gagal menyimpan penilaian',
            'error' => $e->getMessage()
        ], 500);
    }
}


    //menampilkan nilai akhir
public function nilaiAkhir($nip_peserta, $created_at)
{
    $mentor = Mentor::where('user_id', Auth::id())->first();
    if (!$mentor) {
        return redirect()->route('mentor.riwayatPenilaian')->with('error', 'Anda bukan mentor.');
    }
    
    // Ambil data pendaftaran magang berdasarkan nip_peserta dan tanggal_selesai yang dikirim lewat URL
    $peserta = PendaftaranMagang::where('nip_peserta', $nip_peserta)
        ->where('created_at', $created_at)
        ->with(['pesertaMagang.instansi'])
        ->orderBy('created_at', 'desc')
        ->first();
        
    if (!$peserta) {
        return redirect()->route('mentor.riwayatPenilaian')->with('error', 'Peserta tidak ditemukan.');
    }
    
    // Ambil penilaian yang sesuai dengan nip_peserta, nip_mentor dan tanggal_selesai yang sama serta tanggal created_at yang sama antara penilaian dan pendaftaran_magangs
    $penilaian = Penilaian::join('pendaftaran_magangs as pm', function($join) use ($created_at) {
        $join->on('penilaians.nip_peserta', '=', 'pm.nip_peserta')
             ->where('penilaians.created_at' ,'=',$created_at);
             //->where('pm.tanggal_selesai', '=', $tanggal_selesai);
    })
    ->where('penilaians.nip_peserta', $nip_peserta)
    ->where('penilaians.nip_mentor', $mentor->nip_mentor)
    ->select('penilaians.*')
    ->first();
    
    $isLocked = $penilaian ? true : false;
    
    return view('mentor.nilaiAkhir', compact('peserta', 'penilaian', 'isLocked'));
}






    
    





    





}