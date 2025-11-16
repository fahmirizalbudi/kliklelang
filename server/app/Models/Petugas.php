<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Petugas extends Authenticatable
{
    use HasFactory;

    protected $table = 'tb_petugas';
    protected $primaryKey = 'id_petugas';
    protected $fillable = ['nama_petugas', 'username', 'password', 'id_level'];
    protected $hidden = ['password'];

    public function level()
    {
        return $this->belongsTo(Level::class, 'id_level', 'id_level');
    }
}
