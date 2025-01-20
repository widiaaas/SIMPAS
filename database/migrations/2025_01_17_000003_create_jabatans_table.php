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
        Schema::create('jabatans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_jabatan');
            $table->string('kode_instansi');
            $table->string('kode_bidang');
            $table->timestamps();

            $table->foreign('kode_instansi')->references('kode_instansi')->on('instansis');
            $table->foreign('kode_bidang')->references('kode_bidang')->on('bidangs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jabatans');
    }
};
