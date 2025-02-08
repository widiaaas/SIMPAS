<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 

class PendaftaranMagangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pendaftaran_magangs')->insert([
            // [
            //     'nip_peserta' => '000001',
            //     'kode_instansi' => 'DPU', // Contoh kode instansi
            //     'tanggal_mulai' => '2025-02-01',
            //     'tanggal_selesai' => '2025-08-01',
            //     'spkl' => null,
            //     'cv' => null,
            //     'proposal' => null,
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            // [
            //     'nip_peserta' => '000002',
            //     'kode_instansi' => 'DPU', // Contoh kode instansi
            //     'tanggal_mulai' => '2025-02-15',
            //     'tanggal_selesai' => '2025-08-15',
            //     'spkl' =>null,
            //     'cv' => null,
            //     'proposal' => null,
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            // [
            //     'nip_peserta' => '000003',
            //     'kode_instansi' => 'DPU', // Contoh kode instansi
            //     'tanggal_mulai' => '2025-01-02',
            //     'tanggal_selesai' => '2025-02-02',
            //     'spkl' =>null,
            //     'cv' => null,
            //     'proposal' => null,
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
        ]);
    }
}
