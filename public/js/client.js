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
		alert('editar');	
	});
});