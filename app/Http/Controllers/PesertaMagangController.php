<?php

namespace App\Http\Controllers;

use App\Models\PesertaMagang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesertaMagangController extends Controller
{
    public function index()
    {
        // get info mhs brdasarkan user yg saat ini sdg login
        $currentLogin = auth()->user()->id;
        $pesertaMagang = PesertaMagang::where('user_id', $currentLogin)->first();
        // dd($mahasiswa);

        return view('pesertaMagang.dashboard', compact('pesertaMagang'));
    }
}
