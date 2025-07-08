<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Koordinator extends Model
{
    use HasFactory;

    protected $table = 'koordinators';
    protected $primaryKey = 'nip_koor';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nip_koor', 'email', 'nama', 'no_telp', 'alamat', 'kode_instansi', 'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function instansi()
    {
        return $this->belongsTo(Instansi::class, 'kode_instansi', 'kode_instansi');
    }
}
