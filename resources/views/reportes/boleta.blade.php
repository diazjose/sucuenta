<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1">

	    	
		<link href="{{public_path('css/pdf.css') }}" rel="stylesheet" type="text/css" />
		
		<title>Documento</title>
	</head>
	
	<body>
		<header>
            <div>
                <div style="float:left;width: 30%;"></div>
                <div style="float:left;width: 40%;">
                    <div class="text-center">
                        <div id="title-header">
                            <span><strong>RANEL</strong></span>
                        </div>
                        <div id="sub">
                            <p class="p"><span>Base Melchor n° 3240 Barrio Antartida I, La Rioja, Argentina</span></p>
                            <p class="p">Telefono: 3804-777835 - Email: ranel@gmail.com</p>
                            <p class="p">Facebook : RANEL</p>  
                        </div>
                    </div>    
                </div>  
                <div id="factura">
                    <h5 style="margin-left: 40px;margin-bottom: 0px; "><strong>COMPRA N° 00111000111</h5></strong>
                    <p style="margin-top: 1px;margin-left: 10px " class="p">Comprobante interno, No Valida como factura</p>
                </div>  
            </div>
        </header>
        
        <br><hr>
        <div class="container" style="margin-bottom: 10px; ">
        	<div class="caja_inline">
                <h4 style="margin-bottom: 0px;">DATOS DE CLIENTE</h4>
                <p style="margin-top: 12px; font-size: 14px;">
                    <strong>Nombre:</strong>
                    {{$factura->cuenta->cliente->apellido}} {{$factura->cuenta->cliente->nombre}}
                </p>
                <p style="margin-top: 12px; font-size: 14px;">
                    <strong>DNI:</strong>
                    {{$factura->cuenta->cliente->dni}}
                </p>
            </div>
            <div class="caja_inline">
                <h4 style="margin-bottom: 0px;">DATOS DE COMPRA</h4>
                <p style="margin-top: 12px; font-size: 14px;">
                    <strong>Fecha:</strong>
                    {{$factura->created_at->format('d/m/Y')}}
                </p>
                <p style="margin-top: 12px; font-size: 14px;">
                    <strong>Cantidad de Prendas:</strong>
                    @php($cant = 0)
                    @foreach($factura->productos as $producto)
                    @php($cant = $cant + $producto->cantidad)
                    @endforeach
                    {{$cant}}
                </p>
            </div>  
        </div>
        <hr><br>
        <table class="table text-center" id="dataTable" width="100%" cellspacing="0" style="margin-top: 0px; ">
            <thead> 
                <tr>
                    <th>Cantidad</th>
                    <th>Descripcion</th>
                    <th>Precio Uni.</th>
                    <th>Importe</th>
                </tr>
            </thead>
            <tbody>
                @foreach($factura->productos as $producto)
                <tr>
                    <td>{{$producto->cantidad}}</td>
                    <td>{{$producto->denominacion}}</td>
                    <td>{{$producto->valor}}</td>
                    @php($importe = $producto->valor*$producto->cantidad)
                    <td>{{ $importe }}</td>
                </tr>
                @endforeach
            </tbody>
                <tr class="border-none">
                    <td></td>
                    <td></td>
                    <th>Total: </th>
                    <th>{{$factura->valor}}</th>
                </tr> 
        </table>  
        <footer>
            <p>Comprobante interno, No Valida como factura</p>
        </footer>
	</body>
</html>