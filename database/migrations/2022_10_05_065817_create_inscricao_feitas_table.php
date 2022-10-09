<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInscricaoFeitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscricao_feitas', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('estado',['Em actividade','Aprovada','Reprovada','Cancelada'])->default('Em actividade');
            $table->unsignedBigInteger('disciplina_id');
            $table->foreign('disciplina_id')->references('id')->on('disciplinas');
            $table->unsignedBigInteger('inscricao_id');
            $table->foreign('inscricao_id')->references('id')->on('inscricoes');
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
        Schema::dropIfExists('inscricao_feitas');
    }
}