<?php

class DeliveryCTR{

    /*=============================================
	LIST DELIVERY 
	=============================================*/
    static public function ctrListDeliverys(){

        $table = "delviery";

        $response = DeliveryMdl::mdlClistDelivery($table, $id=null);

        return $response;

    }

    /*=============================================
	SHOW DELIVERY 
	=============================================*/
    static public function ctrShowDeliverys($id){

        $table = "delviery";

        $response = DeliveryMdl::mdlClistDelivery($table, $id);

        return $response;

    }

	/*=============================================
	SHOW CUSTOMER
	=============================================*/
    static public function crtListCustomer(){

        $table = "clientes";

        $response = DeliveryMdl::mdlListClientes($table);

        return $response;

    } 

    /*=============================================
	SHOW DOMICILIARY
	=============================================*/
    static public function crtListDomiciliary(){

        $table = "usuarios";

        $response = ModeloUsuarios::mdlListDomiciliary($table);

        return $response;
    }

    /*=============================================
	CREATE DOMICILIARY
	=============================================*/
    static public function ctrCreateDelivery(){

        if(isset($_POST['customerName'])){

            $customerName     = $_POST['customerName']      ?? null;
            $browser          = $_POST['browser']           ?? null;
            $tipo             = $_POST['tipo']              ?? null;
            $tipoPagar        = $_POST['tipoPagar']         ?? null;
            $selectPayMethod  = $_POST['r_selectPayMethod'] ?? null;
            $direccionCliente = $_POST['direccionCliente']  ?? null;
            $direccionNew     = $_POST['direccionNew']      ?? null;
            $direccionDestino = $_POST['direccionDestino']  ?? null;
            $nota             = $_POST['nota']              ?? null;
            $valorDomicilio   = $_POST['valorDomicilio']    ?? null;
            $money            = $_POST['estado']            ?? null;
            $idUser           = $_POST['idUser']            ?? null;

            if (!empty($customerName) && !empty($browser) && !empty($tipo) && !empty($tipoPagar) && !empty($direccionCliente) && !empty($direccionDestino) && !empty($nota) && !empty($valorDomicilio) && !empty($selectPayMethod)) {
                
                $table = "delviery";

                $datos = array("idCustomer"         => $customerName,
                              "idDomiciliary"       => $browser,
                              "type"                => $tipo,
                              "typeOfPay"           => $tipoPagar,
                              "selectPayMethod"     => $selectPayMethod,
                              "pickupAddress"       => $direccionCliente,
                              "newAddress"          => $direccionNew,
                              "destinationAddress"  => $direccionDestino,
                              "note"                => $nota,
                              "deliveryPraci"       => $valorDomicilio,
                              "money"               => $money,
                              "idUser"              => $idUser);
                
                $response = DeliveryMdl::mdlCreateDelivery($table, $datos);

                if($response == "ok"){

                    echo'<script>
            
                    swal({
                        type: "success",
                        title: "El delivery ha sido creado correctamente",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                        }).then(function(result){
                            if (result.value) {
            
                            window.location = "delivery";
            
                            }
                          })
            
                    </script>';
            
                  }else{
            
                    echo'<script>
            
                      swal({
                          type: "error",
                          title: "¡El delivery no puede ir vacío o llevar caracteres especiales!",
                          showConfirmButton: true,
                          confirmButtonText: "Cerrar"
                          }).then(function(result){
                          if (result.value) {
            
                          window.location = "delivery";
            
                          }
                        })
            
                      </script>';
            
                  }



            } else {
                // Alguna de las variables está vacía o no está definida
                // Maneja el caso en consecuencia
            }

        }
    }


    /*=============================================
	EDITAR DOMICILIARY
	=============================================*/
    static public function ctrEditarDelivery(){

        if(isset($_POST['customerNameEditar'])){

            $customerName           = $_POST['customerNameEditar']      ?? null;
            $browser                = $_POST['browserEditar']           ?? null;
            $tipo                   = $_POST['tipoEditar']              ?? null;
            $tipoPagar              = $_POST['tipoPagarEditar']         ?? null;
            $selectPayMethodEditar  = $_POST['r_selectPayMethodEditar'] ?? null;
            $direccionCliente       = $_POST['direccionClienteEditar']  ?? null;
            $direccionNew           = $_POST['newDireccionEditar']      ?? null;
            $direccionDestino       = $_POST['direccionDestinoEditar']  ?? null;
            $nota                   = $_POST['notaEditar']              ?? null;
            $valorDomicilio         = $_POST['valorDomicilioEditar']    ?? null;
            $money                  = $_POST['estadoEditar']            ?? null;
            $idUser                 = $_POST['idUserEditar']            ?? null;
            $idDelivery             = $_POST['idDeliveryEditar']        ?? null;

            if (!empty($idDelivery)) {
                
                $table = "delviery";

                $datos = array(
                             "id"                   => $idDelivery, 
                             "idCustomer"           => $customerName,
                              "idDomiciliary"       => $browser,
                              "type"                => $tipo,
                              "typeOfPay"           => $tipoPagar,
                              "selectPayMethod"     => $selectPayMethodEditar,
                              "pickupAddress"       => $direccionCliente,
                              "newAddress"          => $direccionNew,
                              "destinationAddress"  => $direccionDestino,
                              "note"                => $nota,
                              "deliveryPraci"       => $valorDomicilio,
                              "money"               => $money,
                              "idUser"              => $idUser);
                
                $response = DeliveryMdl::mdlEditarDelivery($table, $datos);

                if($response == "ok"){

                    echo'<script>
            
                    swal({
                        type: "success",
                        title: "El delivery ha sido actualizado correctamente",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                        }).then(function(result){
                            if (result.value) {
            
                            window.location = "delivery";
            
                            }
                          })
            
                    </script>';
            
                  }else{
            
                    echo'<script>
            
                      swal({
                          type: "error",
                          title: "¡El delivery no puede ir vacío o llevar caracteres especiales!",
                          showConfirmButton: true,
                          confirmButtonText: "Cerrar"
                          }).then(function(result){
                          if (result.value) {
            
                          window.location = "delivery";
            
                          }
                        })
            
                      </script>';
            
                  }



            } else {
                // Alguna de las variables está vacía o no está definida
                // Maneja el caso en consecuencia
            }

        }
    }

    
  /*=============================================
	BORRAR DELIVERY
	=============================================*/

	static public function ctrBorrarDelivery(){

		if(isset($_GET["iddelivery"])){

			$table = "delviery";
      
			$datos = $_GET["iddelivery"];

            $response = DeliveryMdl::mdlBorrarDelivery($table, $datos);

			if($response == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El delivery ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "delivery";

								}
							})

				</script>';

			}else{

        echo'<script>

          swal({
              type: "error",
              title: "El delivery no ha sido borrado correctamente",
              showConfirmButton: true,
              confirmButtonText: "Cerrar"
              }).then(function(result){
              if (result.value) {

            window.location = "delivery";

              }
            })

          </script>';

      }

		}

	}

    /*=============================================
	EDITAR MONEY
	=============================================*/
    static public function ctrEditMoneyDeliverys($id,$moneyEdita){

        $table = "delviery";

        $response = DeliveryMdl::mdlEditMoneyDelivery($table, $id, $moneyEdita);

        return $response;

    }
}