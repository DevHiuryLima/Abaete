<?php

namespace App\Http\Controllers\web;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Model\Terra;
use App\Model\Quiz;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index(Request $request)
    {
        if(session()->exists('idAdmin')) {
            $quizzes = Quiz::all();
            return view('quizzes.listar-quizzes', compact('quizzes'));
        } else {
            return redirect()->to('/login');
        }
    }

    public function redirecionaCriarQuiz(Request $request)
    {
        if(session()->exists('idAdmin')) {
            $terras = Terra::all();

            if (!$terras->count()) {
                echo "<script>window.alert('Ocorreu um erro ao buscar terras! Por favor verifique se há terras cadastradas, tente novamente mais tarde.')</script>";
                echo "<script language='javaScript'>window.setTimeout('history.back(-1)', 02);</script> ";
            }

            return view('quizzes.criar-quiz', compact('terras'));
        } else {
            return redirect()->to('/login');
        }
    }

    public function criarAdministrador(Request $request)
    {
        if(session()->exists('idAdmin')) {
            $administrador = new Administrador();
            $administrador->nome = $request->nome;
            $administrador->login = $request->login;
            $administrador->senha = $request->senha;
            $status = $administrador->save();

            if($status == true){
                echo "<script>window.alert('Cadastrado com sucesso!')</script>";
                return redirect()->to('/administradores');
            } else {
                $administrador->delete();
                echo "<script>window.alert('Ocorreu um erro ao cadastrar Administrador! Por favor, tente novamente mais tarde.')</script>";
                echo "<script language='javaScript'>window.setTimeout('history.back(-1)', 02);</script> ";
            }
        } else {
            return redirect()->to('/login');
        }
    }

    public function redirecionaEditarAdministrador(Request $request)
    {
        if(session()->exists('idAdmin')) {
            $administrador = Administrador::find($request->idAdmin);
            
            if ($administrador == null) {
                echo "<script>window.alert('Ocorreu um erro ao buscar Administrador! Por favor, tente novamente mais tarde.')</script>";
                echo "<script language='javaScript'>window.setTimeout('history.back(-1)', 02);</script> ";
            }
            
            return view('administradores.editar-administrador', compact('administrador'));
        } else {
            return redirect()->to('/login');
        }
    }

    public function editarAdministrador(Request $request)
    {
        if(session()->exists('idAdmin')) {
            $administrador = Administrador::find($request->idAdmin);

            if ($administrador != null) {

                $administrador->nome = $request->nome;
                $administrador->login = $request->login;
                $administrador->senha = $request->senha;
                $status = $administrador->save();

                if($status == true){
                    echo "<script>window.alert('Cadastrado com sucesso!')</script>";
                    return redirect()->to('/administradores');
                } else {
                    echo "<script>window.alert('Ocorreu um erro ao cadastrar Administrador! Por favor, tente novamente mais tarde.')</script>";
                    echo "<script language='javaScript'>window.setTimeout('history.back(-1)', 02);</script> ";
                }
            } else {
                echo "<script>window.alert('Ocorreu um erro ao buscar Administrador! Por favor, tente novamente mais tarde.')</script>";
                echo "<script language='javaScript'>window.setTimeout('history.back(-1)', 02);</script> ";
            }

        } else {
            return redirect()->to('/login');
        }
    }

    public function removerAdministrador(Request $request)
    {
        if(session()->exists('idAdmin')) {
            $administrador = Administrador::find($request->idAdmin);

            if ($administrador != null) {
                $status = $administrador->delete();

                if($status == true){
                    return response()->json(200);
                } else {
                    return response()->json([
                        'message'   => 'Ocorreu um erro, tente novamente mais tarde!',
                    ], 422);
                }
            } else {
                return response()->json([
                    'message'   => 'Administrador não encontrado!',
                ], 404);
            }
        } else {
            return redirect()->to('/login');
        }
    }
}
