<?php

namespace App\Http\Controllers\API;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Exception;
use App\Models\ImagensTerra;
use App\Models\Terra;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TerraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $terras = Terra::with('cidades')->with('imagensTerra')->get();

        if(!$terras->count()) {
            return response()->json([
                'message'   => 'Terras não encontrada!',
            ], 404);
        }

        return response()->json($terras, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $terra = Terra::where('idTerra', '=', $id)
            ->with('cidades')
            ->with('imagensTerra')
            ->first();

        if(!$terra) {
            return response()->json([
                'message'   => 'Terra não encontrada!',
                // 'error'   => $th->getMessage(),
            ], 404);
        }

        return response()->json($terra, 200);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
