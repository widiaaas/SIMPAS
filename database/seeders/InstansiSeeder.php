<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 

class InstansiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('instansis')->insert([
            ['kode_instansi' => 'Disperkim', 'nama_instansi' => 'Dinas Perumahan dan Kawasan Permukiman'],
            ['kode_instansi' => 'DPU', 'nama_instansi' => 'Dinas Pekerjaan Umum'],
            ['kode_instansi' => 'Dishub', 'nama_instansi' => 'Dinas Perhubungan'],
            ['kode_instansi' => 'DPMPTSP', 'nama_instansi' => 'Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu'],
            ['kode_instansi' => 'DKP', 'nama_instansi' => 'Dinas Ketahanan Pangan'],
            ['kode_instansi' => 'DLH', 'nama_instansi' => 'Dinas Lingkungan Hidup'],
            ['kode_instansi' => 'Disarpus', 'nama_instansi' => 'Dinas Arsip dan Perpustakaan'],
            ['kode_instansi' => 'Disperindag', 'nama_instansi' => 'Dinas Perdagangan'],
            ['kode_instansi' => 'Disperin', 'nama_instansi' => 'Dinas Perindustrian'],
            ['kode_instansi' => 'Dinsos', 'nama_instansi' => 'Dinas Sosial'],
            ['kode_instansi' => 'Disnaker', 'nama_instansi' => 'Dinas Tenaga Kerja'],
            ['kode_instansi' => 'Dispora', 'nama_instansi' => 'Dinas Kepemudaan dan Olahraga'],
            ['kode_instansi' => 'Dispi', 'nama_instansi' => 'Dinas Perikanan'],
            ['kode_instansi' => 'Dinkes', 'nama_instansi' => 'Dinas Kesehatan'],
            ['kode_instansi' => 'Disdik', 'nama_instansi' => 'Dinas Pendidikan'],
        ]);
    }
}
