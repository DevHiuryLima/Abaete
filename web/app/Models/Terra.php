<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Terra extends Model
{
    use HasFactory;

    protected $table = 'terras';
    protected $primaryKey = 'idTerra';
    public $timestamps = true;

    protected $fillable = [
        'idTerra',
        'nome',
        'populacao',
        'povos',
        'lingua',
        'modalidade',
        'sobre',
        'latitude',
        'longitude',
        'estado',
    ];

    public function cidades()
    {
        return $this->hasMany(CidadeTerra::class,'terra','idTerra');
    }

    public function imagensTerra()
    {
        return $this->hasMany(ImagensTerra::class,'terra','idTerra');
    }
}
