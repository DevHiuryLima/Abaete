<?php

namespace App\Http\Controllers\web\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\Terra;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index(Request $request)
    {
        $quizzes = Quiz::all();
        return view('dashboard.quizzes.listar-quizzes', compact('quizzes'));
    }

    public function redirecionaCriarQuiz(Request $request)
    {
        $terras = Terra::all();

        if (!$terras->count()) {
            echo "<script>window.alert('Ocorreu um erro ao buscar terras! Por favor verifique se há terras cadastradas, tente novamente mais tarde.')</script>";
            echo "<script language='javaScript'>window.setTimeout('history.back(-1)', 02);</script> ";
        }

        return view('dashboard.quizzes.criar-quiz', compact('terras'));
    }

    public function criarQuiz(Request $request)
    {
        $quiz = new Quiz();

        switch ($request->tipo) {
            case 'alternativas':
                $quiz->terra = $request->terra;
                $quiz->tipo = $request->tipo;
                $quiz->pergunta = $request->pergunta;
                $quiz->alternativa_a = $request->alternativa_a;
                $quiz->alternativa_b = $request->alternativa_b;
                $quiz->alternativa_c = $request->alternativa_c;
                $quiz->alternativa_correta = $request->correta;
                $quiz->pontos = $request->pontos;
                $status = $quiz->save();
                break;
            case 'verdadeiro_ou_falso':
                $quiz->terra = $request->terra;
                $quiz->tipo = $request->tipo;
                $quiz->pergunta = $request->pergunta;
                $quiz->verdadeiro_ou_falso = $request->verdadeiro_ou_falso;
                $quiz->pontos = $request->pontos;
                $status = $quiz->save();
                break;
            default:
                $status = false;
                break;
        }

        if($status == true){
            echo "<script>window.alert('Cadastrado com sucesso!')</script>";
            return redirect()->route('quizzes');
        } else {
            $administrador->delete();
            echo "<script>window.alert('Ocorreu um erro ao cadastrar Quiz! Por favor, tente novamente mais tarde.')</script>";
            echo "<script language='javaScript'>window.setTimeout('history.back(-1)', 02);</script> ";
        }
    }

    public function redirecionaEditarQuiz(Request $request)
    {
        $quiz = Quiz::find($request->idQuiz);
        $terras = Terra::all();

        if ($quiz == null) {
            echo "<script>window.alert('Ocorreu um erro ao buscar Quiz! Por favor, tente novamente mais tarde.')</script>";
            echo "<script language='javaScript'>window.setTimeout('history.back(-1)', 02);</script> ";
        }
        if (!$terras->count()) {
            echo "<script>window.alert('Ocorreu um erro ao buscar terras! Por favor verifique se há terras cadastradas, tente novamente mais tarde.')</script>";
            echo "<script language='javaScript'>window.setTimeout('history.back(-1)', 02);</script> ";
        }

        return view('dashboard.quizzes.editar-quiz', compact('quiz', 'terras'));
    }

    public function editarQuiz(Request $request)
    {
        $quiz = Quiz::find($request->idQuiz);

        if ($quiz != null) {

            switch ($request->tipo) {
                case 'alternativas':
                    $quiz->terra = $request->terra;
                    $quiz->tipo = $request->tipo;
                    $quiz->pergunta = $request->pergunta;
                    $quiz->alternativa_a = $request->alternativa_a;
                    $quiz->alternativa_b = $request->alternativa_b;
                    $quiz->alternativa_c = $request->alternativa_c;
                    $quiz->alternativa_correta = $request->correta;
                    $quiz->verdadeiro_ou_falso = null;
                    $quiz->pontos = $request->pontos;
                    $status = $quiz->save();
                    break;
                case 'verdadeiro_ou_falso':
                    $quiz->terra = $request->terra;
                    $quiz->tipo = $request->tipo;
                    $quiz->pergunta = $request->pergunta;

                    $quiz->alternativa_a = null;
                    $quiz->alternativa_b = null;
                    $quiz->alternativa_c = null;
                    $quiz->alternativa_correta = null;

                    $quiz->verdadeiro_ou_falso = $request->verdadeiro_ou_falso;
                    $quiz->pontos = $request->pontos;
                    $status = $quiz->save();
                    break;
                default:
                    $status = false;
                    break;
            }

            if($status == true){
                echo "<script>window.alert('Cadastrado com sucesso!')</script>";
                return redirect()->route('quizzes');
            } else {
                echo "<script>window.alert('Ocorreu um erro ao cadastrar Quiz! Por favor, tente novamente mais tarde.')</script>";
                echo "<script language='javaScript'>window.setTimeout('history.back(-1)', 02);</script> ";
            }
        } else {
            echo "<script>window.alert('Ocorreu um erro ao buscar Quiz! Por favor, tente novamente mais tarde.')</script>";
            echo "<script language='javaScript'>window.setTimeout('history.back(-1)', 02);</script> ";
        }
    }

    public function removerQuiz(Request $request)
    {
        $quiz = QUiz::find($request->idQuiz);

        if ($quiz != null) {
            $status = $quiz->delete();

            if($status == true){
                return response()->json(200);
            } else {
                return response()->json([
                    'message'   => 'Ocorreu um erro, tente novamente mais tarde!',
                ], 422);
            }
        } else {
            return response()->json([
                'message'   => 'Quiz não encontrado!',
            ], 404);
        }
    }
}
