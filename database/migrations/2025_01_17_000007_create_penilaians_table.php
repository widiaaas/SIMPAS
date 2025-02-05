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
            $table->integer('nilai1')->nullable();
            $table->integer('nilai2')->nullable();
            $table->integer('nilai3')->nullable();
            $table->integer('nilai4')->nullable();
            $table->integer('nilai5')->nullable();
            $table->integer('nilai6')->nullable();
            $table->integer('nilai7')->nullable();
            $table->integer('nilai8')->nullable();
            $table->integer('nilai9')->nullable();
            $table->integer('nilai10')->nullable();
            $table->integer('nilai_total')->nullable();
            $table->string('nip_mentor')->nullable();
            $table->enum('status', ['Sudah disetujui','Belum disetujui'])->nullable()-> default('Belum disetujui');

            $table->foreign('nip_mentor')->references('nip_mentor')->on('mentors')->onDelete('cascade');
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
