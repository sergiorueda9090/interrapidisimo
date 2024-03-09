let arrayUsuarios = [];

$(document).on("change",".valorDomicilio",function(){
    let valor = $('.valorDomicilio').val();
    let valorFormateado = parseFloat(valor).toLocaleString('en-US', { style: 'decimal', minimumFractionDigits: 2, maximumFractionDigits: 2 });
    $('.valorDomicilio').val(valorFormateado);
})

$(document).on("change",".valorDomicilioEditar",function(){
  let valor = $('.valorDomicilioEditar').val();
  let valorFormateado = parseFloat(valor).toLocaleString('en-US', { style: 'decimal', minimumFractionDigits: 2, maximumFractionDigits: 2 });
  $('.valorDomicilioEditar').val(valorFormateado);
})


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
        $(".nameCliente").val(respuesta["nombre"]);
        $(".direccionCliente").val(respuesta["direccion"]);
        $(".telefonoCliente1").val(respuesta["telefono1"]);
        $(".telefonoCliente2").val(respuesta["telefono2"]);
        $(".tipo").val("CONTADO");
        //$(".tipoPagar").val("CONTADO");
        $(".tipoEditar").val("CREDITO");
        $(".idCustomer").val(respuesta["id"]);
    } catch (error) {
        // Oculta el indicador de carga si hay un error en la solicitud
        $('.loader').css({"display":"hide"});
        alert("Error en la solicitud AJAX:", error);
    }
    listarClientesUsuarios(idCustomer);
}); 

function listarClientesUsuarios(idCustomer){
  var datos = new FormData();
  datos.append("idCustomerUser", idCustomer);
  try {
      // Realiza la solicitud AJAX y espera la respuesta
      $.ajax({
        url:"ajax/delivery.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){
          console.log("respuesta ",respuesta);
          if(respuesta.length > 0){
              arrayUsuarios = respuesta;
              $('.nameCliente').empty();
              $('.nameCliente').append('<option value="">Selecciona Usuario</option>');
              $.each(respuesta, function(index, usuario) {
                  $('.nameCliente').append('<option value="' + usuario.id + '">' + usuario.nombre + '</option>');
              });
              $(".direccionCliente").val("");
              $(".telefonoCliente1").val("");
              $(".telefonoCliente2").val("");
          }else{
            $('.nameCliente').empty();
            $('.nameCliente').append('<option value="">Sin Usuarios</option>');
            arrayUsuarios = [];
          }

        }
      });

  } catch (error) {
      // Oculta el indicador de carga si hay un error en la solicitud
      $('.loader').css({"display":"hide"});
      alert("Error en la solicitud AJAX:", error);
  }
}

$(document).on('change','.nameCliente',function(){
  let infoUser = arrayUsuarios.filter((id) => id.id == $(".nameCliente").val());  
  if(infoUser){
    $(".telefonoCliente1").val(infoUser[0].telefono1);
    $(".telefonoCliente2").val(infoUser[0].telefono2);
    $(".direccionCliente").val(infoUser[0].direccion);
  }
})

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
        $(".nameClienteEditar").val(respuesta["nombre"]);
        $(".telefonoCliente1Editar").val(respuesta["telefono1"]);
        $(".telefonoCliente2Editar").val(respuesta["telefono2"]);
        $(".tipoEditar").val(respuesta["type"]);
        $(".tipoPagarEditar").val(respuesta["typeOfPay"]);
        
        listarClientesUsuariosEditar(respuesta["idCustomer"], respuesta["idUserCustomer"]);

        if(respuesta["typeOfPay"] === "CONTADO"){
          $(".selectPayMethodEditar").css({"display":"block"});
        }else{
          $(".selectPayMethodEditar").css({"display":"none"}) ;
        }
        console.log("sdasd ",respuesta);
        /** */
        if (respuesta["selectPayMethod"] === "Efectivo") {
          $("#r_efectivoEditar").prop("checked", true);
        } else if (respuesta["selectPayMethod"] === "Yoppy") {
            $("#r_yoppyEditar").prop("checked", true);
        } else if (respuesta["selectPayMethod"] === "Transferencia") {
            $("#r_transferenciaEditar").prop("checked", true);
        } else if (respuesta["selectPayMethod"] === "Pendiente") {
          $("#r_pendienteEditar").prop("checked", true);
      }
        /** */
        
        $(".direccionClienteEditar").val(respuesta["pickupAddress"]);
        $(".direccionDestinoEditar").val(respuesta["destinationAddress"]);
        $(".newDireccionEditar").val(respuesta["newAddress"]);
        $(".notaEditar").val(respuesta["note"]);
        
        $(".valorDomicilioEditar").val(parseFloat(respuesta["deliveryPraci"]).toLocaleString('en-US', { style: 'decimal', minimumFractionDigits: 2, maximumFractionDigits: 2 }));

        $(".estado").val(respuesta["paymentProcess"]);
        
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

