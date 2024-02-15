/*=============================================
EDITAR CATEGORIA
=============================================*/

$(document).on("click", ".btnEditarMesa", function(){

	var idMesa = $(this).attr("idMesa");
  console.log("idMesa ",idMesa);
	var datos = new FormData();
	datos.append("idMesa", idMesa);

	$.ajax({
		    url: "ajax/agregarMesa.ajax.php",
		    method: "POST",
        data: datos,
      	cache: false,
     	  contentType: false,
     	  processData: false,
     	  dataType:"json",
     	  success: function(respuesta){
     		$(".editarMesa").val(respuesta["nombre"]);
     		$(".idMesa").val(respuesta["id"]);
     	}

	})


})

/*=============================================
ELIMINAR CATEGORIA
=============================================*/
$(document).on("click", ".btnEliminarMesa", function(){

	 var idMesa = $(this).attr("idMesa");

	 swal({
	 	title: '¿Está seguro de borrar la categoría?',
	 	text: "¡Si no lo está puede cancelar la acción!",
	 	type: 'warning',
	 	showCancelButton: true,
	 	confirmButtonColor: '#3085d6',
	 	cancelButtonColor: '#d33',
	 	cancelButtonText: 'Cancelar',
	 	confirmButtonText: 'Si, borrar categoría!'
	 }).then(function(result){

	 	if(result.value){

	 		window.location = "index.php?ruta=agregarMesa&idMesa="+idMesa;

	 	}

	 })

})
