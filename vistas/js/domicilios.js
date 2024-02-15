var guardarPedido = [];
var arrayTotal = [];
var total;
var arrayItem = [];
var idDomiciliario;


/*function sumarTotalPrecios(){

  function sumarArrayPrecio(total, numero){
      return total + numero;
  }

  var sumaTotalPrecio = arrayTotal.reduce(sumarArrayPrecio);
      total = sumaTotalPrecio;
}*/

function sumarTotalPrecios(){

  var precioItem = $(".precioDomicilio");

  var arraySumaPrecio = []

  for(var i=0; i<arrayItem.length; i++){
      arraySumaPrecio.push(Number(arrayItem[i]['precioDomicilio']))
  }

  function sumarArrayPrecio(total,numero){
    return total + numero
  }

  var sumaTotalPrecio = arraySumaPrecio.reduce(sumarArrayPrecio)
  $("#totalDomicilio").html('$ <strong>'+sumaTotalPrecio+"</strong>");
}

$(document).on('click','.btnAgregarProducto',function(){

  idDomiciliario = $(this).attr("iditemmesero");
  var datos = new FormData();
  datos.append('idDomiciliarioRegistros',idDomiciliario);

  $.ajax({
        url: "ajax/domiciliosAjax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        //dataType:"json",
        success: function(respuesta){

        var respuestaJson = JSON.parse(respuesta)

        for(var i = 0; i < respuestaJson.length; i++){

          arrayItem.push({"telefonoCliente":respuestaJson[i]["telefono"],
                          "nombreCliente":respuestaJson[i]["nombre"],
                          "direccionCliente":respuestaJson[i]["direccion"],
                          "seleccionarPedidoDomi":respuestaJson[i]["zona"],
                          "seleccionarBarrio":respuestaJson[i]["barrio"],
                          "precioDomicilio":respuestaJson[i]["precioDomicilio"]})


          $("#tablaDomicilios").append('<tr>'+
                             '<td  class="nombreProducto">'+respuestaJson[i]["telefono"]+'</td>'+
                             '<td>'+respuestaJson[i]["nombre"]+'</td>'+
                             '<td>'+respuestaJson[i]["direccion"]+'</td>'+
                             '<td>'+respuestaJson[i]["direccionDestino"]+'</td>'+
                             '<td>'+respuestaJson[i]["zona"]+'</td>'+
                             '<td>'+respuestaJson[i]["barrio"]+'</td>'+
                             '<td class="precioDomicilio">'+respuestaJson[i]["precioDomicilio"]+'</td>'+
                             '<td>'+
                               '<div class="btn-group">'+
                                 '<button class="btn btn-danger btnEliminarItemDomicilio" attbtnEliminarItemDomicilio="'+respuestaJson[i]["id"]+'"><i class="fa fa-times"></i></button>'+
                                 '<button class="btn btn-primary btnPdfItemDomicilio" attbtnPdfItemDomicilio="'+respuestaJson[i]["id"]+'"><i class="fa fa-file-pdf-o"></i></button>'+
                               '</div>'+
                             '</td>'+
                           '</tr>');
                           idTotal = respuestaJson[i]["id"];
                           console.log("idTotal ",idTotal);
                           sumarTotalPrecios()
        }



      }
    })
})


//VALIDANDO DIRECCION Y PRECIO
$(document).on('change','.precioDomicilio',function(){

  if($(".direccionCliente").val() != "" && $(".precioDomicilio").val() != ""){
     $(".btnAgregarDomicilio").prop('disabled', false);
     var valor = $(".precioDomicilio").val();
     var procentaje = $(".PorcentajeDomicilio").val()
     var descuento = Number(valor)*(Number(procentaje)/100);
     var total = valor - descuento;
     $(".precioDomicilioOculto").val(total);
  }else{
    $(".btnAgregarDomicilio").prop('disabled', true);
  }

})

$(document).on('change','.direccionCliente',function(){

  if($(".direccionCliente").val() != "" && $(".precioDomicilio").val() != ""){
    $(".btnAgregarDomicilio").prop('disabled', false);
  }else{
    $(".btnAgregarDomicilio").prop('disabled', true);
  }

})

var idTotal;

