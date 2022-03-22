<?php

use Illuminate\Database\Seeder;
use App\Categoria;
class CategoriasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$categorias=['Lacteos','Fideos','Embutidos','Enlatado','Bebidas','Mermelada','Azúcar'];
    	foreach ($categorias as $categoria) {
            \DB::table('categorias')->insert(array(
    			'nombre'=>$categoria,
    			'descripcion'=>"esto es la descripcion de una categoria de". $categoria,
    		));
        };
    }
}
