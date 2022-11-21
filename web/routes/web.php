<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::prefix('/')->group(function () {
    Route::get('/', 'web\IndexController@index')->name('home');
    Route::get('/login', 'web\IndexController@redirecionaLogin')->name('login');
    Route::post('/login', 'web\IndexController@login')->name('fazer-login');
    Route::get('/logout', 'web\IndexController@logout')->name('logout');
});


Route::get('/terras', 'web\TerraController@index')->name('terras');
Route::prefix('/terra')->group(function () {
    Route::get('/criar', 'web\TerraController@redirecionaCriarTerra')->name('redireciona.criar.terra');
    Route::post('/criar', 'web\TerraController@criarTerra')->name('criar.terra');
    Route::get('/{idTerra}', 'web\TerraController@redirecionaListarTerra')->name('listar.terra');
    Route::get('/editar/{idTerra}', 'web\TerraController@redirecionaEditarTerra')->name('redireciona.editar.terra');
    Route::post('/editar', 'web\TerraController@editarTerra')->name('editar.terra');
    Route::get('/remover/{idTerra}', 'web\TerraController@removerTerra')->name('remover.terra');

    Route::post('/remover/imagem', 'web\TerraController@removerImagem')->name('remover.imagem');
});

Route::get('/quizzes', 'web\QuizController@index')->name('quizzes');
Route::prefix('/quiz')->group(function () {
    Route::get('/criar', 'web\QuizController@redirecionaCriarQuiz')->name('redireciona.criar.quiz');
    Route::post('/criar', 'web\QuizController@criarQuiz')->name('criar.quiz');
    Route::get('/editar/{idQuiz}', 'web\QuizController@redirecionaEditarQuiz')->name('redireciona.editar.quiz');
    Route::post('/editar', 'web\QuizController@editarQuiz')->name('editar.quiz');
    Route::post('/remover', 'web\QuizController@removerQuiz')->name('remover.quiz');
});

Route::get('/administradores', 'web\AdministradorController@index')->name('administradores');
Route::prefix('/administrador')->group(function () {
    Route::get('/criar', 'web\AdministradorController@redirecionaCriarAdministrador')->name('redireciona.criar.administrador');
    Route::post('/criar', 'web\AdministradorController@criarAdministrador')->name('criar.administrador');
    Route::get('/editar/{idAdmin}', 'web\AdministradorController@redirecionaEditarAdministrador')->name('redireciona.editar.administrador');
    Route::post('/editar', 'web\AdministradorController@editarAdministrador')->name('editar.administrador');
    Route::post('/remover', 'web\AdministradorController@removerAdministrador')->name('remover.administrador');
});


Route::get('storage-link',function (){ return \Illuminate\Support\Facades\Artisan::call('storage:link'); });
