<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Administrador extends Model
{
    protected $table = 'administradores';
    protected $primaryKey = 'idAdmin';
    public $timestamps = false;
    
    protected $fillable = [
        'idAdmin',
        'nome',
        'login',
        'senha',
    ];
}
