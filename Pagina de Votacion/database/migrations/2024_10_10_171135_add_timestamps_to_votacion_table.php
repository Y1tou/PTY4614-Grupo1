<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeEstadoColumnTypeInVotacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('votacion', function (Blueprint $table) {
            $table->string('ESTADO')->change(); // Cambiar a VARCHAR
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('votacion', function (Blueprint $table) {
            $table->integer('ESTADO')->change(); // Cambiar de nuevo a INTEGER si es necesario
        });
    }
}
