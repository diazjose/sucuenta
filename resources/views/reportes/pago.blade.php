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
            <div class="">
                <div class="caja_inline-logo">
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
                <div class="caja_inline-recibo">
                    <div class="">
                        <h4 style="margin-left: 188px;margin-bottom: 0px; margin-top: 0px; "><strong>RECIBO DE PAGO</h4></strong>
                        <p style="margin-top: 1px;margin-left: 163px " class="p">Comprobante interno, No Valida como factura</p>
                    </div>
                </div>        
            </div>
        </header>
        <hr>
        <div class="container" style="margin-bottom: 10px; ">
        	<div class="caja_inline">
                <h4 style="margin-bottom: 0px;">DATOS DE CLIENTE</h4>
                <p style="margin-top: 12px; font-size: 14px;">
                    <strong>Nombre:</strong>
                    {{$pago->cuenta->cliente->apellido}} {{$pago->cuenta->cliente->nombre}}
                </p>
                <p style="margin-top: 12px; font-size: 14px;">
                    <strong>DNI:</strong>
                    {{$pago->cuenta->cliente->dni}}
                </p>
            </div>
            <div class="caja_inline">
                <h4 style="margin-bottom: 0px;">DATOS DE PAGO</h4>
                <p style="margin-top: 12px; font-size: 14px;">
                    <strong>Fecha:</strong>
                    {{$pago->created_at->format('d/m/Y')}}
                </p>
                <p style="margin-top: 12px; font-size: 14px;">
                    <strong>Forma de Pago:</strong>
                </p>
            </div>  
        </div>
        <hr><br>
        <table class="table text-center" id="dataTable" width="100%" cellspacing="0" style="margin-top: 0px; ">
            <thead> 
                <tr>
                    <th>DESCRIPCION</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Importe de Pago</td>
                    <td>$ {{ $pago->valor }}</td>
                </tr>
            </tbody>
        </table> 
        <br><hr>
	</body>
</html>