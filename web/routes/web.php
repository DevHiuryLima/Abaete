<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\web\site\IndexController;

use App\Http\Controllers\web\dashboard\LoginController;
use App\Http\Controllers\web\dashboard\TerraController;
use App\Http\Controllers\web\dashboard\QuizController;
use App\Http\Controllers\web\dashboard\AdministradorController;

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

    Route::get('/terras', [TerraController::class, 'index'])->name('terras');
    Route::prefix('/terra')->group(function () {
        Route::get('/criar', [TerraController::class, 'redirecionaCriarTerra'])->name('redireciona.criar.terra');
        Route::post('/criar', [TerraController::class, 'criarTerra'])->name('criar.terra');
        Route::get('/{idTerra}', [TerraController::class, 'redirecionaListarTerra'])->name('listar.terra');
        Route::get('/editar/{idTerra}', [TerraController::class, 'redirecionaEditarTerra'])->name('redireciona.editar.terra');
        Route::post('/editar', [TerraController::class, 'editarTerra'])->name('editar.terra');
        Route::get('/remover/{idTerra}', [TerraController::class, 'removerTerra'])->name('remover.terra');

        Route::post('/remover/imagem', [TerraController::class, 'removerImagem'])->name('remover.imagem');
    });

    Route::get('/quizzes', [QuizController::class, 'index'])->name('quizzes');
    Route::prefix('/quiz')->group(function () {
        Route::get('/criar', [QuizController::class, 'redirecionaCriarQuiz'])->name('redireciona.criar.quiz');
        Route::post('/criar', [QuizController::class, 'criarQuiz'])->name('criar.quiz');
        Route::get('/editar/{idQuiz}', [QuizController::class, 'redirecionaEditarQuiz'])->name('redireciona.editar.quiz');
        Route::post('/editar', [QuizController::class, 'editarQuiz'])->name('editar.quiz');
        Route::post('/remover', [QuizController::class, 'removerQuiz'])->name('remover.quiz');
    });

    Route::get('/administradores', [AdministradorController::class, 'index'])->name('administradores');
    Route::prefix('/administrador')->group(function () {
        Route::get('/criar', [AdministradorController::class, 'redirecionaCriarAdministrador'])->name('redireciona.criar.administrador');
        Route::post('/criar', [AdministradorController::class, 'criarAdministrador'])->name('criar.administrador');
        Route::get('/editar/{idAdmin}', [AdministradorController::class, 'redirecionaEditarAdministrador'])->name('redireciona.editar.administrador');
        Route::post('/editar', [AdministradorController::class, 'editarAdministrador'])->name('editar.administrador');
        Route::post('/remover', [AdministradorController::class, 'removerAdministrador'])->name('remover.administrador');
    });
});


Route::get('storage-link',function (){ return \Illuminate\Support\Facades\Artisan::call('storage:link'); });
