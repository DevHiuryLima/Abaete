<?php

namespace App\Http\Controllers\web;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\CidadeTerra;
use App\Models\ImagensTerra;
use App\Models\Terra;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TerraController extends Controller
{
    public function index(Request $request)
    {
        if(session()->exists('idAdmin')) {
            return view('terras.mapa-de-terras');
        } else {
            return redirect()->to('/login');
        }
    }

    public function redirecionaCriarTerra(Request $request)
    {
        if(session()->exists('idAdmin')) {
            return view('terras.criar-terra');
        } else {
            return redirect()->to('/login');
        }
    }

    public function criarTerra(Request $request)
    {
        if(session()->exists('idAdmin')) {
            $terra = new Terra();
            $terra->nome = $request->nome;
            $terra->populacao = $request->populacao . " Pessoas";
            $terra->povos = $request->povos;
            $terra->lingua = $request->lingua;
            $terra->modalidade = $request->modalidade;
            $terra->estado = $request->uf;
            $terra->latitude = $request->latitude;
            $terra->longitude = $request->longitude;
            $terra->sobre = $request->sobre;
            $status = $terra->save();

            // Cadastrar cada cidade da terra.
            foreach ($request->citys as $city) {
                $cidade = new CidadeTerra();
                $cidade->terra = $terra->idTerra;
                $cidade->cidade = $city;
                $status = $cidade->save();
            }

            // Cadastrar cada imagem da terra.
            for ($i=0; $i < count($request->file('images')); $i++) {
                $imagens = new ImagensTerra();
                $imagens->terra = $terra->idTerra;
                $imagens->url = env('APP_URL') . "/storage/" . $request->file('images')[$i]->store("imagens-terras");
                $status = $imagens->save();
            }

            if($status == true){
                echo "<script>window.alert('Cadastrado com sucesso!')</script>";
                return redirect()->to('/terras');
            } else {
                $terra->delete();
                echo "<script>window.alert('Ocorreu um erro ao cadastrar terra! Por favor, tente novamente mais tarde.')</script>";
                echo "<script language='javaScript'>window.setTimeout('history.back(-1)', 02);</script> ";
            }
        } else {
            return redirect()->to('/login');
        }
    }

    public function redirecionaListarTerra(Request $request)
    {
        if(session()->exists('idAdmin')) {
            $terra = Terra::where('idTerra', '=', $request->idTerra)
                ->with('cidades')
                ->with('imagensTerra')
                ->first();

            if ($terra == null) {
                echo "<script>window.alert('Ocorreu um erro ao buscar terra! Por favor, tente novamente mais tarde.')</script>";
                echo "<script language='javaScript'>window.setTimeout('history.back(-1)', 02);</script> ";
            }

            return view('terras.listar-terra', compact('terra'));
        } else {
            return redirect()->to('/login');
        }
    }

    public function redirecionaEditarTerra(Request $request)
    {
        if(session()->exists('idAdmin')) {
            $terra = Terra::where('idTerra', '=', $request->idTerra)
                ->with('cidades')
                ->with('imagensTerra')
                ->first();

            if ($terra == null) {
                echo "<script>window.alert('Ocorreu um erro ao buscar terra! Por favor, tente novamente mais tarde.')</script>";
                echo "<script language='javaScript'>window.setTimeout('history.back(-1)', 02);</script> ";
            }

            return view('terras.editar-terra', compact('terra'));
        } else {
            return redirect()->to('/login');
        }
    }

    public function editarTerra(Request $request)
    {
        if(session()->exists('idAdmin')) {
            $terra = Terra::find($request->idTerra);

            if ($terra != null) {

                $terra->nome = $request->nome;
                $terra->populacao = $request->populacao . " Pessoas";
                $terra->povos = $request->povos;
                $terra->lingua = $request->lingua;
                $terra->modalidade = $request->modalidade;
                $terra->estado = $request->uf;
                $terra->latitude = $request->latitude;
                $terra->longitude = $request->longitude;
                $terra->sobre = $request->sobre;
                $status = $terra->save();

                //Removendo as cidade antigas para adicionar novas.
                $cidades = CidadeTerra::where('terra', '=', $terra->idTerra)->get();
                foreach ($cidades as $cidade) {
                    $status = $cidade->delete();
                }

                // Cadastrar cada cidade da terra.
                foreach ($request->citys as $city) {
                    $cidade = new CidadeTerra();
                    $cidade->terra = $terra->idTerra;
                    $cidade->cidade = $city;
                    $status = $cidade->save();
                }


                if ($request->images != null) {
                    // Cadastrar cada imagem da terra.
                    for ($i=0; $i < count($request->file('images')); $i++) {
                        $imagens = new ImagensTerra();
                        $imagens->terra = $terra->idTerra;
                        $imagens->url = env('APP_URL') . "/storage/" . $request->file('images')[$i]->store("imagens-terras");
                        $status = $imagens->save();
                    }
                }

                if($status == true){
                    echo "<script>window.alert('Cadastrado com sucesso!')</script>";
                    return redirect()->to('/terras');
                } else {
                    $terra->delete();
                    echo "<script>window.alert('Ocorreu um erro ao cadastrar terra! Por favor, tente novamente mais tarde.')</script>";
                    echo "<script language='javaScript'>window.setTimeout('history.back(-1)', 02);</script> ";
                }
            } else {
                echo "<script>window.alert('Ocorreu um erro ao buscar Terra! Por favor, tente novamente mais tarde.')</script>";
                echo "<script language='javaScript'>window.setTimeout('history.back(-1)', 02);</script> ";
            }
        } else {
            return redirect()->to('/login');
        }
    }

    public function removerTerra(Request $request)
    {
        if(session()->exists('idAdmin')) {
            $terra = Terra::find($request->idTerra);

            if ($terra == null) {
                echo "<script>window.alert('Ocorreu um erro ao buscar terra! Por favor, tente novamente mais tarde.')</script>";
                echo "<script language='javaScript'>window.setTimeout('history.back(-1)', 02);</script> ";
            }

            $imagens_terra = ImagensTerra::where('terra', '=', $request->idTerra)->get();

            if ($imagens_terra->count()) {

                $retirar = array(env('APP_URL'), "/storage/");

                foreach ($imagens_terra as $img) {
                    $path = str_replace($retirar, '', $img->url);
                    Storage::delete($path);
                    $img->delete();
                }
            }

            $status = $terra->delete();

            if($status == true){
                echo "<script>window.alert('Terra removida com sucesso!')</script>";
                return redirect()->to('/terras');
            } else {
                echo "<script>window.alert('Ocorreu um erro ao deletar terra! Por favor, tente novamente mais tarde.')</script>";
                echo "<script language='javaScript'>window.setTimeout('history.back(-1)', 02);</script> ";
            }
        } else {
            return redirect()->to('/login');
        }
    }

    public function removerImagem(Request $request)
    {
        if(session()->exists('idAdmin')) {
            $imagem = ImagensTerra::find($request->idImagem);
            if ($imagem == null) {
                return response()->json([
                    'message'   => 'Ocorreu um erro ao buscar imagem! Por favor, tente novamente mais tarde.',
                ], 400);
            }

            $retirar = array(env('APP_URL'), "/storage/");
            $path = str_replace($retirar, '', $imagem->url);
            Storage::delete($path);

            $status = $imagem->delete();

            if($status == true){
                return response()->json(['message' => 'removido', 200]);
            } else {
                return response()->json([
                    'message'   => 'Ocorreu um erro ao remover imagem! Por favor, tente novamente mais tarde.',
                ], 422);
            }
        } else {
            return redirect()->to('/login');
        }
    }
}
