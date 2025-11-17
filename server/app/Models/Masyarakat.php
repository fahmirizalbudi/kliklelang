<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Masyarakat extends Authenticatable
{
    use HasFactory;

    protected $table = 'tb_masyarakat';
    protected $primaryKey = 'id_user';
    protected $fillable = ['nama_lengkap', 'username', 'password', 'telp', 'alamat', 'status'];

    public function lelang()
    {
        return $this->hasMany(Lelang::class, 'id_user', 'id_user');
    }

    public function historyLelang()
    {
        return $this->hasMany(HistoryLelang::class, 'id_user', 'id_user');
    }
}