$(document).on('click','.btnAgregarDomicilio',function(){

  var telefonoCliente = $(".telefonoCliente").val();
  var nombreCliente = $(".nombreClientes").val();
  var direccionCliente = $(".direccionCliente").val();
  var seleccionarPedidoDomi = $(".seleccionarPedidoDomi").val();
  var seleccionarBarrio = $(".seleccionarBarrio").val();
  var precioDomicilio = $(".precioDomicilio").val();
  var precioDomicilioOculto = $(".precioDomicilioOculto").val();
  var porcentajeDomicilio = $(".PorcentajeDomicilio").val();
  var direccionDestino = $(".direccionDestino").val();
  var selectFormaPago = $(".selectFormaPago").val();

  var datos = new FormData();
  datos.append('telefonoCliente',nombreCliente);
  datos.append('nombreCliente',telefonoCliente);
  datos.append('direccionCliente',direccionCliente);
  datos.append('seleccionarPedidoDomi',seleccionarPedidoDomi);
  datos.append("seleccionarBarrio",idDomiciliario);
  datos.append('precioDomicilio',seleccionarBarrio);
  datos.append('idDomiciliario',precioDomicilio);
  datos.append("precioDomicilioOculto",precioDomicilioOculto);
  datos.append("porcentajeDomicilio",porcentajeDomicilio);
  datos.append("direccionDestino",direccionDestino);
  datos.append("selectFormaPago",selectFormaPago);

  if(selectFormaPago == "" || selectFormaPago == 0){
    swal({
        type: "error",
        title: "¡El domicilio no ha sido agregado correctamente Seleccione la Forma de pago!",
        showConfirmButton: true,
        confirmButtonText: "Cerrar"
        })
        return;
  }


  if(precioDomicilioOculto == "" || precioDomicilioOculto == 0){
    swal({
        type: "error",
        title: "¡El domicilio no ha sido agregado correctamente!",
        showConfirmButton: true,
        confirmButtonText: "Cerrar"
        })
        setTimeout(() => {
          window.location = "asignarDomicilio";
        },1000);
        return;
  }

  $.ajax({
        url: "ajax/domiciliosAjax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta){
        console.log("respuesta ",respuesta);
      }
    })
    console.log("idTotal ",idTotal);
    idTotal++;
  $("#tablaDomicilios").append('<tr>'+
                     '<td  class="nombreProducto">'+telefonoCliente+'</td>'+
                     '<td>'+nombreCliente+'</td>'+
                     '<td>'+direccionCliente+'</td>'+
                     '<td>'+direccionDestino+'</td>'+
                     '<td>'+seleccionarPedidoDomi+'</td>'+
                     '<td>'+seleccionarBarrio+'</td>'+
                     '<td class="precioDomicilio">'+precioDomicilio+'</td>'+
                     '<td>'+
                       '<div class="btn-group">'+
                         '<button class="btn btn-danger btnEliminarItemDomicilio" attbtnEliminarItemDomicilio="'+Number(idTotal)+'"><i class="fa fa-times"></i></button>'+
                         '<button class="btn btn-primary btnPdfItemDomicilio" attbtnPdfItemDomicilio="'+Number(idTotal)+'" disabled"><i class="fa fa-file-pdf-o"></i></button>'+
                       '</div>'+
                     '</td>'+
                   '</tr>');

                   arrayItem.push({"telefonoCliente":telefonoCliente,nombreCliente,"direccionCliente":direccionCliente,
                                   "seleccionarPedidoDomi":seleccionarPedidoDomi,"seleccionarBarrio":seleccionarBarrio,"precioDomicilio":precioDomicilio})
                   //arrayTotal.push(Number(guardarPedido[i]["precio"])*Number(guardarPedido[i]["cantidad"]));
                   $(".btnAgregarDomicilio").prop('disabled', true);
                   console.log("arrayItem ",arrayItem);


                sumarTotalPrecios();
                 $(".telefonoCliente").val("");
                 $(".nombreClientes").val("");
                 $(".direccionCliente").val("");
                 $(".seleccionarPedidoDomi").val("0");
                 $(".seleccionarBarrio").val("0");
                 $(".precioDomicilio").val("0");
                 $(".direccionDestino").val("");
                 $(".selectFormaPago").val("0");
                 $(".PorcentajeDomicilio").val("30");
                 $(".precioDomicilioOculto").val("");
                 console.log("idTotal ",idTotal);
  //var itemAttr = $(this).attr('seleccionarPedidoDomi');
  //var nombreDelProducto = $('.seleccionarPedidoDomi'+itemAttr).val();

  //var datos = new FormData();

  //datos.append('idProducto',nombreDelProducto);

  /*$.ajax({
        url: "ajax/agregarMesa.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType:'json',
        success: function(respuesta){

          var idProd = respuesta["id"];
          var nombreProd = respuesta["descripcion"];
          var imgProd = respuesta["imagen"];
          var precioProd = respuesta["precio_venta"];

          guardarPedido.push({"nombre":nombreProd,"precio":precioProd,"cantidad":1,"id":idProd,"img":imgProd});

          $("#tablaDomicilios").html('');

          arrayItem = [];
          arrayTotal = [];

          for(var i=0; i < guardarPedido.length; i++){

            $("#tablaDomicilios").append('<tr>'+
                               '<td  class="nombreProducto'+i+'">'+guardarPedido[i]["nombre"]+'</td>'+
                               '<td>'+
                                     '<img class="img-circle" width="40px"src="'+guardarPedido[i]["img"]+'">'+
                               '</td>'+
                               '<td class="precioProducto'+i+'">'+Number(guardarPedido[i]["precio"])*Number(guardarPedido[i]["cantidad"])+'</td>'+
                               '<td>'+
                                   '<input class="cambiarCantidadDomicilio cambiarCantidadDomicilio'+i+'" cambiarCantidad='+i+' precio='+guardarPedido[i]["precio"]+' type="number" value="'+guardarPedido[i]["cantidad"]+'" style="width:70px;">'+
                                   '<input class="precioProductoOculto precioProductoOculto'+i+'"  type="hidden"  value="'+guardarPedido[i]["precio"]+'" style="width:70px;">'+
                                   '<input class="idProductoOculto idProductoOculto'+i+'"  type="hidden"  value="'+guardarPedido[i]["id"]+'" style="width:70px;">'+
                                   '<input class="imgProductoOculto imgProductoOculto'+i+'"  type="hidden"  value="'+guardarPedido[i]["img"]+'" style="width:70px;">'+
                               '</td>'+
                               '<td>'+
                                 '<div class="btn-group">'+
                                   '<button class="btn btn-danger btnEliminarItemDomicilio" attbtnEliminarItemDomicilio="'+i+'"><i class="fa fa-times"></i></button>'+
                                 '</div>'+
                               '</td>'+
                             '</tr>');

                             arrayItem.push(i);
                             arrayTotal.push(Number(guardarPedido[i]["precio"])*Number(guardarPedido[i]["cantidad"]));

                     }

                    $('.seleccionarPedidoDomi'+itemAttr).val("0");
                    sumarTotalPrecios();
                    $("#totalDomicilio").html('$ '+total);
      }
  })
*/
})


