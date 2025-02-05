<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 

class PenilaianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('penilaians')->insert([
            [
                'nip_peserta' => '000001', // Ganti dengan nip_peserta yang valid
                'nilai1' => null,
                'nilai2' => null,
                'nilai3' => null,
                'nilai4' => null,
                'nilai5' => null,
                'nilai6' => null,
                'nilai7' => null,
                'nilai8' => null,
                'nilai9' => null,
                'nilai10' => null,
                'nilai_total' => null, // Jumlahkan semua nilai untuk mendapatkan nilai_total
                'nip_mentor' => null, // Ganti dengan nip_mentor yang valid
                'status'=> null
            ],
            [
                'nip_peserta' => '000002', // Ganti dengan nip_peserta yang valid
                'nilai1' => null,
                'nilai2' => null,
                'nilai3' => null,
                'nilai4' => null,
                'nilai5' => null,
                'nilai6' => null,
                'nilai7' => null,
                'nilai8' => null,
                'nilai9' => null,
                'nilai10' => null,
                'nilai_total' => null, // Jumlahkan semua nilai untuk mendapatkan nilai_total
                'nip_mentor' => null, // Ganti dengan nip_mentor yang valid
                'status'=> null
            ],
            [
                'nip_peserta' => '000003', // Ganti dengan nip_peserta yang valid
                'nilai1' => null,
                'nilai2' => null,
                'nilai3' => null,
                'nilai4' => null,
                'nilai5' => null,
                'nilai6' => null,
                'nilai7' => null,
                'nilai8' => null,
                'nilai9' => null,
                'nilai10' => null,
                'nilai_total' => null, // Jumlahkan semua nilai untuk mendapatkan nilai_total
                'nip_mentor' => null, // Ganti dengan nip_mentor yang valid
                'status'=> null
            ],
        ]);
    }
}
