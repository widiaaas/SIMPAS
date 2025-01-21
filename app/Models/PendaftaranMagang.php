<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftaranMagang extends Model
{
    use HasFactory;

    protected $fillable = [
        'nip_peserta', 'kode_instansi', 'kode_bidang', 'tanggal_mulai', 'tanggal_selesai', 
        'file_spkl', 'file_cv', 'file_proposal'
    ];

    public function pesertaMagang()
    {
        return $this->belongsTo(PesertaMagang::class, 'nip_peserta', 'nip_peserta');
    }

    public function instansi()
    {
        return $this->belongsTo(Instansi::class, 'kode_instansi', 'kode_instansi');
    }
}