/*=============================================
ELIMINAR USUARIO
=============================================*/
$(document).on("click", ".btnEliminarItemDomicilio", function(){

  var idDomicilio = $(this).attr("attbtneliminaritemdomicilio");

  swal({
    title: '¿Está seguro de borrar el domicilio?',
    text: "¡Si no lo está puede cancelar la accíón!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, borrar Domicilio!'
  }).then(function(result){

    if(result.value){

      window.location = "index.php?ruta=asignarDomicilio&idDomicilio="+idDomicilio;

    }

  })

})


$(document).on('change','.cambiarCantidadDomicilio',function(){

   guardarPedido = [];
   arrayTotal = [];

   var contarClases = $('.cambiarCantidadDomicilio');
   var cantidad = $(this).attr('cambiarCantidad');
   var precio = $(this).attr('precio');
   var cantidadUnidades = $(".cambiarCantidadDomicilio"+cantidad).val();

   $(".precioProducto"+cantidad).html((cantidadUnidades*precio));

   for(var i = 0; i < contarClases.length; i++){
     var cambioCantidad = $(".cambiarCantidadDomicilio"+[i]).val();
     var cambioPrecio = $(".precioProducto"+[i]).html();
     var cambioNombre = $(".nombreProducto"+[i]).html();
     var precioOculto = $(".precioProductoOculto"+[i]).val();
     var idProductoOculto = $(".idProductoOculto"+[i]).val();
     var imgProductoOculto = $(".imgProductoOculto"+[i]).val();;
     guardarPedido.push({"nombre":cambioNombre,"precio":Number(precioOculto),"cantidad":cambioCantidad,"id":idProductoOculto,"img":imgProductoOculto});
     arrayTotal.push(Number(cambioPrecio));
     sumarTotalPrecios();
     $("#totalDomicilio").html('$ '+total);
   }
})

