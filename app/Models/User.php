<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'username', 'email', 'password', 'role'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function pesertaMagangs()
    {
        return $this->hasMany(PesertaMagang::class);
    }

    public function mentors()
    {
        return $this->hasMany(Mentor::class);
    }

    public function coordinators()
    {
        return $this->hasMany(Koordinator::class);
    }
}
