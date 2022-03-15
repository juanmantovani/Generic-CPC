<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    public function ciudad()
    {
    	//Una persona pertenece a una ciudad
    	return $this->belongsTo(Categoria::class, 'ciudad_id');
    }
}
