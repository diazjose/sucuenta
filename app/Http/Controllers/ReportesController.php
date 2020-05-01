<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\Factura;


class ReportesController extends Controller
{
    public function imprimir(){
	     $pdf = PDF::loadView('reportes/prueba');
	     return $pdf->stream('prueba.pdf');
	     //return $pdf->download('ejemplo.pdf');
	}
	
	public function boleta($id){
        $factura = Factura::find($id);
        $pdf = PDF::loadView('reportes/boleta', compact(['factura']));
    	return $pdf->stream();
    	//return $pdf->download('primer.pdf');
    }
}
