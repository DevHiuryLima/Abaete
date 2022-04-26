<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id('idQuiz');
            $table->unsignedBigInteger('terra');
            $table->string('tipo');
            $table->string('pergunta');
            $table->string('alternativa_a')->nullable();
            $table->string('alternativa_b')->nullable();
            $table->string('alternativa_c')->nullable();
            $table->string('alternativa_correta')->nullable();
            $table->string('verdadeiro_ou_falso')->nullable();
            $table->string('pontos');
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
        Schema::dropIfExists('quizzes');
    }
}
