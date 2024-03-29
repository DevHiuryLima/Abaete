<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $table = 'quizzes';
    protected $primaryKey = 'idQuiz';
    public $timestamps = true;

    protected $fillable = [
        'idQuiz',
        'terra',
        'tipo',
        'pergunta',
        'alternativa_a',
        'alternativa_b',
        'alternativa_c',
        'alternativa_correta',
        'verdadeiro_ou_falso',
        'pontos',
    ];

    public function terra_relacionada()
    {
        return $this->hasOne(Terra::class,'idTerra','terra');
    }
}
