<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Relaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Detalle', function($table)
        {
            $table->integer('id_solicitud')->unsigned()->change();
            $table->foreign('id_solicitud')->references('id_solicitud')->on('solicitudes')->change();
            $table->integer('id_elemento')->unsigned()->change();
            $table->foreign('id_elemento')->references('id_elemento')->on('elementos')->change();
            $table->integer('id_dia')->unsigned()->change();
            $table->foreign('id_dia')->references('id_dia')->on('dias')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
