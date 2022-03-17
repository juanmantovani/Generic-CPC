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
        //factory(App\Producto::class, 500)->create();
    	$faker = Faker\Factory::create('es_ES'); 
    	//$faker->locale('es_ES'); 

\DB::table('users')->insert(
	    		array(
			    	'name'=>'Damian',	
			        'email'=>'damian@damian.com',
			        'password'=>bcrypt('damian123')
			    )
	    	);

    	for($i=0; $i<500; $i++){
    		
	    	\DB::table('productos')->insert(
	    		array(
			    	'categoria_id'=>rand(1,7),	
			        'codigo'=>$faker->vat(100),
			        'nombre'=>$faker->name(),
			        'stock'=>$faker->numberBetween(0,500),
					'precio'=>$faker->numberBetween(0,500),
			        'descripcion'=>$faker->text(300),
			        'estado'=>$faker->randomElement([0,1]),
			        'fecha_ingreso'=>$faker->dateTimeInInterval($startDate='-10 days',$interval = '+ 15 days',$timezone = null , $format = 'Y-m-d'),
			        'fecha_vencimiento'=>$faker->dateTimeInInterval($startDate='-10 days',$interval = '+ 90 days',$timezone = null , $format = 'Y-m-d'),
					'fecha_retiro_gondola'=>$faker->dateTimeInInterval($startDate='-10 days',$interval = '+ 90 days',$timezone = null , $format = 'Y-m-d'),
            		'dias_ant_retiro'=>$faker->numberBetween(1,5),
			       // dateTimeInInterval($startDate = '-30 years', $interval = '+ 5 days', $timezone = null)
			       
			        'imagen'=>$faker->imageUrl($width=175,$height=223)
			    )
	    	);
    	}

    }
}