/*ELIMINAR PRODUCTO DEL PEDIDO*/
$(document).on('click','.btnEliminarItemDomicilio',function(){

var totalC = $(this).attr('attBtnEliminarItemDomicilio');

var itemValor2 = arrayItem.indexOf(Number(totalC));

if(itemValor2 > -1){
   guardarPedido.splice(itemValor2,1);
   arrayItem.splice(itemValor2,1);
   arrayTotal.splice(itemValor2,1);
}

var numero = 0;
  if(arrayTotal.length == 0){
    arrayTotal.push(Number(numero));
  }

$("#tablaDomicilios").html('');
arrayItem = [];
for(var i=0; i < guardarPedido.length; i++){
  $("#tablaDomicilios").append('<tr>'+
                     '<td  class="nombreProducto'+i+'">'+guardarPedido[i]["nombre"]+'</td>'+
                     '<td>'+
                           '<img class="img-circle" width="40px"src="'+guardarPedido[i]["img"]+'">'+
                     '</td>'+
                     '<td class="precioProducto'+i+'">'+Number(guardarPedido[i]["precio"])*Number(guardarPedido[i]["cantidad"])+'</td>'+
                     '<td>'+
                         '<input class="cambiarCantidadDomicilio cambiarCantidadDomicilio'+i+'" cambiarCantidad='+i+' precio='+guardarPedido[i]["precio"]+' type="number" value="'+guardarPedido[i]["cantidad"]+'" style="width:70px;">'+
                         '<input class="precioProductoOculto precioProductoOculto'+i+'"  type="hidden"  value="'+guardarPedido[i]["precio"]+'" style="width:70px;">'+
                         '<input class="idProductoOculto idProductoOculto'+i+'"  type="hidden"  value="'+guardarPedido[i]["id"]+'" style="width:70px;">'+
                         '<input class="imgProductoOculto imgProductoOculto'+i+'"  type="hidden"  value="'+guardarPedido[i]["img"]+'" style="width:70px;">'+
                     '</td>'+
                     '<td>'+
                       '<div class="btn-group">'+
                         '<button class="btn btn-danger btnEliminarItemDomicilio" attbtnEliminarItemDomicilio="'+i+'"><i class="fa fa-times"></i></button>'+
                         '<button class="btn btn-warn btnEliminarItemDomicilio" attbtnCancelarItemDomicilio="'+i+'"><i class="fa fa-ban"></i></button>'+
                       '</div>'+
                     '</td>'+
                   '</tr>');
                   arrayItem.push(i);
}
  $(this).parent().parent().parent().remove();
  sumarTotalPrecios();
  $("#totalDomicilio").html('$ '+total);

})

/*IMPRIMIR PDF*/
$(document).on('click','.btnPdfItemDomicilio',function(){
  var id = $(this).attr('attbtnpdfitemdomicilio');
  window.open('extensiones/TCPDF-master/pdf/facturaDomicilio.php?idDomicilio='+id,"_blank");
})

/*PLUGIN SELECT2*/
$(".select2").select2();
$(document).on('change','#inputPais',function(){
  //$(".select2-selection__rendered").html($(this).val().split(",")[1])
  console.log($(".select2-selection__rendered").html());

  var nombreCliente = $(".select2-selection__rendered").html();
  var datos = new FormData();

  datos.append('telefonoClienteBuscar',nombreCliente);

  $.ajax({
        url: "ajax/domiciliosAjax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType:"json",
        success: function(respuesta){
          console.log("respuesta ",respuesta);
          if(respuesta == false){
          }else{
            $(".nombreClientes").val(respuesta[0]["nombre"]);
            $(".direccionCliente").val(respuesta[0]["direccion"]);
            $(".telefonoCliente").val(respuesta[0]["telefono"])
          }

        }
      })

})

/*GUARDAR EL DOMINICILIO*/
$(document).on('click','.guardarDomicilio',function(){
window.location = "asignarDomicilio";
/*var telefonoCliente = $(".telefonoCliente").val();
var nombreCliente = $(".nombreCliente").val();
var direccionCliente = $(".direccionCliente").val();
var usuarioCliente = $(".usuarioCliente").val();*/

/*var datos = new FormData();
datos.append('telefonoCliente',telefonoCliente);
datos.append('nombreCliente',nombreCliente);
datos.append('direccionCliente',direccionCliente);
datos.append('usuarioCliente',usuarioCliente);
datos.append('total',total);
datos.append('domicilio',JSON.stringify(guardarPedido));*/

/*$.ajax({
      url: "ajax/domiciliosAjax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      //dataType:"json",
      success: function(respuesta){
      console.log("respuesta ",respuesta);
    }
  })*/
})

