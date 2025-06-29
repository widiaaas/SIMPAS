<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesertaMagang extends Model
{
    use HasFactory;

    protected $primaryKey = 'nip_peserta';
    protected $fillable = [
        'nip_peserta','nama_peserta','email_peserta', 'no_telp_peserta', 'alamat_peserta', 'asal_sekolah', 'jurusan','user_id'
    ];
    protected $casts = [
        'nip_peserta' => 'string',
    ];
    

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }

    public function instansi()
    {
        return $this->belongsTo(Instansi::class, 'kode_instansi', 'kode_instansi');
    }

    // public function mentor()
    // {
    //     return $this->belongsTo(Mentor::class, 'nip_mentor', 'nip_mentor');
    // }

    public function pendaftaranMagangs()
    {
        return $this->hasMany(PendaftaranMagang::class, 'nip_peserta', 'nip_peserta');
    }

    public function penilaian()
    {
        return $this->hasOne(Penilaian::class, 'nip_peserta', 'nip_peserta');
    }

    public function skls()
    {
        return $this->hasMany(Skl::class, 'nip_peserta', 'nip_peserta');
    }

    public function pendaftaran()
    {
        return $this->hasOne(PendaftaranMagang::class, 'nip_peserta', 'nip_peserta');
    }

     public function pendaftarans()
    {
        return $this->hasMany(PendaftaranMagang::class, 'nip_peserta', 'nip_peserta');
    }

    public function pendaftaranTerbaru()
    {
    return $this->hasOne(PendaftaranMagang::class, 'nip_peserta', 'nip_peserta')->latestOfMany();
    }
}
