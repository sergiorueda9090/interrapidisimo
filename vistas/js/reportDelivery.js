$(document).on("click", ".btnShowReportDelivery", function(){

    let idUsuario = $(this).attr("idUsuario");
    
    let datos = new FormData();

    datos.append("idUsuario", idUsuario);
  
    $.ajax({
		url:"ajax/reportDelivery.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
            console.log("respuesta ",respuesta);
            if(respuesta && respuesta.length > 0) {
                // Si hay información en la respuesta
                let tabla = $("#infoTable");
                let total = 0;
                tabla.empty(); // Limpiamos la tabla antes de agregar nueva información
    
                respuesta.forEach(function(domicilio) {
                    console.log("domicilio ",domicilio.nombre)
                    let fila = "<tr>" +
                        "<td>" + domicilio.nombreCliente + "</td>" +
                        "<td>" + domicilio.cliente + "</td>" +
                        "<td>" + domicilio.nombre + "</td>" +
                        "<td>" + domicilio.newAddress + "</td>" +
                        "<td>" + domicilio.deliveryPraci + "</td>" +
                        "<td>" + domicilio.dateCrate + "</td>" +
                        "</tr>";
                    tabla.append(fila);
                    total += parseInt(domicilio.deliveryPraci);
                });

                // Agregar la fila de total
                let filaTotal = "<tr>" +
                                    "<td colspan='4' class='text-right'><strong>Total</strong></td>" +
                                    "<td class='total'>$" + total + "</td>" +
                                "</tr>";
                tabla.append(filaTotal);

                // Actualizar el total en el pie de la tabla
                $("#infoTable tfoot .total").text("$" + total);
            } else {
                // Si no hay información en la respuesta
                console.log("No se encontró información de domicilios.");
            }
		}
	});

    
});