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
        Schema::create('spkls', function (Blueprint $table) {
            $table->id();
            $table->string('nip_peserta');
            $table->string('file_spkl');
            $table->unsignedBigInteger('file_size')->nullable();
            $table->foreign('nip_peserta')->references('nip_peserta')->on('peserta_magangs');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spkls');
    }
};
