<?php

namespace App\Http\Controllers;

use App\Models\Mentor;
use App\Models\PesertaMagang;
use Illuminate\Http\Request;

class MentorController extends Controller
{
    public function dashboard()
    {
        // get info mhs brdasarkan user yg saat ini sdg login
        $currentLogin = auth()->user()->id;
        $mentor = Mentor::where('user_id', $currentLogin)->first();
        // dd($mahasiswa);

        return view('mentor.dashboard', compact('mentor'));
    }
}
