<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 

class MentorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('mentors')->insert([
            [
                'nip_mentor' => '1234567890',
                'nama' => 'John Doe',
                'nomor_telp' => '081234567890',
                'email' => 'johndoe@example.com',
                'alamat' => 'Jl. Contoh No. 1, Semarang',
                'kode_instansi' => 'Disperkim',
                'user_id' => 1, // Gantilah dengan user_id yang valid
            ],
            [
                'nip_mentor' => '2345678901',
                'nama' => 'Jane Smith',
                'nomor_telp' => '082345678901',
                'email' => 'janesmith@example.com',
                'alamat' => 'Jl. Contoh No. 2, Semarang',
                'kode_instansi' => 'DPU',
                'user_id' => 2, // Gantilah dengan user_id yang valid
            ],
            [
                'nip_mentor' => '3456789012',
                'nama' => 'Alice Johnson',
                'nomor_telp' => '083456789012',
                'email' => 'alicejohnson@example.com',
                'alamat' => 'Jl. Contoh No. 3, Semarang',
                'kode_instansi' => 'Dishub',
                'user_id' => 3, // Gantilah dengan user_id yang valid
            ],
            [
                'nip_mentor' => '4567890123',
                'nama' => 'Bob Lee',
                'nomor_telp' => '084567890123',
                'email' => 'boblee@example.com',
                'alamat' => 'Jl. Contoh No. 4, Semarang',
                'kode_instansi' => 'DPMPTSP',
                'user_id' => 4, // Gantilah dengan user_id yang valid
            ],
        ]);
    }
}
