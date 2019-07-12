<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;


$factory->define(App\Producto::class, function (Faker $faker) {

	
       $title=$faker->sentence(4);
    return [
        'categoria_id'=>rand(1,7),
        'codigo'=>$faker->vat(100),
        'nombre'=>$title,
        'stock'=>$faker->numberBetween(0,500),
        'descripcion'=>$faker->text(500),
        'estado'=>$faker->randomElement([0,1]),
        'fecha_ingreso'=>$faker->dateTimeInInterval($startDate='-10 days',$interval = '+ 15 days',$timezone = null , $format = 'Y-m-d'),
        'fecha_vencimiento'=>$faker->dateTimeInInterval($startDate='-10 days',$interval = '+ 90 days',$timezone = null , $format = 'Y-m-d'),
       // dateTimeInInterval($startDate = '-30 years', $interval = '+ 5 days', $timezone = null)
       
        'imagen'=>$faker->imageUrl($width=175,$height=223),

    ];
});
