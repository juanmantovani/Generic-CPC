<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    //Se realiza la aclaración para que no busque la table "ciudads"
    protected $table='ciudades';

    protected $fillable =[
    	'nombre'
    ];
}
