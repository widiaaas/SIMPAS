<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;  // Menambahkan import DB
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Mentor
        DB::table('users')->insert([
            [
                'username' => 'johndoe',
                'email' => 'johndoe@example.com',
                'password' => Hash::make('password123'), // Gantilah dengan password yang sesuai
                'role' => 'mentor',
                'remember_token' => null,
            ],
            [
                'username' => 'janesmith',
                'email' => 'janesmith@example.com',
                'password' => Hash::make('password123'), // Gantilah dengan password yang sesuai
                'role' => 'mentor',
                'remember_token' => null,
            ],
            [
                'username' => 'alicejohnson',
                'email' => 'alicejohnson@example.com',
                'password' => Hash::make('password123'), // Gantilah dengan password yang sesuai
                'role' => 'mentor',
                'remember_token' => null,
            ],
            [
                'username' => 'boblee',
                'email' => 'boblee@example.com',
                'password' => Hash::make('password123'), // Gantilah dengan password yang sesuai
                'role' => 'mentor',
                'remember_token' => null,
            ],

            //Peserta Magang 
            [
                'username' => 'peserta1',
                'email' => 'peserta1@example.com',
                'password' => Hash::make('password123'), // Gantilah dengan password yang sesuai
                'role' => 'peserta',
                'remember_token' => null,
            ],
            [
                'username' => 'peserta2',
                'email' => 'peserta2@example.com',
                'password' => Hash::make('password123'), // Gantilah dengan password yang sesuai
                'role' => 'peserta',
                'remember_token' => null,
            ],
            [
                'username' => 'peserta3',
                'email' => 'peserta3@example.com',
                'password' => Hash::make('password123'), // Gantilah dengan password yang sesuai
                'role' => 'peserta',
                'remember_token' => null,
            ],

            // Koordinator
            [
                'username' => 'koordinator1',
                'email' => 'koordinator1@example.com',
                'password' => Hash::make('password123'), // Gantilah dengan password yang sesuai
                'role' => 'koordinator',
                'remember_token' => null,
            ],
        ]);
    }
}
