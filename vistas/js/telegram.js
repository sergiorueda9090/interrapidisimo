
$(document).on('click','.btnEditarTelegram',function(){
    let idTelegram = $(this).attr("idTelegram");
    $(".idTelegramUpdate").val(idTelegram);
})

$(document).on("click",".btnSelectMensajero",function(){

    let selectMensajero = $(".selectMensajero").val();
    let idTelegram = $(".idTelegramUpdate").val();

    if(selectMensajero == ""){
        alert("Seleccione un mensajero");
    }else{
        let datos = new FormData();
        datos.append("username", selectMensajero);
        datos.append("idTelegram", idTelegram);
        $.ajax({
            url:"ajax/telegram.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta){
                if(respuesta === "ok"){
                    swal({
                      type: "success",
                      title: "Actualizado correctamente",
                      showConfirmButton: true,
                      confirmButtonText: "Cerrar"
                      }).then(function(result){
                          if (result.value) {
                          window.location = "telegram";
                          }
                        })
                  }else{
                    swal({
                      type: "danger",
                      title: "No ha sido actualizado correctamente",
                      showConfirmButton: true,
                      confirmButtonText: "Cerrar"
                      }).then(function(result){
                          if (result.value) {
                          window.location = "telegram";
                          }
                        })
                  }
            }
        });

    }

});

$(".tablas").on("click", ".btnEliminarTelegram", function(){

    var idTelegram = $(this).attr("idTelegram");
  
    swal({
      title: '¿Está seguro de borrar el Telegram?',
      text: "¡Si no lo está puede cancelar la accíón!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar Telegram!'
    }).then(function(result){
  
      if(result.value){
  
        window.location = "index.php?ruta=telegram&idTelegram="+idTelegram;
  
      }
  
    })
  
  })
  