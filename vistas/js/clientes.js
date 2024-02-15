$(document).on('click','.btnEditarClientes',function(){

  var idCliente = $(this).attr('idCliente');
  console.log("idCliente ",idCliente);


  var datos = new FormData();
	datos.append("idCliente", idCliente);

	$.ajax({
		url:"ajax/clientes.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
      $(".nombreClienteEditar").val(respuesta["nombre"]);
      $(".telefonoClienteEditar").val(respuesta["telefono"]);
      $(".direccionClienteEditar").val(respuesta["direccion"]);
      $(".idClienteEditar").val(respuesta["id"]);
		}

	});
})

$(document).on('click','.salirEditarCliente',function(){
  $(".nombreClienteEditar").val("");
  $(".telefonoClienteEditar").val("");
  $(".direccionClienteEditar").val("");
})


/*=============================================
ELIMINAR USUARIO
=============================================*/
$(".tablas").on("click", ".btnEliminarClientes", function(){

  var idCliente = $(this).attr("idCliente");


  swal({
    title: '¿Está seguro de borrar el usuario?',
    text: "¡Si no lo está puede cancelar la accíón!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, borrar usuario!'
  }).then(function(result){

    if(result.value){

      window.location = "index.php?ruta=clientes&idCliente="+idCliente;

    }

  })

})
