<?php

use Illuminate\Database\Seeder;

class ProductosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker\Factory::create('es_ES'); 

    	for($i=0; $i<500; $i++){
    		
	    	\DB::table('productos')->insert(
	    		array(
			    	'categoria_id'=>rand(1,7),	
			        'codigo'=>$faker->vat(100),
			        'nombre'=>$faker->name(),
					'precio'=>$faker->numberBetween(0,500),
			        'descripcion'=>$faker->text(300),
			    )
	    	);
    	}

    }
}
