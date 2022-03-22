<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosPedidoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos_pedido', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('producto_id');
            $table->unsignedBigInteger('pedido_id');
            $table->integer('cantidad');

            $table->index('producto_id','fk_productos_pedido_producto_id');   
            $table->foreign('producto_id')->references('id')->on('productos');
            $table->index('pedido_id','fk_productos_pedido_pedido_id');   
            $table->foreign('pedido_id')->references('id')->on('pedidos'); 
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
        Schema::dropIfExists('productos_pedido');
    }
}
