<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        // $aeronave = Aeronave::where('aeronave_id', '=', base64_decode($request->idAeronave))
        // ->with('categorias')
        // ->with('imagens')
        // ->first();
        // $configuracao = Configuracoes::all();
        // $categorias = Categoria::all();

        // if (!$aeronave->count()) { 
        //     $aeronave = null;
        //     echo "<script>window.alert('Ocorreu um erro! Tente novamente mais tarde.')</script>";
        //     echo "<script language='javaScript'>window.setTimeout('history.back(-1)', 02);</script> ";
        // }
        // if (!$configuracao->count()) { $configuracao = null; }
        // if (!$categorias->count()) { $categorias = null; }

        return view('mapa-de-terras');
    }

    public function redirecionaCriarTerra(Request $request)
    {
        return view('criar-terra');
    }
}
