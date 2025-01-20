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
        Schema::create('mentors', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nip_mentor');
            $table->string('id_jabatan');
            $table->string('nama');
            $table->string('nomor_telp');
            $table->string('email');
            $table->string('alamat');
            $table->string('nama_instansi');
            $table->string('jabatan');
            $table->foreign('id_jabatan')->references('id_jabatan')->on('jabatans');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mentors');
    }
};
