<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Administrador extends Model
{
    protected $table = 'administradores';
    protected $primaryKey = 'idAdmin';
    public $timestamps = true;

    protected $fillable = [
        'idAdmin',
        'nome',
        'email',
        'senha',
    ];
}
