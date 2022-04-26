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


Route::get('/terras', 'web\TerrasController@index')->name('terras');
Route::prefix('/terra')->group(function () {    
    Route::get('/criar', 'web\TerrasController@redirecionaCriarTerra')->name('terra-criar');
    Route::post('/criar', 'web\TerrasController@criarTerra')->name('criar');

    Route::get('/{idTerra}', 'web\TerrasController@redirecionaListarTerra')->name('terra-listar');
    
    Route::get('/editar/{idTerra}', 'web\TerrasController@redirecionaEditarTerra')->name('terra-editar');
    Route::get('/remover/imagem/{idImagem}', 'web\TerrasController@removerImagem')->name('remover-imagem');
    Route::post('/editar', 'web\TerrasController@editarTerra')->name('editar');
    
    Route::get('/remover/{idTerra}', 'web\TerrasController@removerTerra')->name('remover');
});

Route::get('/administradores', 'web\AdministradoresController@index')->name('administradores');
Route::prefix('/administrador')->group(function () {    
    Route::get('/criar', 'web\AdministradoresController@redirecionaCriarAdministrador')->name('administrador-criar');
    Route::post('/criar', 'web\AdministradoresController@criarAdministrador')->name('criar');
    Route::get('/editar/{idAdmin}', 'web\AdministradoresController@redirecionaEditarAdministrador')->name('administrador-listar');
    Route::post('/editar', 'web\AdministradoresController@editarAdministrador')->name('editar');
    Route::post('/remover', 'web\AdministradoresController@removerAdministrador')->name('remover');
    
    // Route::get('/remover/imagem/{idImagem}', 'web\AdministradoresController@removerImagem')->name('remover-imagem');
    // Route::post('/editar', 'web\AdministradoresController@editarTerra')->name('editar');
    
});

Route::get('/quizzes', 'web\QuizController@index')->name('quizzes');
Route::prefix('/quiz')->group(function () {    
    Route::get('/criar', 'web\QuizController@redirecionaCriarQuiz')->name('criar-quiz');
    // Route::post('/criar', 'web\AdministradoresController@criarAdministrador')->name('criar');
    // Route::get('/editar/{idAdmin}', 'web\AdministradoresController@redirecionaEditarAdministrador')->name('administrador-listar');
    // Route::post('/editar', 'web\AdministradoresController@editarAdministrador')->name('editar');
    // Route::post('/remover', 'web\AdministradoresController@removerAdministrador')->name('remover');
});


Route::get('storage-link',function (){ return \Illuminate\Support\Facades\Artisan::call('storage:link'); });
