window.addEventListener("load", function(){
	$("#compra").click(function(){
		var	cuenta = $("#cuenta").val();
		var url = 'http://localhost/sucuenta/public/compras/'+cuenta;
		$(location).attr('href',url);
	});
	$("#pago").click(function(){
		alert('pago');	
	});
	$("#editar").click(function(){
		alert('editar');	
	});
});