<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CidadeTerra extends Model
{
    protected $table = 'cidades_da_terra';
    protected $primaryKey = 'idCidadeTerra';
    public $timestamps = false;

    protected $fillable = [
        'idCidadeTerra',
        'terra',
        'cidade',
    ];
}
