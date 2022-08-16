<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ImagensTerra extends Model
{
    protected $table = 'imagens_terras';
    protected $primaryKey = 'idImagem';
    public $timestamps = true;
    
    protected $fillable = [
        'idImagem',
        'terra',
        'url',
    ];
}
