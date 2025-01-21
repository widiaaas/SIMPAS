<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;



class SKLController extends Controller
{
    public function unduhSKL()
    {
        // Data untuk sertifikat
        $data = [
            'name' => 'Widiawati Sihaloho', 
            'date' => date('d F Y'),        // Tanggal pembuatan sertifikat
        ];

        // Render template sertifikat ke dalam PDF
        $pdf = Pdf::loadView('pesertaMagang/sertifikat', $data);
        $pdf->setPaper('A4', 'landscape');

        // Unduh file PDF
        return $pdf->download('sertifikat.pdf');
    }

}