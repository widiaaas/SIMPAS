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
            $table->string('nip_peserta')->primary();
            $table->string('nama_peserta');
            $table->string('email_peserta')->unique();
            $table->string('no_telp_peserta')->unique();
            $table->string('asal_sekolah');
            $table->string('jurusan');
            $table->enum('status_pendaftaran', ['Disetujui', 'Diproses', 'Ditolak'])->nullable();
            $table->string('alasan')->nullable();
            $table->enum('status_magang', ['Aktif','Tidak aktif'])->nullable()-> default('Tidak aktif');
            $table->enum('status_skl',['Sudah diterbitkan','Belum diterbitkan'])->nullable()-> default('Belum diterbitkan');
            $table->string('nip_mentor')->nullable();
            $table->string('kode_instansi')->nullable();
            $table->unsignedBigInteger('user_id');
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('kode_instansi')->references('kode_instansi')->on('instansis');
            $table->foreign('nip_mentor')->references('nip_mentor')->on('mentors');
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
