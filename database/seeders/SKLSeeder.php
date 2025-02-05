<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 

class SKLSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('skls')->insert([
            [
                'nip_peserta' => '000001', // Ganti dengan nip_peserta yang valid
                'skl' => null, // Nama file SKL yang sesuai
            ],
            // [
            //     'nip_peserta' => '000002', // Ganti dengan nip_peserta yang valid
            //     'file_skl' => 'file_skl_000002.pdf', // Nama file SKL yang sesuai
            // ],
            // [
            //     'nip_peserta' => '000003', // Ganti dengan nip_peserta yang valid
            //     'file_skl' => 'file_skl_000003.pdf', // Nama file SKL yang sesuai
            // ],
        ]);
    }
}
