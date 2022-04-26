<?php

namespace App\Http\Controllers\web;

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
        $admin = DB::table('administradores')->where([
            ['login', '=', $request->login],
            ['senha', '=', base64_encode($request->senha)],
        ])->first();
        
        if ($admin == null){
            return response()->json([
                'message'   => 'Login ou senha inválidos!',
            ], 400);
        } else {
            session()->put('idAdmin', $admin->idAdmin);
            return response()->json(200);
        }

    }

    public function logout()
    {
        session()->remove('idAdmin');
        return redirect()->to('/');
    }
}
