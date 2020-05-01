<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cuenta;
use App\Factura;
use App\Producto;


class FacturasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id){
    	$cuenta = Cuenta::find($id);
        return view('facturas.index', ['cuenta' => $cuenta]);
    }

    public function register(Request $request){

    	$cuenta_id = $request->input('cuenta_id');
    	$cuenta = Cuenta::find($cuenta_id);
    	$cuenta->valor = $cuenta->valor + $request->input('total'); 
    	$cuenta->update();

    	$factura = new Factura;
    	$factura->cuenta_id = $cuenta_id;
    	$factura->valor = $request->input('total');
    	$factura->save();

    	return response()->json($factura); 
    }

    public function prenda(Request $request){
		
    	$producto = new Producto;

    	$producto->factura_id = $request->input('factura_id');
    	$producto->denominacion = $request->input('prenda');
    	$producto->valor = $request->input('precio');
    	$producto->cantidad = $request->input('cantidad');

    	$producto->save();

	}

    public function boletaedit($id){
        $productos = Producto::where('factura_id',$id)->get();

        $html = '';
        foreach ($productos as $producto) {
            $html.= '<tr id="$poducto->id">'; 
                $html .= '<td class="prenda"><input type="text" value="'.$producto->denominacion.'"></td>';
                $html .= '<td class="cantidad"><input type="text" value="'.$producto->cantidad.'"></td>';
                $html .= '<td class="precio"><input type="text" value="'.$producto->valor.'"></td>';
                $importe = $producto->cantidad*$producto->valor;
                $html .= '<td class="importe"><input type="text" value="'.$importe.'"></td>';
            $html .= '</tr>';    
        }    
        return response()->json($html); 
    }

    public function boleta($id){
        $factura = Factura::find($id);
        return view('facturas.editar', ['factura' => $factura]);
    }

    public function editarPrenda(Request $request){
        
        $producto = Producto::find($request->input('producto_id'));
        $val1 = $producto->valor * $producto->cantidad;
        $val2 = $request->input('precio') * $request->input('cantidad');
        $cambiar = $val2 - $val1;

        $producto->denominacion = $request->input('prenda');
        $producto->cantidad = $request->input('cantidad');
        
        $producto->valor = $request->input('precio');
        $producto->update();
        
        $factura = $request->input('factura_id');        
        $productos = Producto::where('factura_id',$factura)->get();
        $imp = 0;
        foreach ($productos as $pro) {
            $importe = $pro->cantidad * $pro->valor;
            $imp = $imp + $importe;
        }

        $fact = Factura::find($factura);
        $fact->valor = $imp;
        $fact->update();
        
        $cuenta = Cuenta::find($fact->cuenta_id);
        
        $cuenta->valor = $cuenta->valor + $cambiar;
        $cuenta->update();
        return redirect()->route('compra.boleta', [$factura])
                         ->with(['message' => 'Prenda Actualizado correctamente', 'status' => 'success']);

    }

    public function deletePrenda(Request $request){

        $producto = Producto::find($request->input('producto_id'));
        $val1 = $producto->valor * $producto->cantidad;
        $val2 = $request->input('precio') * $request->input('cantidad');
        $cambiar = $val2 - $val1;
        
        $producto->delete();

        $factura = $request->input('factura_id');        
        $productos = Producto::where('factura_id',$factura)->get();
        $imp = 0;
        foreach ($productos as $pro) {
            $importe = $pro->cantidad * $pro->valor;
            $imp = $imp + $importe;
        }

        $fact = Factura::find($factura);
        $fact->valor = $imp;
        $fact->update();
        
        $cuenta = Cuenta::find($fact->cuenta_id);
        
        $cuenta->valor = $cuenta->valor + $cambiar;
        $cuenta->update();

        

         return redirect()->route('compra.boleta', [$factura])
                         ->with(['message' => 'Se ha Eliminado una Prenda ', 'status' => 'danger']);
    }

}
