<?php

namespace App\Http\Controllers\web\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Administrador;
use Illuminate\Http\Request;

class AdministradorController extends Controller
{
    public function index(Request $request)
    {
        if(session()->exists('idAdmin')) {
            $user = Administrador::find(session()->get('idAdmin'));
            $administradores = Administrador::all();

            if (!$administradores->count()) {
                echo "<script>window.alert('Ocorreu um erro ao buscar administradores! Por favor, tente novamente mais tarde.')</script>";
                echo "<script language='javaScript'>window.setTimeout('history.back(-1)', 02);</script> ";
            }
            return view('dashboard.administradores.listar-administradores', compact( 'user', 'administradores'));
        } else {
            return redirect()->route('redireciona.login');
        }
    }

    public function redirecionaCriarAdministrador(Request $request)
    {
        if(session()->exists('idAdmin')) {
            return view('dashboard.administradores.criar-administrador');
        } else {
            return redirect()->route('redireciona.login');
        }
    }

    public function criarAdministrador(Request $request)
    {
        if(session()->exists('idAdmin')) {
            $administradores = Administrador::where('email', '=', $request->email)->get();

            if (!$administradores->count()) {
                $administrador = new Administrador();

                $administrador->nome = $request->nome;
                $administrador->email = $request->email;
                $administrador->senha = base64_encode($request->senha);
                $status = $administrador->save();

                if($status == true){
                    echo "<script>window.alert('Cadastrado com sucesso!')</script>";
                    return redirect()->route('administradores');
                } else {
                    $administrador->delete();
                    echo "<script>window.alert('Ocorreu um erro ao cadastrar Administrador! Por favor, tente novamente mais tarde.')</script>";
                    echo "<script language='javaScript'>window.setTimeout('history.back(-1)', 02);</script> ";
                }
            } else {
                echo "<script>window.alert('Já existe um administrador com esse E-mail!')</script>";
                echo "<script language='javaScript'>window.setTimeout('history.back(-1)', 02);</script> ";
            }
        } else {
            return redirect()->route('redireciona.login');
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

            return view('dashboard.administradores.editar-administrador', compact('administrador'));
        } else {
            return redirect()->route('redireciona.login');
        }
    }

    public function editarAdministrador(Request $request)
    {
        if(session()->exists('idAdmin')) {
            $administrador = Administrador::find($request->idAdmin);

            if ($administrador != null) {
                $administradores = Administrador::where('email', '=', $request->email)->get();

                if (!$administradores->count()) {

                    $administrador->nome = $request->nome;
                    $administrador->email = $request->email;
                    $administrador->senha = base64_encode($request->senha);
                    $status = $administrador->save();

                    if($status == true){
                        echo "<script>window.alert('Cadastrado com sucesso!')</script>";
                        return redirect()->route('administradores');
                    } else {
                        echo "<script>window.alert('Ocorreu um erro ao cadastrar Administrador! Por favor, tente novamente mais tarde.')</script>";
                        echo "<script language='javaScript'>window.setTimeout('history.back(-1)', 02);</script> ";
                    }
                } else {
                    echo "<script>window.alert('Já existe um administrador com esse E-mail!')</script>";
                    echo "<script language='javaScript'>window.setTimeout('history.back(-1)', 02);</script> ";
                }
            } else {
                echo "<script>window.alert('Ocorreu um erro ao buscar Administrador! Por favor, tente novamente mais tarde.')</script>";
                echo "<script language='javaScript'>window.setTimeout('history.back(-1)', 02);</script> ";
            }

        } else {
            return redirect()->route('redireciona.login');
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
            return redirect()->route('redireciona.login');
        }
    }
}
