$(document).ready(function(){

	$("#add-prenda").click(function(){
		addPrenda();
	});

	$("#registerVenta").click(function(){
		factura();
		confirm('VENTA REGISTRADA CON EXITO');
		location.reload();
	});

});
var i = 1;
function addPrenda(){
	var prenda = $("#prenda").val();
		var cantidad = parseInt($("#cantidad").val());
		var precio = parseInt($("#precio").val());
		var importe = cantidad * precio;
		console.log(prenda+' '+cantidad+' '+precio+' '+importe);

		$("#tbody").append('<tr id="'+i+'"><td class="prenda">'+prenda+'</td><td class="cantidad">'+cantidad+'</td><td class="precio">'+precio+'</td><td class="val">'+importe+'</td><td><a href="#" onclick="eliminarPro('+i+')"" class="btn btn-danger btn-circle btn-sm mx-1" title="ELIMINAR PRENDA"><i class="fas fa-trash"></i></a></td></tr>')
		$("#prenda").val('');
		$("#cantidad").val(1);
		$("#precio").val('');
		i++;
		total();
};

function total(){
	var total = 0;
	$(".val").each(function(){
		total = parseFloat(parseFloat(total) + parseInt($(this).text()));
	});
	$("#total").text(total.toFixed(2));
	$("#total-factura").val(total);

};
function eliminarPro(id){
	$("#tbody #"+id).remove();
	total();
};

function factura(){
	if ($("#total-factura").val() != 0) {
		var form = $("#form-factura");
		var data = form.serialize();
		$.ajax({          
			url: 'registrar',
			type: 'POST',
			data : data,
			success: function(respon){
				prenda(respon.id);
				$("#tbody-factura").prepend('<tr><td>'+respon.created_at+'</td><td>'+respon.valor+'</td><td><a href="#" class="btn btn-info btn-circle btn-sm mx-1"><i class="fas fa-info-circle"></i></a></td>/tr>')			
			}
		});		
	}else{
		alert('No registro ninguna prenda');
	}	

};

function prenda(factura){
	$("#factura_id").val(factura);

	for (var e = 0; e < i; e++) {
		if ($("#tbody #"+e+" .prenda").text() != '') {
			$("#prenda-producto").val($("#tbody #"+e+" .prenda").text());
			$("#precio-producto").val($("#tbody #"+e+" .precio").text());
			$("#cantidad-producto").val($("#tbody #"+e+" .cantidad").text());
			var form = $("#form-producto");
			var data = form.serialize();
			dato = 			
			$.ajax({          
			    url: 'prenda',
			    type: 'POST',
			    data :data,
			});
		};
	}
};

function editPrenda(id,prenda,cantidad,precio){

	$("#producto").val(id);
	$("#prenda").val(prenda);
	$("#cantidad").val(cantidad);
	$("#precio").val(precio);
}

function deletePrenda(id){
	$("#e-producto").val(id);
}

