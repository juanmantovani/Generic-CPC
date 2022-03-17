<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
        //campos que permiten masss assignament
    protected $fillable =[
    	'nombre',
    	'descripcion',
    	'condicion'
    ];

        public function articulos()
    {
    	//Una Categoria puede tener muchos artículos
    	return $this->hasMany(Articulo::class);
    }
}