$('.tablaDomicilios').DataTable( {
    "deferRender": true,
    "retrieve": true,
    "processing": true,
     "language": {

			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
			"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
			"sFirst":    "Primero",
			"sLast":     "Último",
			"sNext":     "Siguiente",
			"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}

	}

} );

/*cambiar el estado del domicilio*/
$(document).on('click','.estadoDomicilio',function(){

  var idDomicilio = $(this).attr('idDomicilio');

  var datos = new FormData();
  datos.append('idDomicilio',idDomicilio);

  $.ajax({
        url: "ajax/domiciliosAjax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        //dataType:"json",
        success: function(respuesta){

          if(respuesta == "ok"){
            swal({
                type: "success",
                title: "El pedido ha sido enviado",
                showConfirmButton: true,
                confirmButtonText: "Cerrar"
                }).then(function(result){
                    if (result.value) {

                    window.location = "domicilio";

                    }
                  })
          }else{
            swal({
  						  type: "error",
  						  title: "¡El pedido no ha sido enviado correctamente!",
  						  showConfirmButton: true,
  						  confirmButtonText: "Cerrar"
  						  }).then(function(result){
  							if (result.value) {
  							window.location = "domicilio";
  							}
  						})
          }
      }
    })
})

/*SELECCIONAR PEDIDO PARA EDITAR*/
$(document).on('click','.btnEditarDomicilio',function(){
   $(".guardarDomicilio").hide();
   $(".editarDomicilio").show();
  var idEditarDomicilio = $(this).attr("idEditarDomicilio");
  var datos = new FormData();
  datos.append('idEditarDomicilio',idEditarDomicilio);

  $.ajax({
        url: "ajax/domiciliosAjax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType:"json",
        success: function(respuesta){

          $(".idPedido").val(respuesta["id"]);
          $(".telefonoCliente").val(respuesta["telefono"]);
          $(".nombreCliente").val(respuesta["nombre"]);
          $(".direccionCliente").val(respuesta["direccion"]);
          $(".usuarioCliente").val(respuesta["idUsuario"]);

          guardarPedido = JSON.parse(respuesta["orden"]);

          for(var i = 0; i < JSON.parse(respuesta["orden"]).length; i++){

    $("#tablaDomicilios").append('<tr>'+
                               '<td  class="nombreProducto'+i+'">'+guardarPedido[i]["nombre"]+'</td>'+
                               '<td>'+
                                     '<img class="img-circle" width="40px"src="'+guardarPedido[i]["img"]+'">'+
                               '</td>'+
                               '<td class="precioProducto'+i+'">'+Number(guardarPedido[i]["precio"])*Number(guardarPedido[i]["cantidad"])+'</td>'+
                               '<td>'+
                                   '<input class="cambiarCantidadDomicilio cambiarCantidadDomicilio'+i+'" cambiarCantidad='+i+' precio='+guardarPedido[i]["precio"]+' type="number" value="'+guardarPedido[i]["cantidad"]+'" style="width:70px;">'+
                                   '<input class="precioProductoOculto precioProductoOculto'+i+'"  type="hidden"  value="'+guardarPedido[i]["precio"]+'" style="width:70px;">'+
                                   '<input class="idProductoOculto idProductoOculto'+i+'"  type="hidden"  value="'+guardarPedido[i]["id"]+'" style="width:70px;">'+
                                   '<input class="imgProductoOculto imgProductoOculto'+i+'"  type="hidden"  value="'+guardarPedido[i]["img"]+'" style="width:70px;">'+
                               '</td>'+
                               '<td>'+
                                 '<div class="btn-group">'+
                                   '<button class="btn btn-danger btnEliminarItemDomicilio" attbtnEliminarItemDomicilio="'+i+'"><i class="fa fa-times"></i></button>'+
                                 '</div>'+
                               '</td>'+
                             '</tr>');
                             arrayItem.push(i);
                             arrayTotal.push(Number(guardarPedido[i]["cantidad"])*Number(guardarPedido[i]["precio"]));
          }
            sumarTotalPrecios();
            $("#totalDomicilio").html('$ '+respuesta["total"]);

      }
    })

})


/*BORRAR TODO EL CONTENIDO DEL ARRAY AL CERRAR LA VENTANA*/
$(document).on('click','.cerrarModalDomicilioX',function(){
  $(".guardarDomicilio").show();
  $(".editarDomicilio").hide();
  $("#tablaDomicilios").html('');
  $(".telefonoCliente").val("");
  $(".nombreCliente").val("");
  $(".direccionCliente").val("");
  $(".usuarioCliente").val("");
  $("#totalDomicilio").html('');
  guardarPedido = [];
  arrayTotal = [];
  arrayItem = [];
});

