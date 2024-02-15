$(document).on('click','.agregarMesa',function(){
  //$(".row").append('<div class="col-sm-4 col-12">hola<div>');
})

  var valid = false;
  $('#checkReserva').on('change',function(){
      if (this.checked) {
       $(".reservaC").show();
       $(".nombreCliente").prop('required', true);
       $(".numeroCliente").prop('required', true);
       $(".fechaReserva").prop('required', true);
      } else {
       $(".reservaC").hide();
       $(".nombreCliente").prop('required', false);
       $(".numeroCliente").prop('required', false);
       $(".fechaReserva").prop('required', false);
      }
    })

var guardarPedido = [];
var arrayTotal = [];
var total;
var arrayItem = [];
//SUMA TOTAL PRECIOS
function sumarTotalPrecios(){

  function sumarArrayPrecio(total, numero){
      return total + numero;
  }

  var sumaTotalPrecio = arrayTotal.reduce(sumarArrayPrecio);
      total = sumaTotalPrecio;
}

function limpiarSelec(){
  $("#seleccionarCarta").val('0');
}

var idMesero;
var idMesa;
var idItemEstado;

//capturo id del mesero y de la mesa
$(document).on('click','.btnAgregarProductos',function(){

   $("#tablaPedidos").html('');
   idMesero = $(this).attr('idItemMesero');
   idMesa = $(this).attr('idItemMesa');
   idItemEstado = $(this).attr('idItemEstado');

   var datos = new FormData();
   datos.append('idMeseroMostrar',idMesero);
   datos.append('idMesaMostrar',idMesa);
   datos.append('idItemEstado',idItemEstado);

   $.ajax({
           url: "ajax/agregarMesa.ajax.php",
           method: "POST",
           data: datos,
           cache: false,
           contentType: false,
           processData: false,
           dataType:'json',
           success: function(respuesta){

           var cantidadOrden = JSON.parse(respuesta[0]);

           for(var i =0 ; i < cantidadOrden.length; i++){

             $("#tablaPedidos").append('<tr>'+
                                '<td  class="nombreProducto'+i+'">'+cantidadOrden[i]["nombre"]+'</td>'+
                                '<td>'+
                                      '<img class="img-circle" width="40px"src="'+cantidadOrden[i]["img"]+'">'+
                                '</td>'+
                                '<td class="precioProducto'+i+'">'+Number(cantidadOrden[i]["precio"])*Number(cantidadOrden[i]["cantidad"])+'</td>'+
                                '<td>'+
                                    '<input class="cambiarCantidad cambiarCantidad'+i+'" cambiarCantidad='+i+' precio='+cantidadOrden[i]["precio"]+' type="number" value="'+cantidadOrden[i]["cantidad"]+'" style="width:70px;">'+
                                    '<input class="precioProductoOculto precioProductoOculto'+i+'"  type="hidden"  value="'+cantidadOrden[i]["precio"]+'" style="width:70px;">'+
                                    '<input class="idProductoOculto idProductoOculto'+i+'"  type="hidden"  value="'+cantidadOrden[i]["id"]+'" style="width:70px;">'+
                                    '<input class="imgProductoOculto imgProductoOculto'+i+'"  type="hidden"  value="'+cantidadOrden[i]["img"]+'" style="width:70px;">'+
                                '<td>'+
                                  '<div class="btn-group">'+
                                    '<button class="btn btn-danger btnEliminarItem" attBtnEliminarItem="'+i+'"><i class="fa fa-times"></i></button>'+
                                  '</div>'+
                                '</td>'+
                              '</tr>');

            guardarPedido.push({"nombre":cantidadOrden[i]["nombre"],"precio":cantidadOrden[i]["precio"],"cantidad":cantidadOrden[i]["cantidad"],"id":cantidadOrden[i]["id"],"img":cantidadOrden[i]["img"]});
            arrayTotal.push(Number(cantidadOrden[i]["precio"])*Number(cantidadOrden[i]["cantidad"]));
            arrayItem.push(i);
           }
           //sumarTotalPrecios();
           $("#totalPedido").html('$ '+total);

        }
   })

})

