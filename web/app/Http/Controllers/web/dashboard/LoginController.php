<?php

namespace App\Http\Controllers\web\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function redirecionaLogin(Request $request)
    {
        if(session()->exists('idAdmin')) {
            return redirect()->route('terras');
        } else {
            return view('dashboard.pages.login');
        }
    }

    public function login(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'email' => 'required|email|exists:administradores,email',
                'senha' => 'min:6|required',
            ]);

            // Assim que ocorre uma unica falha o validator para de validar os atributos.
            if ($validator->stopOnFirstFailure()->fails()) {
                return response()->json([
                    'message' => $validator->messages()->first() // Retornar dentro do array de menssagens a primeira menssagem.
                ], 422);
            }

            $admin = DB::table('administradores')->where([
                ['email', '=', $request->email],
                ['senha', '=', base64_encode($request->senha)],
            ])->first();

            if (!$admin){
                return response()->json([
                    'message'   => 'E-mail ou senha inválidos!',
                ], 400);
            } else {
                session()->put('idAdmin', $admin->idAdmin);
                return response()->json(200);
            }

        } catch (\Throwable $th) {
            return response()->json([
                'message'   => 'Desculpe! Ocorreu um erro no nosso servidor.',
                'error'   => $th->getMessage(),
            ], 500);
        }
    }

    public function logout()
    {
        session()->remove('idAdmin');
        return redirect()->route('redireciona.login');
    }
}
