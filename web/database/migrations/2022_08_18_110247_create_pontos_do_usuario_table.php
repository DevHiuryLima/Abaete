<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePontosDoUsuarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pontos_do_usuario', function (Blueprint $table) {
            $table->id('idPontoUsuario');
            $table->unsignedBigInteger('usuario');
            $table->integer('pontos');

            $table->foreign('usuario')->references('idUsuario')->on('usuarios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pontos_do_usuario');
    }
}
