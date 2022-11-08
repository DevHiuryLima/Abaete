<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagensTerra extends Model
{
    use HasFactory;

    protected $table = 'imagens_terras';
    protected $primaryKey = 'idImagem';
    public $timestamps = true;

    protected $fillable = [
        'idImagem',
        'terra',
        'url',
    ];
}
