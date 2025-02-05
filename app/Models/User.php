<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use HasFactory;

    protected $table = 'users';
    protected $fillable = [
        'username', 'email', 'password', 'role'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function pesertaMagang()
    {
        return $this->hasOne(PesertaMagang::class,'user_id', 'id');
    }

    public function mentor()
    {
        return $this->hasOne(Mentor::class,'user_id');
    }

    public function koordinator()
    {
        return $this->hasOne(Koordinator::class,'user_id');
    }
}
