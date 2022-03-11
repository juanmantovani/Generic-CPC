<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('razon_social', 150);
            $table->string('cuil', 150);
            $table->string('direccion', 150);
            $table->unsignedBigInteger('ciudad_id');

            $table->index('ciudad_id','fk_clientes_ciudad_id');      // Indice de categoria
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
        Schema::dropIfExists('clientes');
    }
}
