<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;

    protected $table = 'tb_level';

    protected $primaryKey = 'id_level';
    protected $fillable = ['level'];

    public function petugas()
    {
        return $this->hasOne(Petugas::class, 'id_level', 'id_level');
    }
}
