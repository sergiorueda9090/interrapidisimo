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
      $(".clienteEditar").val(respuesta["cliente"]);
      $(".nombreEditar").val(respuesta["nombre"]);
      $(".telefonoEditar1").val(respuesta["telefono1"]);
      $(".telefonoEditar2").val(respuesta["telefono2"]);
      $(".tipoEditar").val("CREDITO");
      $(".direccionEditar").val(respuesta["direccion"]);
      $(".idEditar").val(respuesta["id"]);
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
