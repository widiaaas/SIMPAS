<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 

class KoordinatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('koordinators')->insert([
            [
                'nip_koor' => 'KOORD1',
                'email' => 'koordinator1@example.com',
                'nama' => 'Hanry',
                'no_telp' => '081234567890',
                'alamat' => 'Jl. Contoh No. 1, Semarang',
                'kode_instansi' => 'Pemkot',
                'user_id' => 8,  // Sesuaikan dengan ID user yang sudah ada
            ],
            
        ]);
    }
}
