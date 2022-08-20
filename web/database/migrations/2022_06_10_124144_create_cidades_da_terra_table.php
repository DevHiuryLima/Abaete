<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCidadesDaTerraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cidades_da_terra', function (Blueprint $table) {
            $table->id('idCidadeTerra');
            $table->unsignedBigInteger('terra');
            $table->string('cidade');
            $table->timestamps();

            $table->foreign('terra')->references('idTerra')->on('terras')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cidades_da_terra');
    }
}
