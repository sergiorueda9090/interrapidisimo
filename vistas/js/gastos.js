/*=============================================
EDITAR GASTO
=============================================*/
$(".tablas").on("click", ".btnEditarGasto", function(){
var idGasto = $(this).attr("idGasto");
console.log("idGasto ",idGasto);
var datos = new FormData();
    datos.append("idGasto", idGasto);

  $.ajax({
    url:"ajax/gastos.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType:"json",
    success:function(respuesta){
      $(".nombreEditarGasto").val(respuesta['nombreGasto']);
      $(".valorEditarGasto").val(respuesta['valorGasto']);
      $(".idEditarGasto").val(respuesta['idGastos']);
      $(".fechaEditarGasto").val(respuesta['fechaGasto']);
  }

	})

})


$(document).on('click','.btnEliminarGasto',function(){
  var idGasto = $(this).attr("idGasto");
  swal({
        title: '¿Está seguro de borrar el gasto?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar gasto!'
      }).then(function(result){
        if (result.value) {

            window.location = "index.php?ruta=gastos&gastos="+idGasto;
        }

  })

})
