<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{


	public function categoria()
    {
    	//Un Articulo puede pertenecer a una Categoria
    	return $this->belongsTo(Categoria::class, 'categoria_id');
    }

}