function listarClientesUsuariosEditar(idCustomer,idCustomerUser){

  var datos = new FormData();
  //console.log("idCustomerUser",idCustomer)
  datos.append("idCustomerUser", idCustomer);

  try {
      // Realiza la solicitud AJAX y espera la respuesta
      $.ajax({
        url:"ajax/delivery.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){
          
          console.log("respuesta ",respuesta);

          if(respuesta.length > 0){

              arrayUsuarios = respuesta;
              $('.nameClienteEditar').empty();
              $('.nameClienteEditar').append('<option value="">Selecciona Usuario</option>');
              
              $.each(respuesta, function(index, usuario) {
                  $('.nameClienteEditar').append('<option value="' + usuario.id + '">' + usuario.nombre + '</option>');
              });

              $(".direccionClienteEditar").val("");
              $(".telefonoCliente1Editar").val("");
              $(".telefonoCliente2Editar").val("");

              selectUserCustomerEdit(idCustomerUser);

          }else{

            $('.nameClienteEditar').empty();
            $('.nameClienteEditar').append('<option value="">Sin Usuarios</option>');
            arrayUsuarios = [];

          }

        }
      });

  } catch (error) {
      // Oculta el indicador de carga si hay un error en la solicitud
      $('.loader').css({"display":"hide"});
      alert("Error en la solicitud AJAX:", error);
  }
}

function selectUserCustomerEdit(idCustomerUser){
  
  console.log("idCustomerUser ",idCustomerUser);
  
  let infoUser = arrayUsuarios.filter((id) => id.id == idCustomerUser);
  
  console.log("arrayUsuarios ",arrayUsuarios);

  if(infoUser){
    
    $('.nameClienteEditar option').filter(function() {
      return $(this).text() === infoUser[0].nombre;
    }).prop('selected', true);

    $(".telefonoCliente1Editar").val(infoUser[0].telefono1);
    $(".telefonoCliente2Editar").val(infoUser[0].telefono2);
    $(".direccionClienteEditar").val(infoUser[0].direccion);
  }
}

$(document).on('change','.nameClienteEditar',function(){
  let infoUser = arrayUsuarios.filter((id) => id.id == $(".nameClienteEditar").val());  
  if(infoUser){
    $(".telefonoCliente1Editar").val(infoUser[0].telefono1);
    $(".telefonoCliente2Editar").val(infoUser[0].telefono2);
    $(".direccionClienteEditar").val(infoUser[0].direccion);
  }
})

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


  $(document).on("change",".tipoPagar",function(){

    let tipoPagar = $(".tipoPagar").val();
   
    if(tipoPagar === "CONTADO"){

      $(".selectPayMethod").css({"display":"block"});

    }else{

      $(".selectPayMethod").css({"display":"none"}) ;

    }

  });

  $(document).on("change",".tipoPagarEditar",function(){

    let tipoPagar = $(".tipoPagarEditar").val();
   
    if(tipoPagar === "CONTADO"){

      $(".selectPayMethodEditar").css({"display":"block"});

    }else{

      $(".selectPayMethodEditar").css({"display":"none"}) ;

    }

  });