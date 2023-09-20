<?php

namespace App\Http\Controllers\web\site;

use App\Http\Controllers\Controller;
use App\Models\Terra;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        return view('site.index');
    }

    public function terras(Request $request)
    {
        return view('site.terras.mapa-de-terras');
    }

    public function listarTerra(Request $request)
    {
        $terra = Terra::where('idTerra', '=', $request->idTerra)
            ->with('cidades')
            ->with('imagensTerra')
            ->first();

        if ($terra == null) {
            echo "<script>window.alert('Ocorreu um erro ao buscar terra! Por favor, tente novamente mais tarde.')</script>";
            echo "<script language='javaScript'>window.setTimeout('history.back(-1)', 02);</script> ";
        }

        return view('site.terras.listar-terra', compact('terra'));
    }
}
