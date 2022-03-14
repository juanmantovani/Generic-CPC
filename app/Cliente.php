<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    
    public function Ciudad()
    {
    	//Un cliente está asociado a una ciudad
    	return $this->belongsTo(Ciudad::class, 'ciudad_id');
    }
}
