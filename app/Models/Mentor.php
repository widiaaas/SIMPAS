<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mentor extends Model
{
    use HasFactory;

    protected $table = 'mentors';

    protected $primaryKey = 'nip_mentor';

    protected $fillable = [
        'nip_mentor', 'nama', 'nomor_telp', 'email', 'alamat', 'kode_instansi', 'kode_bidang', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function instansi()
    {
        return $this->belongsTo(Instansi::class, 'kode_instansi', 'kode_instansi');
    }

    public function pesertaMagangs()
    {
        return $this->hasMany(PesertaMagang::class, 'nip_mentor', 'nip_mentor');
    }

    public function penilaians()
    {
        return $this->hasMany(Penilaian::class, 'nip_mentor', 'nip_mentor');
    }
}
