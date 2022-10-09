<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropinasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('propinas', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('estado',['paga','irregular'])->default('paga');
            $table->date('duracao');
            $table->unsignedBigInteger('estudante_id');
            $table->foreign('estudante_id')->references('id')->on('estudantes');
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
        Schema::dropIfExists('propinas');
    }
}