<?php

namespace App\Http\Controllers;

use App\Models\Mentor;
use Illuminate\Http\Request;
use App\Models\PesertaMagang;
use Illuminate\Support\Facades\DB;
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
    public function update(Request $request, $nip_mentor){
        //berdasarkan nip
        $mentor=Mentor::where('nip_mentor',$nip_mentor)->first();
        if (!$mentor) {
            // Jika mentor tidak ditemukan, arahkan kembali ke halaman profil dengan pesan error
            return redirect()->route('mentor.profil')->with('error', 'Mentor tidak ditemukan.');
        }
        //validasi input
        $request->validate([
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
            'nomor_telp' => $request->nomor_telp,
            'email' => $request->email,
            'alamat' => $request->alamat,
        ]);

        $user->update([
            'email' => $request->email,
        ]);

        return redirect()->route('mentor.profil')->with('success', 'Profil berhasil diperbarui');
    }

    





}
