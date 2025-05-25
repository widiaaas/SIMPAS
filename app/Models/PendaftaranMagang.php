<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftaranMagang extends Model
{
    use HasFactory;
    protected $table = 'pendaftaran_magangs';
    protected $fillable = [
        'nip_peserta', 'kode_instansi', 'tanggal_mulai', 'tanggal_selesai', 
        'spkl', 'cv', 'proposal'
    ];

    public function pesertaMagang()
    {
        return $this->belongsTo(PesertaMagang::class, 'nip_peserta', 'nip_peserta');
    }

    public function mentor()
    {
        return $this->belongsTo(Mentor::class, 'nip_mentor', 'nip_mentor');
    }

    public function instansi()
    {
        return $this->belongsTo(Instansi::class, 'kode_instansi', 'kode_instansi');
    }

    public function penilaian() {
        return $this->hasOne(Penilaian::class, 'nip_peserta', 'nip_peserta');
    }
   


}
