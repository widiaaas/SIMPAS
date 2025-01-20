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
        Schema::create('cvs', function (Blueprint $table) {
            $table->id();
            $table->string('nip_peserta');
            $table->string('nama_peserta');
            $table->string('file_cv');
            $table->unsignedBigInteger('file_size')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            
            // FK
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('nip_peserta')->references('nip_peserta')->on('peserta_magangs')->onDelete('cascade');
            ;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cvs');
    }
};
