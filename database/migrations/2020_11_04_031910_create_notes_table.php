<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('assunto');
            $table->text('text');
            $table->unsignedInteger('user_id')->nullable();
            $table->integer('postador_id');
            $table->string('postador_name');
            // $table->integer('status'); // 0 = aberto - 1 = visualizado -2 = fechado
            $table->foreign('user_id')
                        ->references('id')
                        ->on('users')
                        ->onDelete('CASCADE');
            $table->timestampsTz();
            // $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notes');
    }
}
