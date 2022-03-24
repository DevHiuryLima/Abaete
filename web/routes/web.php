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

Route::get('/', function () {
    return view('index');
})->name('home');

Route::prefix('terra')->group(function () {
    // *INDEX
    Route::get('/listar', 'IndexController@index')->name('terra-listar');
    Route::get('/criar', 'IndexController@redirecionaCriarTerra')->name('terra-criar');
    // Route::get('/editar', 'IndexController@redirecionaCriarTerra')->name('terra-criar');
    // Route::get('/remover', 'IndexController@redirecionaCriarTerra')->name('terra-criar');
});
