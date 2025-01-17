<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KoorController extends Controller
{
    public function koorDashboard() 
    {
        return view('koor.koorDashboard', ['title' => 'Dashboard Koordinator']);
    }
}