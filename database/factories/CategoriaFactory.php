<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;


$factory->define(App\Categoria::class, function (Faker $faker) {
$categorias=['Lacteos','Fideos','Embutidos','Enlatado','Bebidas','Mermelada','Azúcar'];
	$title=$faker->unique()->word(5);

        //Esto no esta andando, se usa el databasaseeddeer
    return [
        'nombre'=>$title,
        'descripcion'=>"esto es la descripcion de una categoria de",
        'condicion'=>1,
    ];
});

