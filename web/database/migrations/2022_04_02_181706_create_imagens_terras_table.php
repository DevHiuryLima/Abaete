<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagensTerrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagens_terras', function (Blueprint $table) {
            $table->id('idImagem');
            $table->unsignedBigInteger('terra');
            $table->string('url');
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
        Schema::dropIfExists('imagens_terras');
    }
}
