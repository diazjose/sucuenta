window.addEventListener("load", function(){
	$("#compra").click(function(){
		var	cuenta = $("#cuenta").val();
		var url = 'http://localhost/sucuenta/public/compras/'+cuenta;
		$(location).attr('href',url);
	});
	$("#pago").click(function(){
		var	cuenta = $("#cuenta").val();
		var url = 'http://localhost/sucuenta/public/pagos/'+cuenta;
		$(location).attr('href',url);
	});
	$("#editar").click(function(){
		var	cuenta = $("#cliente").val();
		var url = 'http://localhost/sucuenta/public/editar-cliente/'+cuenta;
		$(location).attr('href',url);	
	});
});