$(document).on('change','.seleccionarCarta',function(){

  var itemAttr = $(this).attr('seleccionarCarta');
  var nombreDelProducto = $('.seleccionarCarta'+itemAttr).val();

  var datos = new FormData();
  datos.append('idProducto',nombreDelProducto);

  $.ajax({
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

          $("#tablaPedidos").html('');

          arrayItem = [];
          arrayTotal = [];

          for(var i=0; i < guardarPedido.length; i++){

            $("#tablaPedidos").append('<tr>'+
                               '<td  class="nombreProducto'+i+'">'+guardarPedido[i]["nombre"]+'</td>'+
                               '<td>'+
                                     '<img class="img-circle" width="40px"src="'+guardarPedido[i]["img"]+'">'+
                               '</td>'+
                               '<td class="precioProducto'+i+'">'+Number(guardarPedido[i]["precio"])*Number(guardarPedido[i]["cantidad"])+'</td>'+
                               '<td>'+
                                   '<input class="cambiarCantidad cambiarCantidad'+i+'" cambiarCantidad='+i+' precio='+guardarPedido[i]["precio"]+' type="number" value="'+guardarPedido[i]["cantidad"]+'" style="width:70px;">'+
                                   '<input class="precioProductoOculto precioProductoOculto'+i+'"  type="hidden"  value="'+guardarPedido[i]["precio"]+'" style="width:70px;">'+
                                   '<input class="idProductoOculto idProductoOculto'+i+'"  type="hidden"  value="'+guardarPedido[i]["id"]+'" style="width:70px;">'+
                                   '<input class="imgProductoOculto imgProductoOculto'+i+'"  type="hidden"  value="'+guardarPedido[i]["img"]+'" style="width:70px;">'+
                               '</td>'+
                               '<td>'+
                                 '<div class="btn-group">'+
                                   '<button class="btn btn-danger btnEliminarItem" attBtnEliminarItem="'+i+'"><i class="fa fa-times"></i></button>'+
                                 '</div>'+
                               '</td>'+
                             '</tr>');
                             arrayItem.push(i);
                             arrayTotal.push(Number(guardarPedido[i]["precio"]));
          }

                    $('.seleccionarCarta'+itemAttr).val("0");
                    sumarTotalPrecios();
                    $("#totalPedido").html('$ '+total);
      }
  })

})


$(document).on('change','.cambiarCantidad',function(){

   guardarPedido = [];
   arrayTotal = [];

   var contarClases = $('.cambiarCantidad');
   var cantidad = $(this).attr('cambiarCantidad');
   var precio = $(this).attr('precio');
   var cantidadUnidades = $(".cambiarCantidad"+cantidad).val();

   $(".precioProducto"+cantidad).html((cantidadUnidades*precio));

   for(var i = 0; i < contarClases.length; i++){
     var cambioCantidad = $(".cambiarCantidad"+[i]).val();
     var cambioPrecio = $(".precioProducto"+[i]).html();
     var cambioNombre = $(".nombreProducto"+[i]).html();
     var precioOculto = $(".precioProductoOculto"+[i]).val();
     var idProductoOculto = $(".idProductoOculto"+[i]).val();
     var imgProductoOculto = $(".imgProductoOculto"+[i]).val();;
     guardarPedido.push({"nombre":cambioNombre,"precio":Number(precioOculto),"cantidad":cambioCantidad,"id":idProductoOculto,"img":imgProductoOculto});
     arrayTotal.push(Number(cambioPrecio));
     sumarTotalPrecios();
   }
   $("#totalPedido").html('$ '+total);

})

/*ENVIAR PEDIDO ACTUALIZADO A LA BASE DE DATOS*/
$(document).on('click','.enviarPedido',function(){
  sumarTotalPrecios();
  var datos = new FormData();
	datos.append("idMesero", idMesero);
  datos.append("idMesa", idMesa);
  datos.append("total",total)
  datos.append("orden", JSON.stringify(guardarPedido));

  $.ajax({
		    url: "ajax/agregarMesa.ajax.php",
		    method: "POST",
      	data: datos,
      	cache: false,
     	  contentType: false,
     	  processData: false,
     	  success: function(respuesta){

        var resp = respuesta.substr(-2);

        if(resp == "ok"){
          swal({
              type: "success",
              title: "El pedido ha sido actualizdo correctamente",
              showConfirmButton: true,
              confirmButtonText: "Cerrar"
              }).then(function(result){
                  if (result.value) {

                  window.location = "mesas";

                  }
                })
        }else{
          swal({
						  type: "error",
						  title: "¡El pedido no ha sido actualizdo correctamente!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {
							window.location = "mesas";
							}
						})
        }
      }
	})

})


