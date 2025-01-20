<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('peserta_magangs', function (Blueprint $table) {
            $table->id();
            $table->string('nip_peserta');
            $table->string('email_peserta');
            $table->string('no_telp_peserta');
            $table->string('asal_sekolah');
            $table->string('jurusan');
            $table->string('status_pendaftaran');
            $table->string('status_magang');
            $table->string('status_skl');
            $table->string('nama_mentor');
            $table->string('tanggal_mulai');
            $table->string('tanggal_selesai');
            $table->string('user_id');
            $table->string('kode_instansi');
            $table->string('kode_bidang');
            $table->string('nama_mentor');
            $table->unsignedBigInteger('user_id');

            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('kode_instansi')->references('kode_instansi')->on('instansis');
            $table->foreign('kode_bidang')->references('kode_bidang')->on('bidangs');
            $table->foreign('nama_mentor')->references('nama')->on('mentors');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peserta_magangs');
    }
};
