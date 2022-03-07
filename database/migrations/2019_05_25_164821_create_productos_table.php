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
            $table->integer('stock');
            $table->string('descripcion', 512)->nullable();
            $table->boolean('estado')->comment('0 inactivo, 1 activo');//0 inactivo, 1 activo
            $table->date('fecha_ingreso'); //fecha de ingreso de producto
            $table->date('fecha_vencimiento');
            $table->date('fecha_retiro_gondola');
            $table->integer('dias_ant_retiro');
            $table->string('imagen', 250)->nullable();

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
