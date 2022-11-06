<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Usuario;
use App\Models\PontosDoUsuario;
use App\Models\Quiz;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quizzes = Quiz::with('terra_relacionada')->get();

        if(!$quizzes->count()) {
            return response()->json([
                'message'   => 'Quizzes não encontrado!',
            ], 404);
        }

        return response()->json($quizzes, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $quiz = Quiz::where('idQuiz', '=', $id)->with('terra_relacionada')->first();

        if(!$quiz) {
            return response()->json([
                'message'   => 'Quiz não encontrado!',
            ], 404);
        }
        
        return response()->json($quiz, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function buscarPerguntaAleatoria()
    {
        $query = "SELECT * FROM quizzes ORDER BY RAND() LIMIT 1";
        $quiz = Quiz::orderBy(DB::raw('RAND()'))->first();

        if(!$quiz) {
            return response()->json([
                'message'   => 'Pergunta não encontrada!',
            ], 404);
        }

        return response()->json($quiz, 200);
    }

    public function responderPerguntas(Request $request)
    {
        $quiz = Quiz::find($request->idQuiz);
        $usuario = Usuario::find($request->idUsuario);
        $pontosDoUsuario = PontosDoUsuario::where('usuario', '=', $request->idUsuario)->first();
        $pontos = 1;
        $usuarioAcertou = false;

        switch ($quiz->tipo) {
            case 'alternativas':
                if ($request->alternativa_correta == $quiz->alternativa_correta) {
                    $pontos = $quiz->pontos;
                    $usuarioAcertou = true;
                }
                break;
            case 'verdadeiro_ou_falso':
                if ($request->verdadeiro_ou_falso == $quiz->verdadeiro_ou_falso) {
                    $pontos = $quiz->pontos;
                    $usuarioAcertou = true;
                }
                break;
            
            default:
                return response()->json([
                    'message'   => 'Desculpe, ocorreu um problema ao validarmos sua resposta.',
                ], 422);
                break;
        }



        if ($usuarioAcertou) {
            $pontosDoUsuario->pontos += $pontos;
            $status = $pontosDoUsuario->save();

            $usuario->ultima_tentativa = $request->ultima_tentativa;
            $status = $usuario->save();

            return response()->json([
                'message'   => 'Parabéns! Você ganhou mais pontos.',
            ], 200);
        } else {
            $pontosDoUsuario->pontos += $pontos;
            $status = $pontosDoUsuario->save();

            $usuario->ultima_tentativa = $request->ultima_tentativa;
            $status = $usuario->save();

            return response()->json([
                'message'   => 'Que pena! Infelizmente você não acertou.',
            ], 200);
        }


    }
}
