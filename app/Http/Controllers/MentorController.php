<?php

namespace App\Http\Controllers;

use App\Models\Mentor;
use Illuminate\Http\Request;
use App\Models\PesertaMagang;
use App\Models\PendaftaranMagang;
use App\Models\Penilaian;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class MentorController extends Controller
{
    //tampilan dashboard
    public function dashboard()
    {
        // get info mhs brdasarkan user yg saat ini sdg login
        $currentLogin = auth()->user()->id;
        $user = Auth::user();
        
        if($user->role==='mentor'&&$user->mentor){
            $mentorName=$user->mentor->nama;
            $mentor=$user->mentor;
        }else{
            $mentorName='mentor tidak ditemukan';
            $mentor=null;
        }

         //untuk menghitung jumlah peserta agar tampil di dashboard
            $jumlah_peserta=PesertaMagang::where('nip_mentor',$mentor->nip_mentor)
            ->whereHas('pendaftaran',function($query){
                $query->where('tanggal_selesai','>',Carbon::today());
            })
            ->count()??0;
        return view('mentor.dashboard', compact('mentor','mentorName','jumlah_peserta'));
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
    public function daftarPeserta(Request $data){
        $mentor=Mentor::where('user_id',Auth::id())->first();
        if (!$mentor){
            return redirect()->back()->with('error','Anda bukan mentor');
        }
        //ambil nilai dari input pencarian
        $search = $data->input('search');
        
        $peserta_magangs=PesertaMagang::where('nip_mentor',$mentor->nip_mentor)
                        //menampilkan peserta yang tanggal selesainya bukan hari ini
                        ->whereHas('pendaftaran', function ($query) {
                            $query->where('tanggal_selesai', '>', Carbon::today());
                        })
                        ->with('pendaftaran')
                        //query pencarian
                        ->when($search,function($query)use($search){
                            $query->where(function($q)use($search){
                                $q->where('nama_peserta','LIKE',"%{$search}%")
                                  ->orWhere('asal_sekolah','LIKE',"%{$search}%");
                            });
                        })
                        ->orderBy(
                            PendaftaranMagang ::select('tanggal_mulai')
                                ->whereColumn('pendaftaran_magangs.nip_peserta', 'peserta_magangs.nip_peserta')
                                ->limit(1),
                            'asc' // Gunakan 'desc' jika ingin dari terbaru ke terlama
                        )
                        ->paginate(10);

    return view('mentor.daftarPeserta',compact('peserta_magangs','search'));
    }

    //menampilkan detail tiap peserta
    public function detailPeserta($nip_peserta){
        // Cari peserta berdasarkan NIP
        $peserta = PesertaMagang::where('nip_peserta', $nip_peserta)
            ->with(['pendaftaran.instansi']) // Ambil data pendaftaran magang
            ->first();

        if (!$peserta) {
            return redirect()->route('mentor.daftarPeserta')->with('error', 'Peserta tidak ditemukan');
        }

        return view('mentor.detail', compact('peserta'));
    }

    //page penilaian peserta
    public function penilaianPeserta(Request $data){
        $mentor=Mentor::where('user_id',Auth::id())->first();
        if (!$mentor){
            return redirect()->back()->with('error','Anda bukan mentor');
        }
        //ambil nilai dari input pencarian
        $search = $data->input('search');
        
        $peserta_magangs=PesertaMagang::where('nip_mentor',$mentor->nip_mentor)
                        //menampilkan peserta yang tanggal selesainya bukan hari ini
                        ->whereHas('pendaftaran', function ($query) {
                            $query->where('tanggal_selesai', '<=', Carbon::today());
                        })
                        ->with('pendaftaran')
                        //query pencarian
                        ->when($search,function($query)use($search){
                            $query->where(function($q)use($search){
                                $q->where('nama_peserta','LIKE',"%{$search}%")
                                  ->orWhere('asal_sekolah','LIKE',"%{$search}%");
                            });
                        })
                        ->orderBy(
                            PendaftaranMagang ::select('tanggal_mulai')
                                ->whereColumn('pendaftaran_magangs.nip_peserta', 'peserta_magangs.nip_peserta')
                                ->limit(1),
                            'desc' // Gunakan 'desc' jika ingin dari terbaru ke terlama
                        )
                        ->paginate(10);
        return view('mentor.penilaianPeserta',compact('peserta_magangs','search'));
    }

    //menampilkan penilaian
    public function beriNilai($nip_peserta){
        // Cari peserta berdasarkan NIP
        $peserta = PesertaMagang::where('nip_peserta', $nip_peserta)
            ->with(['pendaftaran.instansi']) // Ambil data pendaftaran magang
            ->first();

        $penilaian=Penilaian::where('nip_peserta',$nip_peserta)->first();
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

        $nilai_total = array_sum(array_slice($validatedData, 1, 10)); // Menjumlahkan nilai1 - nilai10
        $validatedData['nilai_total'] = $nilai_total;

        // Mengambil nip mentor melalui relasi
        $nip_mentor = auth()->user()->mentor->nip_mentor;
        $validatedData['nip_mentor'] = $nip_mentor;

        $penilaian = Penilaian::where('nip_peserta', $validatedData['nip_peserta'])->first();

        if ($penilaian) {
            return response()->json([
                'message' => 'Penilaian sudah terkunci dan tidak dapat diubah.'
            ], 403);
        }

        // Simpan hanya jika belum ada
        $penilaian = Penilaian::create($validatedData);

        return response()->json([
            'message' => 'Penilaian berhasil disimpan!',
            'data' => $penilaian
        ], 200);

    } catch (ValidationException $e) {
        return response()->json([
            'message' => 'Validation error',
            'errors' => $e->errors()
        ], 422);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Gagal menyimpan penilaian',
            'error' => $e->getMessage()
        ], 500);
    }
}
    



    //menyimpan penilaian


    





}
