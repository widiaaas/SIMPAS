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
        Schema::create('koordinators', function (Blueprint $table) {
            $table->string('nip_koor')->primary();
            $table->string('email')->unique();
            $table->string('nama');
            $table->timestamps();
            $table->string('no_telp');
            $table->string('email')->unique();
            $table->string('alamat');
            $table->string('kode_instansi');
            $table->unsignedBigInteger('user_id');

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
        Schema::dropIfExists('koordinators');
    }
};
