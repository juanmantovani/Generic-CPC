<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('categoria_id');
            $table->string('codigo', 150)->nullable();
            $table->string('nombre', 150);
            $table->float('precio');
            $table->string('descripcion', 512)->nullable();
            $table->integer('activo');

            $table->index('categoria_id','fk_producto_categoria_id');      // Indice de categoria
            $table->foreign('categoria_id')->references('id')->on('categorias');    //Clave foreanea
            $table->softDeletes();
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
        Schema::dropIfExists('productos');
    }
}
