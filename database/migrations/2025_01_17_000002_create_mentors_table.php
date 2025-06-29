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
            $table->string('nip_mentor')->primary();
            $table->string('nama');
            $table->string('nomor_telp');
            $table->string('email');
            $table->string('alamat');
            $table->string('jabatan');
            $table->string('kode_instansi');
            $table->unsignedBigInteger('user_id')->nullable();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('kode_instansi')->references('kode_instansi')->on('instansis');
            $table->timestamps();
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