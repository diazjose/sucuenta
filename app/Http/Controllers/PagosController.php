<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cuenta;
use App\Factura;
use App\Producto;
use App\Pago;


class PagosController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id){
    	$cuenta = Cuenta::find($id);
        return view('pagos.index', ['cuenta' => $cuenta]);
    }

    public function register(Request $request){

    	$cuenta_id = $request->input('cuenta_id');
    	$cuenta = Cuenta::find($cuenta_id);
    	$cuenta->valor = $cuenta->valor - $request->input('monto'); 
    	$cuenta->update();

    	$factura = new Pago;
    	$factura->cuenta_id = $cuenta_id;
    	$factura->valor = $request->input('monto');
    	$factura->save();

    	return redirect()->route('pago.index', [$cuenta_id])
                         ->with(['message' => 'Pago Registrado correctamente', 'status' => 'success']); 
    }

    public function editarPago(Request $request){
        
        $pago = Pago::find($request->input('pago_id'));
        $cambiar = $request->input('monto') - $pago->valor;
        $pago->valor = $request->input('monto');
        $pago->update();
        
        $cuenta = Cuenta::find($pago->cuenta_id);        
        $cuenta->valor = $cuenta->valor - $cambiar;
        $cuenta->update();
        return redirect()->route('pago.index', [$cuenta->id])
                         ->with(['message' => 'Pago Actualizado correctamente', 'status' => 'success']);

    }

    public function deletePago(Request $request){

        $pago = Pago::find($request->input('pago_id'));
        
        $cuenta = Cuenta::find($pago->cuenta_id);        
        $cuenta->valor = $cuenta->valor + $pago->valor;
        $cuenta->update();

        $pago->delete();

         return redirect()->route('pago.index', [$cuenta->id])
                         ->with(['message' => 'El Pago se ha Eliminado correctamente ', 'status' => 'danger']);
    }
}
