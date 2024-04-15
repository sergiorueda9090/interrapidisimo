$(document).on("click", ".btnShowReportDelivery", function(){

    let idUsuario = $(this).attr("idUsuario");
    
    let datos = new FormData();

    datos.append("idUsuario", idUsuario);
  
    $.ajax({
        url: "ajax/reportDelivery.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log("respuesta ", respuesta);
            if (respuesta && respuesta.length > 0) {
                // Si hay información en la respuesta
                let tabla = $("#infoTable");
                let total = 0;
                tabla.empty(); // Limpiamos la tabla antes de agregar nueva información
    
                respuesta.forEach(function (domicilio) {
                    console.log("domicilio ", domicilio.nombre)
                    let fila = "<tr>" +
                        "<td>" + domicilio.nombreCliente + "</td>" +
                        "<td>" + domicilio.cliente + "</td>" +
                        "<td>" + domicilio.nombre + "</td>" +
                        "<td>" + domicilio.newAddress + "</td>" +
                        "<td>" + domicilio.deliveryPraci + "</td>" +
                        // Corregido para mostrar la fecha
                        "</tr>";
                    tabla.append(fila);
                    var valor = parseFloat(domicilio.deliveryPraci);
                    var valorFormateado = valor.toLocaleString('en-US', { style: 'currency', currency: 'USD' });
                    total += valor;
                    
                    // Reemplazar el valor sin formato con el valor formateado en la tabla
                    tabla.find('td:last').text(valorFormateado);
                });
                // Agregar la fila de total
                let filaTotal = "<tr>" +
                    "<td colspan='4' class='text-right'><strong>Total</strong></td>" +
                    "<td class='total'>" + total.toLocaleString('en-US', { style: 'currency', currency: 'USD' }) + "</td>" + // Formatear el total como dólar
                    "</tr>";
                tabla.append(filaTotal);
    
                // Actualizar el total en el pie de la tabla
                $("#infoTable tfoot .total").text("$" + total.toLocaleString('en-US', { style: 'currency', currency: 'USD' }));
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

document.getElementById("btnDescargarExcel").addEventListener("click", function() {
    // Obtener los valores de los parámetros
    let fechaInicio = $(".fechaInicio").val();
    let fechaFin = $(".fechaFin").val();
    let mensajero = $(".mensajero").val();
    let cliente = $(".cliente").val();

    // Construir la URL base para el archivo PHP
    let baseUrl = "vistas/modulos/reportes/descargar-reporte.php";

    // Verificar y agregar los parámetros GET necesarios
    let url = baseUrl;
    if (fechaInicio !== '') {
        url += "?fechaInicio=" + encodeURIComponent(fechaInicio);
    }
    if (fechaFin !== '') {
        url += (url.includes("?") ? "&" : "?") + "fechaFin=" + encodeURIComponent(fechaFin);
    }
    if (mensajero !== '') {
        url += (url.includes("?") ? "&" : "?") + "mensajero=" + encodeURIComponent(mensajero);
    }
    if (cliente !== '') {
        url += (url.includes("?") ? "&" : "?") + "cliente=" + encodeURIComponent(cliente);
    }

    // Ejecutar la URL
    window.location.href = url;
});
