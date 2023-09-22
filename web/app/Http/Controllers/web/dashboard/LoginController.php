<?php

namespace App\Http\Controllers\web\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function redirecionaLogin()
    {
        // Primeiro tem que verificar se já existe uma sessão ativa. Se já existe um usuario dentro dessa sessão.
        if (Auth::check()) { // retorna um booleano. True se tiver um login já efetuado e false caso não tenha.

            // Se for true redireciona para a página de 'dashboard/terras' o mapa de terras.
            return redirect()->route('terras');
        }

        // Caso não retorna para a rota que leva para a tela de login
        return view('dashboard.pages.login');
    }

    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|exists:users,email',
                'password' => 'min:6|required',
            ]);

            // Assim que ocorre uma unica falha o validator para de validar os atributos.
            if ($validator->stopOnFirstFailure()->fails()) {
                return response()->json([
                    'message' => $validator->messages()->first() // Retornar dentro do array de menssagens a primeira menssagem.
                ], 422);
            }

            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                // Se deu certo retorna o status code '200 Ok'. Indicando que a requisição foi bem-sucedida.
                return response()->json(200);
            } else {
                return response()->json([
                    'message'   => 'E-mail ou senha inválidos!',
                ], 400);
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
        Auth::logout();
        return redirect()->route('redireciona.login');
    }
}
