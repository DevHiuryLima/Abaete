<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\web\site\IndexController;

use App\Http\Controllers\web\dashboard\LoginController;
use App\Http\Controllers\web\dashboard\TerraController;
use App\Http\Controllers\web\dashboard\QuizController;
use App\Http\Controllers\web\dashboard\UserController;

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
    Route::get('/', [IndexController::class, 'index'])->name('home');
    Route::get('/terras', [IndexController::class, 'terras'])->name('site.terras');
    Route::get('/terra/{idTerra}', [IndexController::class, 'listarTerra'])->name('site.listar.terra');
});

Route::prefix('/dashboard')->group(function () {
    Route::get('/', [LoginController::class, 'redirecionaLogin'])->name('dashboard');
    Route::get('/login', [LoginController::class, 'redirecionaLogin'])->name('redireciona.login');
    Route::post('/login', [LoginController::class, 'login'])->name('login');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/terras', [TerraController::class, 'index'])->name('terras')->middleware('auth');
    Route::prefix('/terra')->group(function () {
        Route::get('/criar', [TerraController::class, 'redirecionaCriarTerra'])->name('redireciona.criar.terra')->middleware('auth');
        Route::post('/criar', [TerraController::class, 'criarTerra'])->name('criar.terra')->middleware('auth');
        Route::get('/{idTerra}', [TerraController::class, 'redirecionaListarTerra'])->name('listar.terra')->middleware('auth');
        Route::get('/editar/{idTerra}', [TerraController::class, 'redirecionaEditarTerra'])->name('redireciona.editar.terra')->middleware('auth');
        Route::post('/editar', [TerraController::class, 'editarTerra'])->name('editar.terra')->middleware('auth');
        Route::get('/remover/{idTerra}', [TerraController::class, 'removerTerra'])->name('remover.terra')->middleware('auth');

        Route::post('/remover/imagem', [TerraController::class, 'removerImagem'])->name('remover.imagem')->middleware('auth');
    });

    Route::get('/quizzes', [QuizController::class, 'index'])->name('quizzes')->middleware('auth');
    Route::prefix('/quiz')->group(function () {
        Route::get('/criar', [QuizController::class, 'redirecionaCriarQuiz'])->name('redireciona.criar.quiz')->middleware('auth');
        Route::post('/criar', [QuizController::class, 'criarQuiz'])->name('criar.quiz')->middleware('auth');
        Route::get('/editar/{idQuiz}', [QuizController::class, 'redirecionaEditarQuiz'])->name('redireciona.editar.quiz')->middleware('auth');
        Route::post('/editar', [QuizController::class, 'editarQuiz'])->name('editar.quiz')->middleware('auth');
        Route::post('/remover', [QuizController::class, 'removerQuiz'])->name('remover.quiz')->middleware('auth');
    });

    Route::get('/administradores', [UserController::class, 'index'])->name('administradores')->middleware('auth');
    Route::prefix('/administrador')->group(function () {
        Route::get('/criar', [UserController::class, 'redirecionaCriarAdministrador'])->name('redireciona.criar.administrador')->middleware('auth');
        Route::post('/criar', [UserController::class, 'criarAdministrador'])->name('criar.administrador')->middleware('auth');
        Route::get('/editar/{id}', [UserController::class, 'redirecionaEditarAdministrador'])->name('redireciona.editar.administrador')->middleware('auth');
        Route::post('/editar', [UserController::class, 'editarAdministrador'])->name('editar.administrador')->middleware('auth');
        Route::post('/remover', [UserController::class, 'removerAdministrador'])->name('remover.administrador')->middleware('auth');
    });
});


Route::get('storage-link',function (){ return \Illuminate\Support\Facades\Artisan::call('storage:link'); });
