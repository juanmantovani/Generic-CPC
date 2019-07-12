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
    	for ($i=0; $i<7; $i++){
    		\DB::table('categorias')->insert(array(
    			'nombre'=>$categorias[$i],
    			'descripcion'=>"esto es la descripcion de una categoria de". $categorias[$i],
    			'condicion'=>1
    		));
    	}
    }
}
