<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 

class PesertaMagangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('peserta_magangs')->insert([
            [
                'nip_peserta' => '18392642',
                'nama_peserta' => 'bambang',
                'email_peserta' => 'peserta1@example.com',
                'no_telp_peserta' => '085123456789',
                'asal_sekolah' => 'SMK Negeri 1 Semarang',
                'jurusan' => 'Teknik Informatika',
                'user_id' => 5,
            ],
            [
                'nip_peserta' => '57594332',
                'nama_peserta' => 'budi',
                'email_peserta' => 'peserta2@example.com',
                'no_telp_peserta' => '085234567890',
                'asal_sekolah' => 'SMK Negeri 2 Semarang',
                'jurusan' => 'Teknik Komputer Jaringan',
                'user_id' => 6,
            ],
            [
                'nip_peserta' => '7945684',
                'nama_peserta' => 'lili',
                'email_peserta' => 'peserta3@example.com',
                'no_telp_peserta' => '085345678901',
                'asal_sekolah' => 'SMK Negeri 3 Semarang',
                'jurusan' => 'Administrasi Perkantoran',
                'user_id' => 7,
            ],
        ]);
        
    }
}
