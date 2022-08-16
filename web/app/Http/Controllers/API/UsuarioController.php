<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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
        $usuarios = Usuario::all();

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
        $usuarios = DB::table('usuarios')->where([
            ['email', '=', $request->email],
            ['senha', '=', base64_encode($request->senha)],
        ])->get();

        if (!$usuarios->count()){
            try {
                $usuarios = new Usuario();

                $usuarios->nome = $request->nome;
                $usuario->imagem = env('APP_URL') . "/storage/" . $request->file('imagem')->store("imagens-usuarios");
                $usuarios->email = $request->email;
                $usuarios->senha = base64_encode($request->senha);
                $status = $usuarios->save();

                if($status == true){
                    return response()->json($usuarios, 200);
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
                'message' => 'Esse Usuario já está cadastrado!',
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
        $usuario = Usuario::find($id);

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
        $usuario = Usuario::find($request->idUsuario);

        if ($usuario != null){

            $usuarios = DB::table('usuarios')->where([
                ['email', '=', $request->email],
                ['senha', '=', base64_encode($request->senha)],
                ['idUsuario', '!=', $request->idUsuario],
            ])->get();

            if (!$usuarios->count()){
                try {
                    $usuario->nome = $request->nome;
                    if ($request->imagem != null) {
                        $usuario->imagem = env('APP_URL') . "/storage/" . $request->file('imagem')->store("imagens-usuarios");
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
        $usuario = Usuario::find($request->idUsuario);

        if ($usuario != null){
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
}
