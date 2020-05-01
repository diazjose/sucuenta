<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    protected $table = 'facturas';

    protected $fillable = [
        'cuenta_id', 'valor',
    ];

    public function cuenta(){
    	return $this->belongsTo('App\Cuenta', 'cuenta_id'); 
    }

    public function productos(){
    	return $this->hasMany('App\Producto');
    }
}
