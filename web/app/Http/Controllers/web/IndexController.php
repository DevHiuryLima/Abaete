<?php

namespace App\Http\Controllers\web;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        return view('pages.index');
    }

    public function redirecionaLogin(Request $request)
    {
        if(session()->exists('idAdmin')) {
            return redirect()->to('/terras');
        } else {
            return view('pages.fazer-login');
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
        return redirect()->to('/');
    }
}
