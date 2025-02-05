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
            $table->timestamps();

            $table->foreign('kode_instansi')->references('kode_instansi')->on('instansis');
            $table->foreign('nip_peserta')->references('nip_peserta')->on('peserta_magangs');
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
