<?php

use Illuminate\Database\Seeder;
class CiudadesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ciudades=['Paraná','Victoria','Crespo','Racedo','Diamante','Molino Doll','Valle María'];
    	
        foreach ($ciudades as $ciudad) {
            \DB::table('ciudades')->insert(array('nombre'=>$ciudad,
    		));
        };
    }
}
