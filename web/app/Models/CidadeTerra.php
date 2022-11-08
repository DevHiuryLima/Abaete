<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CidadeTerra extends Model
{
    use HasFactory;
    
    protected $table = 'cidades_da_terra';
    protected $primaryKey = 'idCidadeTerra';
    public $timestamps = true;

    protected $fillable = [
        'idCidadeTerra',
        'terra',
        'cidade',
    ];
}
