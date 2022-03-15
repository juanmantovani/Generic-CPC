<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre', 150);
            $table->string('razon_social', 150);
            $table->string('cuil', 150);
            $table->string('direccion', 150);
            $table->integer('tipo');
            $table->unsignedBigInteger('ciudad_id');

            $table->index('ciudad_id','fk_personas_ciudad_id');      // Indice de categoria
            $table->foreign('ciudad_id')->references('id')->on('ciudades');    //Clave foreanea
            
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
        Schema::dropIfExists('personas');
    }
}
