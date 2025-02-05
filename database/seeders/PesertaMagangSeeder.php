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
                'nip_peserta' => '000001',
                'nama_peserta' => 'asep',
                'email_peserta' => 'peserta1@example.com',
                'no_telp_peserta' => '085123456789',
                'nama_peserta'=>'Agus Soegito',
                'asal_sekolah' => 'SMK Negeri 1 Semarang',
                'jurusan' => 'Teknik Informatika',
                'status_pendaftaran' => null,
                'status_magang' => null,
                'status_skl' => null,
                'nip_mentor' => null,
                'kode_instansi' => null,
                'user_id' => 5,
            ],
            [
                'nip_peserta' => '000002',
                'nama_peserta' => 'budi',
                'email_peserta' => 'peserta2@example.com',
                'no_telp_peserta' => '085234567890',
                'nama_peserta'=>'Putra Budiman',
                'asal_sekolah' => 'SMK Negeri 2 Semarang',
                'jurusan' => 'Teknik Komputer Jaringan',
                'status_pendaftaran' => null,
                'status_magang' => null,
                'status_skl' => null,
                'nip_mentor' => '1979026152',
                'kode_instansi' => null,
                'user_id' => 6,
            ],
            [
                'nip_peserta' => '000003',
                'nama_peserta' => 'lili',
                'email_peserta' => 'peserta3@example.com',
                'no_telp_peserta' => '085345678901',
                'nama_peserta'=>'Irene Cahyono',
                'asal_sekolah' => 'SMK Negeri 3 Semarang',
                'jurusan' => 'Administrasi Perkantoran',
                'status_pendaftaran' => null,
                'status_magang' => null,
                'status_skl' => null,
                'nip_mentor' => '1979026152',
                'kode_instansi' => null,
                'user_id' => 7,
            ],
        ]);
        
    }
}
