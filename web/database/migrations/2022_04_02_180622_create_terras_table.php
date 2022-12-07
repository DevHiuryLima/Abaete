<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTerrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terras', function (Blueprint $table) {
            $table->id('idTerra');
            $table->string('nome');
            $table->string('populacao');
            $table->string('povos');
            $table->string('lingua');
            $table->string('modalidade');
            $table->text('sobre');
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 10, 8);
            $table->string('estado');
            $table->string('referencia_das_fotos')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('terras');
    }
}