/*BORRAR TODO EL CONTENIDO DEL ARRAY AL CERRAR LA VENTANA*/
$(document).on('click','.cerrarModal',function(){
  guardarPedido = [];
  arrayTotal = [];
  $("#totalPedido").html('$ ');
})
$(document).on('click','.cerrarModalX',function(){
  guardarPedido = [];
  arrayTotal = [];
  arrayItem = [];
  $("#totalPedido").html('$ ');
})

/*ELIMINAR PRODUCTO DEL PEDIDO*/
$(document).on('click','.btnEliminarItem',function(){

var totalC = $(this).attr('attBtnEliminarItem');

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

$("#tablaPedidos").html('');
arrayItem = [];
for(var i=0; i < guardarPedido.length; i++){
  $("#tablaPedidos").append('<tr>'+
                     '<td  class="nombreProducto'+i+'">'+guardarPedido[i]["nombre"]+'</td>'+
                     '<td>'+
                           '<img class="img-circle" width="40px"src="'+guardarPedido[i]["img"]+'">'+
                     '</td>'+
                     '<td class="precioProducto'+i+'">'+Number(guardarPedido[i]["precio"])*Number(guardarPedido[i]["cantidad"])+'</td>'+
                     '<td>'+
                         '<input class="cambiarCantidad cambiarCantidad'+i+'" cambiarCantidad='+i+' precio='+guardarPedido[i]["precio"]+' type="number" value="'+guardarPedido[i]["cantidad"]+'" style="width:70px;">'+
                         '<input class="precioProductoOculto precioProductoOculto'+i+'"  type="hidden"  value="'+guardarPedido[i]["precio"]+'" style="width:70px;">'+
                         '<input class="idProductoOculto idProductoOculto'+i+'"  type="hidden"  value="'+guardarPedido[i]["id"]+'" style="width:70px;">'+
                         '<input class="imgProductoOculto imgProductoOculto'+i+'"  type="hidden"  value="'+guardarPedido[i]["img"]+'" style="width:70px;">'+
                     '<td>'+
                       '<div class="btn-group">'+
                         '<button class="btn btn-danger btnEliminarItem" attBtnEliminarItem="'+i+'"><i class="fa fa-times"></i></button>'+
                       '</div>'+
                     '</td>'+
                   '</tr>');
                   arrayItem.push(i);
}
  $(this).parent().parent().parent().remove();
  sumarTotalPrecios();
  $("#totalPedido").html('$ '+total);

})

/*IMPRIMIR FACTURA*/
/*$(document).on('click','.imprimirFactura',function(){

  var idImprimirFactura = $(this).attr('idImprimirFactura');
  idMesero = $(this).attr('idItemMesero');
  idMesa = $(this).attr('idItemMesa');

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

   var datos = new FormData();

   datos.append("idMeseroMostrarFactura",idMesero);
   datos.append("idMesaMostrarFactura",idMesa);
   datos.append('idImprimirFactura',idImprimirFactura);

    $.ajax({
      url: "ajax/agregarMesa.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      //dataType:'json',
      success: function(respuesta){

        if(respuesta == "ok"){
          window.open('extensiones/TCPDF-master/pdf/factura.php?codigo='+idImprimirFactura,"_blank");
          window.location = "mesas";
        }else{
          swal({
              type: "error",
              title: "¡Al imprimir la factura!",
              showConfirmButton: true,
              confirmButtonText: "Cerrar"
              }).then(function(result){
              if (result.value) {
              window.location = "mesas";
              }
            })
        }
        }
     })
   }
  })
})*/

/*ELIMINAR ORDEN*/
$(document).on('click','.btnEliminarOrden',function(){
  var idItemMesero = $(this).attr('idItemMesero');
  var idItemMesa = $(this).attr('idItemMesa');
  var idItemEstado = $(this).attr('idItemEstado');
  var id = $(this).attr('id');
  swal({
   title: '¿Está seguro de borrar la orden?',
   text: "¡Si no lo está puede cancelar la acción!",
   type: 'warning',
   showCancelButton: true,
   confirmButtonColor: '#3085d6',
   cancelButtonColor: '#d33',
   cancelButtonText: 'Cancelar',
   confirmButtonText: 'Si, borrar orden!'
  }).then(function(result){

   if(result.value){

     window.location = "index.php?ruta=mesas&idItemMesero="+idItemMesero+"&idItemMesa="+idItemMesa+"&idItemEstado="+idItemEstado+"&id="+id;

   }

  })

})
