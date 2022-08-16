<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
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
