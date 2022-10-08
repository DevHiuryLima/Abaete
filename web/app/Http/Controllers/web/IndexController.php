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
        $validator = Validator::make($request->all(), [
            // 'email' => 'required|email|required_with:confirmarEmail|same:confirmarEmail',
            'email' => 'required|email|exists:administradores,email',
            // 'confirmarEmail' => 'required',
            // 'senha' => 'min:6|required_with:confirmarSenha|same:confirmarSenha',
            'senha' => 'min:6|required',
            // 'confirmarSenha' => 'required',
        ]);

        if ($validator->stopOnFirstFailure()->fails()) {
            return response()->json($validator->messages(), 422);
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

        // $credentials = $request->only('email', 'senha');

        // // Vai fazer uma tentativa de login
        // if (Auth::attempt($credentials)) {

        // } else {
        //     return response()->json([
        //         'message'   => 'Login ou senha inválidos!',
        //     ], 400);
        // }

    }

    public function logout()
    {
        session()->remove('idAdmin');
        return redirect()->to('/');
    }
}
