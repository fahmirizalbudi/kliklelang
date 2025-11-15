<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Masyarakat extends Model
{
    use HasFactory;

    protected $table = 'tb_masyarakat';
    protected $primaryKey = 'id_user';
    protected $fillable = ['nama_lengkap', 'username', 'password', 'telp'];
}