$(document).on('click','.cerrarModalDomicilio',function(){
  $(".guardarDomicilio").show();
  $(".editarDomicilio").hide();
  $("#tablaDomicilios").html('');
  $(".telefonoCliente").val("");
  $(".nombreCliente").val("");
  $(".direccionCliente").val("");
  $(".usuarioCliente").val("");
  $("#totalDomicilio").html('');
  guardarPedido = [];
  arrayTotal = [];
  arrayItem = [];
});

/*ACTUALIZAR DOMICILIO*/
$(document).on('click','.editarDomicilio',function(){

  var idEditardomicilio = $(".idPedido").val();
  var telefonoCliente = $(".telefonoCliente").val();
  var nombreCliente = $(".nombreCliente").val();
  var direccionCliente = $(".direccionCliente").val();
  var usuarioCliente = $(".usuarioCliente").val();

  var datos = new FormData();
  datos.append('idEditardomicilio',idEditardomicilio);
  datos.append('telefonoClienteEditar',telefonoCliente);
  datos.append('nombreClienteEditar',nombreCliente);
  datos.append('direccionClienteEditar',direccionCliente);
  datos.append('usuarioClienteEditar',usuarioCliente);
  datos.append('totalEditar',total);
  datos.append('domicilioEditar',JSON.stringify(guardarPedido));

  $.ajax({
        url: "ajax/domiciliosAjax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        //dataType:"json",
        success: function(respuesta){

          if(respuesta == "ok"){
            swal({
                type: "success",
                title: "El domicilio ha sido actualizado correctamente",
                showConfirmButton: true,
                confirmButtonText: "Cerrar"
                }).then(function(result){
                    if (result.value) {

                    window.location = "domicilio";

                    }
                  })
          }else{
            swal({
                type: "error",
                title: "¡El domicilio no ha sido actualizado correctamente!",
                showConfirmButton: true,
                confirmButtonText: "Cerrar"
                }).then(function(result){
                if (result.value) {
                window.location = "domicilio";
                }
              })
          }

      }
    })


})

/*BUSCAR INFORMACION POR EL TELEFONO*/
$(document).on('change','.telefonoCliente',function(){

  var telefonoClienteBuscar = $(".telefonoCliente").val();
  var datos = new FormData();

  datos.append('telefonoClienteBuscar',telefonoClienteBuscar);

  $.ajax({
        url: "ajax/domiciliosAjax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType:"json",
        success: function(respuesta){
          if(respuesta == false){
          }else{
            $(".nombreClientes").val(respuesta[0]["nombre"]);
            $(".direccionCliente").val(respuesta[0]["direccion"]);
          }

        }
      })

})

/*ELIMINAR DOMICILIO*/
$(document).on('click','.btnEliminarDomicilio',function(){

  var idEliminarDomicilio = $(this).attr('IdEliminarDomicilio');
   console.log("IdEliminarDomicilio ",idEliminarDomicilio);
   swal({
    title: '¿Está seguro de borrar el domicilio?',
    text: "¡Si no lo está puede cancelar la acción!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Si, borrar el domicilio!'
   }).then(function(result){
    if(result.value){
      window.location = "index.php?ruta=domicilio&idEliminarDomicilio="+idEliminarDomicilio;
    }
   })

})

/*IMPRIMIR FACTURA*/
$(document).on('click','.imprimirFactura',function(){

  var idImprimir = $(this).attr("idU");
  console.log("idImprimir ",idImprimir);

  /*IMPRIMIR FACTURA*/

    //var idImprimirFactura = $(this).attr('idImprimirFactura');
    //idMesero = $(this).attr('idItemMesero');
    //idMesa = $(this).attr('idItemMesa');

    swal({
     title: '¿Está seguro de realizar el pago?',
     text: "¡Si no lo está puede cancelar la acción!",
     type: 'warning',
     showCancelButton: true,
     confirmButtonColor: '#3085d6',
     cancelButtonColor: '#d33',
     cancelButtonText: 'Cancelar',
     confirmButtonText: 'Si, realizar pago!'
    }).then(function(result){

     if(result.value){
       window.open('extensiones/TCPDF-master/pdf/factura.php?codigo='+idImprimir);
     setTimeout(()=>{
       window.location = "asignarDomicilio";
     },800)

     }
    })


})
