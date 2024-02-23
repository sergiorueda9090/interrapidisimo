$(document).on("input", ".customers", async function(){
    // Muestra el indicador de carga
    $('.loader').css({"display":"show"});

    let idCustomer = $(".customers").val();

    var datos = new FormData();
    datos.append("idCustomer", idCustomer);

    try {
        // Realiza la solicitud AJAX y espera la respuesta
        let respuesta = await $.ajax({
            url:"ajax/delivery.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json"
        });

        // Oculta el indicador de carga cuando se completa la solicitud
        $('.loader').hide();

        $(".direccionCliente").val(respuesta["direccion"]);
        $(".telefonoCliente1").val(respuesta["telefono1"]);
        $(".telefonoCliente2").val(respuesta["telefono2"]);
        $(".tipo").val("CONTADO");
        $(".tipoPagar").val("CONTADO");
        $(".tipoEditar").val("CREDITO");
        $(".idCustomer").val(respuesta["id"]);

    } catch (error) {
        // Oculta el indicador de carga si hay un error en la solicitud
        $('.loader').css({"display":"hide"});
        alert("Error en la solicitud AJAX:", error);
    }
});

$(document).on("click", ".btnEditarDelivery", function(){

    let iddelivery = $(this).attr("iddelivery");
    
    let datos = new FormData();
    datos.append("iddelivery", iddelivery);

    $.ajax({
		url:"ajax/delivery.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
        $(".idDeliveryEditar").val(respuesta["id"]);
        $(".customerNameEditar").val(respuesta["idCustomer"]);
        $(".browserEditar").val(respuesta["idDomiciliary"]);
        $(".telefonoCliente1Editar").val(respuesta["telefono1"]);
        $(".telefonoCliente2Editar").val(respuesta["telefono2"]);
        $(".tipoEditar").val(respuesta["type"]);
        $(".tipoPagarEditar").val(respuesta["typeOfPay"]);
        $(".direccionClienteEditar").val(respuesta["pickupAddress"]);
        $(".direccionDestinoEditar").val(respuesta["destinationAddress"]);
        $(".notaEditar").val(respuesta["note"]);
        $(".valorDomicilioEditar").val(respuesta["deliveryPraci"]);
        $(".estado").val(respuesta["paymentProcess"]);
        console.log(respuesta["paymentProcess"]);
        if (respuesta["paymentProcess"] === "enproceso") {
          $("#enprocesoEditar").prop("checked", true);
        } else if (respuesta["paymentProcess"] === "pagado") {
            $("#pagadoEditar").prop("checked", true);
        } else if (respuesta["paymentProcess"] === "admin_recibe_dinero") {
            $("#admin_recibe_dineroEditar").prop("checked", true);
        }

        $(".idUserEditar").val(respuesta["userCreate"]);
		}
	});

    
});

/*=============================================
ELIMINAR USUARIO
=============================================*/
$(document).on("click", ".btnEliminarDelivery", function(){

    let iddelivery = $(this).attr("iddelivery");

    swal({
      title: '¿Está seguro de borrar el Delivery?',
      text: "¡Si no lo está puede cancelar la accíón!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar usuario!'
    }).then(function(result){
  
      if(result.value){
  
        window.location = "index.php?ruta=delivery&iddelivery="+iddelivery;
  
      }
  
    })
  
  })
 
  $(document).on("change",".editStatusMoney",function(){
    // Check if the radio button is checked
      if ($(this).is(":checked")) {
        // Display the selected option
        
        let money =  $(this).val();
        
        swal({
          title: '¿Está seguro de cambiar el estado del dinero?',
          text: "¡Si no lo está puede cancelar la accíón!",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Si, cambiar el estado del dinero!'
        }).then(function(result){
      
          if(result.value){
                moneyOld = $(".editStatusMoney:checked").val();
            let iddelivery = $(".idDeliveryEditar").val();

            let datos = new FormData();
            datos.append("iddeliveryEditar", iddelivery);
            datos.append("money",            money);
        
            $.ajax({
            url:"ajax/delivery.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta){
              
              console.log("respuesta", respuesta);

              if(respuesta === "ok"){
  
                swal({
                  type: "success",
                  title: "El Estado actual del dinero ha sido actualizado correctamente",
                  showConfirmButton: true,
                  confirmButtonText: "Cerrar"
                  }).then(function(result){
                      if (result.value) {
      
                      window.location = "delivery";
      
                      }
                    })
          
              }else{
                swal({
                  type: "danger",
                  title: "El Estado actual del dinero no ha sido actualizado correctamente",
                  showConfirmButton: true,
                  confirmButtonText: "Cerrar"
                  }).then(function(result){
                      if (result.value) {
      
                      window.location = "delivery";
      
                      }
                    })
              }
              
            }
          });
      
          } else {
            // If the user cancels, restore the previous value
            //$(".editStatusMoney[value='" + previousValue + "']").prop("checked", true);
         }
      
        })

      }
  })
