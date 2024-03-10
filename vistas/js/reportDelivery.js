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


$(document).on('click','.filterReport',function(){
    
    console.log("CALL THIS");

    let fechaInicio  = $(".fechaInicio").val();
    let fechaFin     = $(".fechaFin").val();
    let mensajero    = $(".mensajero").val();
    let cliente      = $(".cliente").val();

    
    let datos = new FormData();

    if (fechaInicio !== '') {
        datos.append("fechaInicio", fechaInicio);
    }
    if (fechaFin !== '') {
        datos.append("fechaFin", fechaFin);
    }
    if (mensajero !== '') {
        datos.append("mensajero", mensajero);
    }
    if (cliente !== '') {
        datos.append("cliente", cliente);
    }
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
            let tabla = $("#tableMain");
            tabla.empty();
            if(respuesta && respuesta.length > 0) {
                let numerico = 1;
                respuesta.forEach(function(filtro) {
                    let fila = "<tr>" +
                        "<td>" + (numerico++) + "</td>" +
                        "<td>" + filtro.nombre + "</td>" +
                        "<td>" + filtro.nombreCliente + "</td>" +
                        "<td>" + filtro.cliente + "</td>" +
                        "<td>" + filtro.type + "</td>" +
                        "<td>" + filtro.selectPayMethod + "</td>" +
                        "<td>" + filtro.paymentProcess + "</td>" +
                        "<td>" + filtro.note + "</td>" +
                        "<td>" + filtro.deliveryPraci + "</td>" +
                        "<td>" + filtro.dateCrate + "</td>" +
                        "<td><div class='btn-group'>" + 
                        "<button class='btn btn-warning btnShowReportDelivery' idUsuario='" + filtro.idUsuario + "' data-toggle='modal' data-target='#exampleModal'><i class='fa fa-eye'></i></button>" +
                        "</div></td>" +
                        "</tr>";
                    tabla.append(fila);
                });
                numerico = 1;
            } else {
                // Si no hay información en la respuesta, agregar una fila indicando que no se encontró información
                let filaVacia = "<tr><td colspan='11'>No se encontró información en el filtro.</td></tr>";
                tabla.append(filaVacia);
            }
		}
	});

})


$(document).on('click', '.downloadPageExcel', function() {
    window.location.href = 'reportes/export_excel.php';
});