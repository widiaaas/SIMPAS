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
        Schema::create('penilaians', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nip_peserta');
            $table->integer('nilai1');
            $table->integer('nilai2');
            $table->integer('nilai3');
            $table->integer('nilai4');
            $table->integer('nilai5');
            $table->integer('nilai6');
            $table->integer('nilai7');
            $table->integer('nilai8');
            $table->integer('nilai9');
            $table->integer('nilai10');
            $table->integer('nilai_total');
            $table->string('nip_mentor');
            $table->foreign('nip_mentor')->references('nip_mentor')->on('mentors');
            $table->foreign('nip_peserta')->references('nip_peserta')->on('peserta_magangs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaians');
    }
};
