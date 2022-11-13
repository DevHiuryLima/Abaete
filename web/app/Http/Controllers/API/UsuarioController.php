<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\PontosDoUsuario;
use App\Models\Usuario;
use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = Usuario::with('pontuacao')->get();

        if(!$usuarios->count()) {
            return response()->json([
                'message'   => 'Usuários não encontrado!',
            ], 404);
        }

        return response()->json($usuarios, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required',
            'imagem' => 'required',
            'email' => 'required|email|required_with:confirmarEmail|same:confirmarEmail',
            'confirmarEmail' => 'required',
            'senha' => 'required_with:confirmarSenha|same:confirmarSenha',
            'confirmarSenha' => 'required',
        ]);

        if ($validator->stopOnFirstFailure()->fails()) {
            return response()->json($validator->messages(), 422);
        }

        $usuarios = DB::table('usuarios')->where([
            ['email', '=', $request->email],
            ['senha', '=', base64_encode($request->senha)],
        ])->get();

        if (!$usuarios->count()){
            try {
                $usuario = new Usuario();

                $usuario->nome = $request->nome;
                $usuario->imagem = $request->file('imagem')->store("imagens-usuarios");
                $usuario->email = $request->email;
                $usuario->senha = base64_encode($request->senha);
                $status = $usuario->save();


                if($status == true){
                    $pontuacao = new PontosDoUsuario();
                    $pontuacao->usuario = $usuario->idUsuario;
                    $pontuacao->pontos = 0;
                    $status = $pontuacao->save();

                    if($status == true){
                        return response()->json($usuario, 200);
                    } else {
                        $pontuacao->delete();
                        $usuarios->delete();
                        return response()->json([
                            'message'   => 'Ocorreu um erro no cadastro!',
                        ], 422);
                    }
                }else {
                    $usuarios->delete();
                    return response()->json([
                        'message'   => 'Ocorreu um erro no cadastro!',
                    ], 422);
                }
            } catch (\Throwable $th) {
                return response()->json([
                    'message'   => $th->getMessage(),
                ], 500);
            }
        } else {
            return response()->json([
                'message' => 'Esse Usuário já está cadastrado!',
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usuario = Usuario::where('idUsuario', '=', $id)->with('pontuacao')->first();

        $usuario['url'] = env('APP_URL') . '/storage/';

        if(!$usuario) {
            return response()->json([
                'message'   => 'Usuário não encontrado!',
            ], 404);
        }
        
        return response()->json($usuario, 200);
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
        echo dd($request->all());
        $usuario = Usuario::find($request->id);

        if ($usuario != null){

            $usuarios = DB::table('usuarios')->where([
                ['email', '=', $request->email],
                ['senha', '=', base64_encode($request->senha)],
                ['idUsuario', '!=', $request->id],
            ])->get();

            if (!$usuarios->count()){
                try {
                    $usuario->nome = $request->nome;
                    if ($request->imagem != null) {
                        $retirar = array(env('APP_URL'), "/storage/");
                        $path = str_replace($retirar, '', $usuario->imagem);
                        Storage::delete($path);
                        
                        $usuario->imagem = $request->file('imagem')->store("imagens-usuarios");
                    }
                    $usuario->email = $request->email;
                    $usuario->senha = base64_encode($request->senha);
                    $status = $usuario->save();

                    if($status == true){
                        return response()->json($usuario, 200);
                    }else {
                        $usuario->delete();
                        return response()->json([
                            'message'   => 'Ocorreu um erro no cadastro!',
                        ], 422);
                    }
                } catch (\Throwable $th) {
                    return response()->json([
                        'message'   => $th->getMessage(),
                    ], 422);
                }
            } else {
                return response()->json([
                    'message'   => 'Esse Usuário já está cadastrado!',
                ], 422);
            }
        } else {
            return response()->json([
                'message'   => 'Usuário não encontrado!',
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario = Usuario::find($id);

        if ($usuario != null){

            $retirar = array(env('APP_URL'), "/storage/");
            $path = str_replace($retirar, '', $usuario->imagem);
            Storage::delete($path);

            $status = $usuario->delete();

            if($status == true){
                return response()->json(202);
            }else {
                return response()->json([
                    'message'   => 'Ocorreu um erro na remoção!',
                ], 422);
            }
        } else {
            return response()->json([
                'message'   => 'Usuário não encontrado!',
            ], 404);
        }
    }

    public function login(Request $request)
    {
        $usuario = DB::table('usuarios')->where([
            ['email', '=', $request->email],
            ['senha', '=', base64_encode($request->senha)],
        ])->first();
        
        if ($usuario == null){
            return response()->json([
                'message'   => 'Login ou senha inválidos!',
            ], 400);
        } else {
            // session()->put('idUsuario', $admin->idUsuario);
            return response()->json($usuario, 200);
        }

    }

    public function logout()
    {
        // session()->remove('idAdmin');
        // return redirect()->to('/');
        return response()->json(200);
    }

    public function usuariosPorPontos()
    {
        $usuarios = PontosDoUsuario::with('usuario')->orderBy('pontos', 'desc')->get();

        $arrayUsuarios = array();
        foreach ($usuarios as $usuario) {
            $usuario['url'] = env('APP_URL') . '/storage/';
        }

        if(!$usuarios->count()) {
            return response()->json([
                'message'   => 'Usuários não encontrado!',
            ], 404);
        }

        return response()->json($usuarios, 200);
    }
}
