<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArquivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arquivos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('assunt');
            $table->unsignedInteger('user_id');
            $table->integer('status')->default('0');
            $table->integer('visibility')->default('0');
            $table->integer('direction');
            $table->string('path');
            $table->string('notes')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('arquivos');
    }
}
