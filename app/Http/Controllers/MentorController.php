<?php

namespace App\Http\Controllers;

use App\Models\Mentor;
use Illuminate\Http\Request;
use App\Models\PesertaMagang;
use Illuminate\Support\Facades\Auth;

class MentorController extends Controller
{
    public function dashboard()
    {
        // get info mhs brdasarkan user yg saat ini sdg login
        $currentLogin = auth()->user()->id;
        $user = Auth::user();
        $mentorName = $user->role === 'mentor' ? $user->mentor->nama : null;
        $mentor =$user->mentor;
        // dd($mahasiswa);

        return view('mentor.dashboard', compact('mentor','mentorName'));
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

    public function showProfile1(){
        $user=Auth::user();
        $mentor=$user->mentor;
        if ($mentor && $mentor->instansi) {
            $namaInstansi = $mentor->instansi->nama_instansi; // Ambil nama instansi
        } else {
            $namaInstansi = 'Instansi tidak ditemukan';
        }
        return view('mentor.profilEdit',compact('mentor','namaInstansi'));
    }

    public function update(Request $request, $id)
    {
    $request->validate([
        'nomor_telp' => 'nullable|string',
        'email' => 'nullable|string',
        'alamat' => 'nullable|string',
    ]);

    $mentor = Mentor::findOrFail($id);
    $mentor->update([
        'nomor_telp' => $request->input('nomor_telp'),
        'email' => $request->input('email'),
        'alamat' => $request->input('alamat'),
    ]);

    return redirect()->route('mentor.profil', $mentor->id)->with('success', 'Profil berhasil diperbarui');
    }

}
