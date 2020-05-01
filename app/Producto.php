<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';

    protected $fillable = [
        'factura_id', 'denominacion', 'valor', 'cantidad',
    ];

    public function factura(){
    	return $this->belongsTo('App\Factura', 'factura_id');

    }
}
