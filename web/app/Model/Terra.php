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
        'cidade',
    ];

    public function imagensTerra()
    {
        return $this->hasMany(ImagensTerra::class,'terra','idTerra');
    }
}
