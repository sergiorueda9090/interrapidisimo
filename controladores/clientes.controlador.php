<?php

class ClienteCtr{

  static public function ctrCrearCliente(){


    if(isset($_POST["nombreCliente"])){

      $tabla = "clientes";

      $datos = array("nombre"=>$_POST["nombreCliente"],
                     "direccion"=>$_POST["direccionCliente"],
                     "telefono"=>$_POST["telefonoCliente"]);

      $respuesta = ClienteMdl::mdlCrearCliente($tabla,$datos);

      if($respuesta == "ok"){

        echo'<script>

        swal({
            type: "success",
            title: "El cliente ha sido creado correctamente",
            showConfirmButton: true,
            confirmButtonText: "Cerrar"
            }).then(function(result){
                if (result.value) {

                window.location = "clientes";

                }
              })

        </script>';

      }else{

        echo'<script>

          swal({
              type: "error",
              title: "¡El cliente no puede ir vacío o llevar caracteres especiales!",
              showConfirmButton: true,
              confirmButtonText: "Cerrar"
              }).then(function(result){
              if (result.value) {

              window.location = "clientes";

              }
            })

          </script>';

      }

    }

  }

  static public function ctrMostrarClientes($item, $valor){
    $tabla = "clientes";
    $respuesta = ClienteMdl::mdlMostrarClientes($tabla, $item, $valor);
    return $respuesta;
  }

  static public function ctrEditarCliente(){

    if(isset($_POST["nombreClienteEditar"])){

      $tabla = "clientes";

      $datos = array("nombre"=>$_POST["nombreClienteEditar"],
                     "direccion"=>$_POST["direccionClienteEditar"],
                     "telefono"=>$_POST["telefonoClienteEditar"],
                      "id"=>$_POST["idClienteEditar"]);

      $respuesta = ClienteMdl::mdlEditarCliente($tabla,$datos);

      if($respuesta == "ok"){

        echo'<script>

        swal({
            type: "success",
            title: "El cliente ha sido editado correctamente",
            showConfirmButton: true,
            confirmButtonText: "Cerrar"
            }).then(function(result){
                if (result.value) {

                window.location = "clientes";

                }
              })

        </script>';

      }else{

        echo'<script>

          swal({
              type: "error",
              title: "¡El cliente no puede ir vacío o llevar caracteres especiales!",
              showConfirmButton: true,
              confirmButtonText: "Cerrar"
              }).then(function(result){
              if (result.value) {

              window.location = "clientes";

              }
            })

          </script>';

      }

    }

  }


  /*=============================================
	BORRAR USUARIO
	=============================================*/

	static public function ctrBorrarCliente(){

		if(isset($_GET["idCliente"])){

			$tabla = "clientes";
			$datos = $_GET["idCliente"];

      $respuesta = ClienteMdl::mdlBorrarCliente($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El clientes ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "clientes";

								}
							})

				</script>';

			}else{

        echo'<script>

          swal({
              type: "error",
              title: "El clientes no ha sido borrado correctamente",
              showConfirmButton: true,
              confirmButtonText: "Cerrar"
              }).then(function(result){
              if (result.value) {

            window.location = "clientes";

              }
            })

          </script>';

      }

		}

	}

}
