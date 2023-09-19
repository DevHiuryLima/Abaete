<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\TerraController;
use App\Http\Controllers\API\UsuarioController;
use App\Http\Controllers\API\QuizController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['namespace' => 'API', 'as' => 'api.' ], function(){
    Route::apiResource('/terras', TerraController::class);
    Route::apiResource('/usuarios', UsuarioController::class);
    Route::post('/usuarios/login', [UsuarioController::class, 'login']);
    Route::apiResource('/quizzes', QuizController::class);
    Route::get('/quiz/busca', [QuizController::class, 'buscarPerguntaAleatoria']);
    Route::post('/quiz/responder', [QuizController::class, 'responderPerguntas']);
    Route::get('/ranking', [UsuarioController::class, 'usuariosPorPontos']);
});
