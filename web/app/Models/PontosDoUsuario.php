<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PontosDoUsuario extends Model
{
    use HasFactory;

    protected $table = 'pontos_do_usuario';
    protected $primaryKey = 'idPontoUsuario';
    public $timestamps = true;

    protected $fillable = [
        'idPontoUsuario',
        'usuario',
        'pontos',
    ];

    public function usuario()
    {
        return $this->hasOne(User::class,'id','usuario');
    }
}
