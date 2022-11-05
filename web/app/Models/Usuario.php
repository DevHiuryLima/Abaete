<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuarios';
    protected $primaryKey = 'idUsuario';
    public $timestamps = true;
    
    protected $fillable = [
        'idUsuario',
        'nome',
        'imagem',
        'email',
        'senha',
        'ultima_tentativa',
    ];

    public function pontuacao()
    {
        return $this->hasOne(PontosDoUsuario::class,'usuario','idUsuario');
    }
}
