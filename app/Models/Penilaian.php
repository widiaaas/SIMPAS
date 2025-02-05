<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;

    protected $fillable = [
        'nip_peserta', 'nilai1', 'nilai2', 'nilai3', 'nilai4', 'nilai5', 'nilai6', 'nilai7', 'nilai8', 'nilai9', 'nilai10', 'nilai_total', 'nip_mentor', 'status'
    ];

    public function pesertaMagang()
    {
        return $this->belongsTo(PesertaMagang::class, 'nip_peserta', 'nip_peserta');
    }

    public function mentor()
    {
        return $this->belongsTo(Mentor::class, 'nip_mentor', 'nip_mentor');
    }
}
