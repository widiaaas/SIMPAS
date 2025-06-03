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
        Schema::create('pendaftaran_magangs', function (Blueprint $table) {
            $table->id();
            $table->string('nip_peserta');
            $table->string('kode_instansi');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->string('spkl')->nullable();
            $table->string('cv')->nullable();
            $table->string('proposal')->nullable();
            $table->enum('status_pendaftaran', ['Disetujui', 'Diproses', 'Ditolak'])->nullable()-> default('Diproses');
            $table->enum('status_magang', ['Aktif','Tidak aktif'])->nullable()-> default('Tidak aktif');
            $table->enum('status_skl',['Sudah diterbitkan','Belum diterbitkan'])->nullable()-> default('Belum diterbitkan');
            $table->string('alasan')->nullable();
            $table->string('nip_mentor')->nullable();
            $table->timestamps();

            $table->foreign('kode_instansi')->references('kode_instansi')->on('instansis');
            $table->foreign('nip_peserta')->references('nip_peserta')->on('peserta_magangs');
            $table->foreign('nip_mentor')->references('nip_mentor')->on('mentors');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran_magangs');
    }
};