<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instansi extends Model
{
    use HasFactory;
    protected $table = 'instansis';
    protected $fillable = [
        'kode_instansi', 'nama_instansi'
    ];

    public function mentors()
    {
        return $this->hasMany(Mentor::class, 'kode_instansi', 'kode_instansi');
    }

    public function pesertaMagangs()
    {
        return $this->hasMany(PesertaMagang::class, 'kode_instansi', 'kode_instansi');
    }
    
    public function pendaftaranMagang()
    {
        return $this->hasMany(PendaftaranMagang::class, 'kode_instansi', 'kode_instansi');
    }
    
}
