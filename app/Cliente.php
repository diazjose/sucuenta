<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';

    protected $fillable = [
        'nombre', 'apellido', 'dni', 'email', 'direccion', 'telefono', 'image',
    ];

	public function cuenta(){
    	return $this->hasOne('App\Cuenta'); 
    }

}
