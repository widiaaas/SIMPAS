<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skl extends Model
{
    use HasFactory;

    protected $fillable = [
        'nip_peserta', 'file_skl'
    ];

    public function pesertaMagang()
    {
        return $this->belongsTo(PesertaMagang::class, 'nip_peserta', 'nip_peserta');
    }
}
