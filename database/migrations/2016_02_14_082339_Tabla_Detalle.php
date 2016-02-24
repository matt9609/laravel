<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaDetalle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Detalle', function (Blueprint $table) {
            $table->increments('id_detalle');
            $table->integer('id_solicitud');
            $table->integer('id_elemento');
            $table->integer('cantidad', 100000);
            $table->integer('id_día');
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
