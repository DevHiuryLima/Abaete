<?php

namespace App\Http\Controllers\web\dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $user = User::find(Auth::id());
        $administradores = User::where('admin', '=', true)->get();

        if (!$administradores->count()) {
            echo "<script>window.alert('Ocorreu um erro ao buscar administradores! Por favor, tente novamente mais tarde.')</script>";
            echo "<script language='javaScript'>window.setTimeout('history.back(-1)', 02);</script> ";
        }
        return view('dashboard.administradores.listar-administradores', compact( 'user', 'administradores'));
    }

    public function redirecionaCriarAdministrador(Request $request)
    {
        return view('dashboard.administradores.criar-administrador');
    }

    public function criarAdministrador(Request $request)
    {
        $administradores = User::where('email', '=', $request->email)->get();

        if (!$administradores->count()) {
            $administrador = new User();

            $administrador->name = $request->name;
            $administrador->email = $request->email;
            $administrador->password = Hash::make($request->password);
            $administrador->admin = true;
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
    }

    public function redirecionaEditarAdministrador(Request $request)
    {
        $administrador = User::find($request->id);

        if ($administrador == null) {
            echo "<script>window.alert('Ocorreu um erro ao buscar Administrador! Por favor, tente novamente mais tarde.')</script>";
            echo "<script language='javaScript'>window.setTimeout('history.back(-1)', 02);</script> ";
        }

        return view('dashboard.administradores.editar-administrador', compact('administrador'));
    }

    public function editarAdministrador(Request $request)
    {
        $administrador = User::find($request->id);

        if ($administrador != null) {
            $administradores = User::where([
                ['email', '=', $request->email],
                ['id', '!=', $request->id],
            ])->get();

            if (!$administradores->count()) {

                $administrador->name = $request->name;
                $administrador->email = $request->email;
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
    }

    public function removerAdministrador(Request $request)
    {
        $administrador = User::find($request->id);

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
    }
}
