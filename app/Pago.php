<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $table = 'pagos';

    protected $fillable = [
        'cuenta_id', 'valor',
    ];

    public function cuenta(){
    	return $this->belongsTo('App\Cuenta', 'cuenta_id');

    }
}
