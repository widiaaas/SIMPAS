<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesertaMagang extends Model
{
    use HasFactory;
    protected $table = 'peserta_magangs';
    protected $primaryKey = 'nip_peserta';
    protected $keyType = 'string'; // Pastikan dianggap string

    protected $casts = [
        'nip_peserta' => 'string', // Memastikan nip_peserta selalu string
    ];

    protected $fillable = [
        'nip_peserta', 'email_peserta','nama_peserta', 'no_telp_peserta', 'asal_sekolah', 'jurusan', 'status_pendaftaran', 
        'status_magang', 'status_skl', 'nip_mentor', 'kode_instansi', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function instansi()
    {
        return $this->belongsTo(Instansi::class, 'kode_instansi', 'kode_instansi');
    }

    public function mentor()
    {
        return $this->belongsTo(Mentor::class, 'nip_mentor', 'nip_mentor');
    }

    public function pendaftaranMagang()
    {
        return $this->hasMany(PendaftaranMagang::class, 'nip_peserta', 'nip_peserta');
    }

    public function penilaians()
    {
        return $this->hasMany(Penilaian::class, 'nip_peserta', 'nip_peserta');
    }

    public function skls()
    {
        return $this->hasMany(Skl::class, 'nip_peserta', 'nip_peserta');
    }

    public function pendaftaran()
    {
        return $this->hasOne(PendaftaranMagang::class, 'nip_peserta', 'nip_peserta');
    }
}
