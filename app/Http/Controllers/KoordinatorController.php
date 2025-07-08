<?php

namespace App\Http\Controllers;

use App\Models\Koordinator;
use App\Models\Mentor;
use App\Models\PesertaMagang;
use App\Models\PendaftaranMagang;
use App\Models\Penilaian;
use App\Models\Instansi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class KoordinatorController extends Controller
{
    public function dashboard()
    {
        $koordinator = Auth::user()->koordinator;

        $totalPeserta = PendaftaranMagang::where('status_pendaftaran', 'Disetujui')->count();

        $pesertaPerInstansi = Instansi::withCount(['pendaftaranMagang' => function ($query) {
            $query->where('status_pendaftaran', 'Disetujui');
        }])
        ->orderByDesc('pendaftaran_magang_count')
        ->get();

        $top5 = $pesertaPerInstansi->take(5);
        $others = $pesertaPerInstansi->slice(5)->sum('pendaftaran_magang_count');

        $instansiLabels = $top5->pluck('nama_instansi')->toArray();
        $instansiCounts = $top5->pluck('pendaftaran_magang_count')->toArray();

        if ($others > 0) {
            $instansiLabels[] = 'dll.';
            $instansiCounts[] = $others;
        }

        $totalPendaftar = PendaftaranMagang::whereNull('nip_mentor')->count();
        $diterima = PendaftaranMagang::where('status_pendaftaran', 'Disetujui')->whereNull('nip_mentor')->count();
        $diproses = PendaftaranMagang::where('status_pendaftaran', 'Diproses')->whereNull('nip_mentor')->count();

        return view('koordinator.dashboard', compact(
            'koordinator', 'totalPeserta', 'totalPendaftar', 'diterima', 'diproses', 'instansiLabels', 'instansiCounts'
        ));
    }

    public function profil()
    {
        $koordinator = Auth::user()->koordinator;
        $instansi = $koordinator->instansi;

        return view('koordinator.profil', compact('koordinator', 'instansi'));
    }

    public function editProfil(Request $request)
    {
        $koordinator = Auth::user()->koordinator;
        $user = Auth::user();

        $rules = [];

        if ($request->filled('phone') && $request->phone !== $koordinator->no_telp) {
            $rules['phone'] = 'required|regex:/^\+?(\d.*){3,}$/|max:15|unique:koordinators,no_telp,' . $koordinator->nip_koor . ',nip_koor';
        }

        if ($request->filled('email') && $request->email !== $koordinator->email) {
            $rules['email'] = 'required|email|max:30|unique:koordinators,email,' . $koordinator->nip_koor . ',nip_koor';
        }

        if ($request->filled('alamat') && $request->alamat !== $koordinator->alamat) {
            $rules['alamat'] = 'required|string|max:30';
        }

        $request->validate($rules);

        $koordinator->update([
            'no_telp' => $request->phone,
            'email' => $request->email,
            'alamat' => $request->alamat,
        ]);

        if ($user->email !== $request->email) {
            $username = explode('@', $request->email)[0];
            $user->update([
                'username' => $username,
                'email' => $request->email,
            ]);
        }

        return redirect()->route('koordinator.profil')->with('success', 'Profil berhasil diperbarui.');
    }

    public function pembagianMagang()
    {
        $pendaftarMagang = PesertaMagang::whereHas('pendaftaranMagangs', function ($query) {
            $query->where('status_pendaftaran', 'Diproses');
        })->with(['pendaftaranTerbaru.instansi'])->get();

        return view('koordinator.pembagianMagang', compact('pendaftarMagang'));
    }

    public function detailPendaftar($nip_peserta)
{
    $peserta = PesertaMagang::with(['pendaftaranTerbaru.instansi'])->findOrFail($nip_peserta);

    $pendaftaran = $peserta->pendaftaranTerbaru;

    if (!$pendaftaran) {
        abort(404, 'Data pendaftaran tidak ditemukan.');
    }

    $pendaftaran->file_cv_url = asset('storage/' . $pendaftaran->cv);
    $pendaftaran->file_proposal_url = asset('storage/' . $pendaftaran->proposal);
    $pendaftaran->file_spkl_url = asset('storage/' . $pendaftaran->spkl);

    return view('koordinator.detailPendaftarMagang', [
        'peserta' => $peserta,
        'pendaftaran' => $pendaftaran
    ]);
}


    public function updateStatus(Request $request)
    {
        $request->validate([
            'nip_peserta' => 'required|exists:peserta_magangs,nip_peserta',
            'status_pendaftaran' => 'required|in:Disetujui,Ditolak',
            'alasan' => 'nullable|string|required_if:status_pendaftaran,Ditolak'
        ]);

        $pendaftaran = PendaftaranMagang::where('nip_peserta', $request->nip_peserta)
                            ->latest()
                            ->firstOrFail();

        $pendaftaran->status_pendaftaran = $request->status_pendaftaran;
        $pendaftaran->alasan = $request->status_pendaftaran === 'Disetujui'
            ? 'Berkas-berkas sudah sesuai'
            : $request->alasan;

        if ($request->status_pendaftaran === 'Ditolak') {
            Penilaian::where('nip_peserta', $request->nip_peserta)
                ->whereDate('created_at', $pendaftaran->created_at->toDateString())
                ->delete();
        }

        $pendaftaran->save();

        return response()->json(['success' => true, 'message' => 'Status berhasil diperbarui.']);
    }

    public function plottingMentor()
    {
        $peserta = PendaftaranMagang::with(['pesertaMagang', 'instansi', 'mentor'])
            ->where('status_pendaftaran', 'Disetujui')
            ->where('status_magang', 'Tidak aktif')
            ->whereNull('nip_mentor')
            ->get();

        $mentor = Mentor::all();

        return view('koordinator.plottingMentor', compact('peserta', 'mentor'));
    }

    public function plotMentor(Request $request)
    {
        $request->validate([
            'nip_peserta' => 'required|exists:peserta_magangs,nip_peserta',
            'nip_mentor' => 'required|exists:mentors,nip_mentor',
        ]);

        $pendaftaran = PendaftaranMagang::where('nip_peserta', $request->nip_peserta)
            ->latest()
            ->first();

        if (!$pendaftaran) {
            return response()->json(['success' => false, 'message' => 'Data pendaftaran tidak ditemukan'], 404);
        }

        $pendaftaran->nip_mentor = $request->nip_mentor;
        $pendaftaran->status_magang = 'Aktif';
        $pendaftaran->save();

        return response()->json(['success' => true, 'message' => 'Mentor berhasil dipilih']);
    }


    public function getMentors($kode_instansi)
    {
        return response()->json(
            Mentor::where('kode_instansi', $kode_instansi)->select('nip_mentor as nip', 'nama')->get()
        );
    }

    public function daftarPeserta()
    {
        $peserta = PendaftaranMagang::with(['pesertaMagang', 'instansi'])
            ->where('status_pendaftaran', 'Disetujui')
            ->whereDate('tanggal_mulai', '<=', Carbon::today())
            ->whereDate('tanggal_selesai', '>=', Carbon::today())
            ->whereNotNull('nip_mentor')
            ->get();

        return view('koordinator.daftarPeserta', compact('peserta'));
    }

    public function detailPeserta($nip_peserta)
    {
        $peserta = PesertaMagang::with(['pendaftaranTerbaru.instansi'])->findOrFail($nip_peserta);
        return view('koordinator.detailPeserta', compact('peserta'));
    }

    public function penilaianPeserta()
    {
        $penilaians = Penilaian::with(['pesertaMagang', 'pesertaMagang.pendaftaranTerbaru.instansi'])
            ->whereNotNull('nilai1')
            ->whereNotNull('nilai2')
            ->whereNotNull('nilai3')
            ->whereNotNull('nilai4')
            ->whereNotNull('nilai5')
            ->whereNotNull('nilai6')
            ->whereNotNull('nilai7')
            ->whereNotNull('nilai8')
            ->whereNotNull('nilai9')
            ->whereNotNull('nilai10')
            ->whereNotNull('nip_mentor')
            ->latest()
            ->get()
            ->filter(function ($item) {
                return $item->pesertaMagang->pendaftaranTerbaru->status_skl === 'Belum diterbitkan'
                    && Carbon::parse($item->pesertaMagang->pendaftaranTerbaru->tanggal_selesai)->lte(Carbon::today());
            });

        return view('koordinator.penilaianPeserta', ['peserta' => $penilaians]);
    }

    public function detailNilaiPeserta($nip_peserta)
{
    $penilaian = Penilaian::with(['pesertaMagang.pendaftaranTerbaru.instansi'])
        ->where('nip_peserta', $nip_peserta)
        ->firstOrFail();

    return view('koordinator.detailNilaiPeserta', ['peserta' => $penilaian]);
}


    public function updateNilaiPeserta(Request $request, $nip_peserta)
    {
        $validated = $request->validate([
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

        $validated['nilai_total'] = array_sum($request->only(array_keys($validated)));

        Penilaian::where('nip_peserta', $nip_peserta)->update(array_merge($validated, ['updated_at' => now()]));

        return response()->json(['message' => 'Nilai berhasil diperbarui!', 'status' => 'success']);
    }

    // use Illuminate\Support\Facades\Log;

public function konfirmasiPenilaian(Request $request, $nip_peserta)
{
    // Log::info("🔧 Konfirmasi untuk NIP: " . $nip_peserta);

    $pendaftaran = PendaftaranMagang::where('nip_peserta', $nip_peserta)
        ->orderByDesc('tanggal_mulai')
        ->first();

    if (!$pendaftaran) {
        // Log::error("❌ Tidak ditemukan pendaftaran untuk NIP: $nip_peserta");
        return response()->json([
            'success' => false,
            'message' => 'Data pendaftaran tidak ditemukan.'
        ], 404);
    }

    // Log::info("✅ Ditemukan pendaftaran: ", $pendaftaran->toArray());

    $pendaftaran->status_skl = 'Sudah diterbitkan';
    $pendaftaran->save();

    // Log::info("📝 status_skl berhasil diubah jadi: " . $pendaftaran->status_skl);

    return response()->json([
        'success' => true,
        'message' => 'Penilaian berhasil dikonfirmasi!'
    ]);
}


}
