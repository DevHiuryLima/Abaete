<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Terra extends Model
{
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
