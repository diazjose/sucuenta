<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model
{
    protected $table = 'cuentas';

    protected $fillable = [
        'cliente_id', 'valor', 'estado',
    ];

    public function cliente(){
    	return $this->belongsTo('App\Cliente', 'cliente_id', 'id'); 
    }
    public function facturas(){
    	return $this->hasMany('App\Factura')->orderBy('id', 'DESC'); 

    }
}
