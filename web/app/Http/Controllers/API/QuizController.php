<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Quiz;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quizzes = Quiz::with('terra_relacionada')->get();

        if(!$quizzes->count()) {
            return response()->json([
                'message'   => 'Quizzes não encontrado!',
            ], 404);
        }

        return response()->json($quizzes, 200);
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
        $quiz = Quiz::where('idQuiz', '=', $id)->with('terra_relacionada')->first();

        if(!$quiz) {
            return response()->json([
                'message'   => 'Quiz não encontrado!',
            ], 404);
        }
        
        return response()->json($quiz, 200);
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function buscarPerguntaAleatoria()
    {
        $query = "SELECT * FROM quizzes ORDER BY RAND() LIMIT 1";
        // $quiz = Quiz::orderBy(DB::raw('RAND()'))->limit(1)->first(); // OK
        $quiz = Quiz::orderBy(DB::raw('RAND()'))->first(); // OK

        if(!$quiz) {
            return response()->json([
                'message'   => 'Pergunta não encontrada!',
            ], 404);
        }

        return response()->json($quiz, 200);
    }
}
