<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;
use App\Cuenta;

class ClientesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function new(){
    	return view('clientes.nuevo');
    }

    public function view($id){
    	$cliente = Cliente::find($id);
    	return view('clientes.view', ['cliente' => $cliente]);
    }

    public function create(Request $request){
    	
    		$persona = new Cliente;
            $validate = $this->validate($request, [
                'nombre' => ['required', 'string','max:255'],
                'apellido' => ['required', 'string','max:255'],
                'dni' => ['required', 'string','max:51', 'unique:clientes'],
                'email' => ['required', 'string', 'email','max:255', 'unique:clientes'],
            ],
            [
                'dni.unique' => 'Ya existe una Cliente con este N° de DNI',
                'email.unique' => 'Ya existe una Cliente con este Correo Electronico',
            ]);
            $persona->nombre = strtoupper($request->input('nombre'));
            $persona->apellido = strtoupper($request->input('apellido'));
            $persona->dni = $request->input('dni');
            $persona->email = $request->input('email');
            $persona->direccion = strtoupper($request->input('direccion'));
            $persona->telefono = $request->input('telefono');
            $persona->save();

            $cuenta = new Cuenta;
            $cuenta->cliente_id = $persona->id;
            $cuenta->valor = 0;
            $cuenta->estado = 'Activa';
            $cuenta->save();

            $id = $persona->id;
            return redirect()->route('client.new')
                         ->with(['message' => 'Cliente agregado con exito', 'status' => 'success']);
/*
    	$id = $request->input('id_cliente');
        

        if (empty($id)) {
            
        }    	
    	    	
    	$cargo = new Cargo;
        $cargo->legajo_id = $request->input('legajo');
    	$cargo->person_id = $id;
    	$cargo->cargo = strtoupper($request->input('cargo'));
    	$cargo->fecha_inicio = $request->input('fecha_inicio');
    	$cargo->fecha_fin = $request->input('fecha_fin');
        $cargo->estado = 'Activo';

    	$cargo->save();

    	return redirect()->route('view_leg', [$request->input('legajo')])
  */
    }
}
