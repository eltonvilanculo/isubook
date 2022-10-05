<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrecedenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('precedencias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('ant_id');
            $table->unsignedBigInteger('prec_id');
            $table->foreign('ant_id')->references('id')->on('disciplinas');
            $table->foreign('prec_id')->references('id')->on('disciplinas');
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
        Schema::dropIfExists('precedencias');
    }
}