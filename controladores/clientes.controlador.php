<?php

class ClienteCtr{

  static public function ctrCrearCliente(){


    if(isset($_POST["cliente"])){

      $tabla = "clientes";
      
      $datos = array("cliente"    => $_POST["cliente"],
                     "nombre"     => $_POST["nombreCliente"],
                     "telefono1"  => $_POST["telefonoCliente1"],
                     "telefono2"  => $_POST["telefonoCliente2"],
                     "direccion"  => $_POST["direccionCliente"]);

      $respuesta = ClienteMdl::mdlCrearCliente($tabla,$datos);

      if($respuesta){

        if(isset($_POST["infoUsuarioCliente"])){

          $usuarios = json_decode($_POST["infoUsuarioCliente"], true);

          foreach($usuarios as $key => $user){
              $idCliente = $respuesta;
              $nombre    = $user['nombre'];
              $telefono1 = $user['telefono1'];
              $telefono2 = $user['telefono2'];
              $direccion = $user['direccion'];
              $respuestaClienteUsuario = ClienteMdl::mdlCrearClienteUsuario($idCliente,$nombre,$telefono1,$telefono2,$direccion);
          }

        }

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

  static public function ctrMostrarClientesUsuarios($valor){
    $tabla = "clientesusuarios";
    $respuesta = ClienteMdl::mdlMostrarClientesUsuarios($tabla, $item="idUsuario", $valor);
    return $respuesta;
  }

  static public function ctrEditarCliente(){

    if(isset($_POST["clienteEditar"])){

      $tabla = "clientes";

      $datos = array("cliente"    => $_POST["clienteEditar"],
                     "nombre"     => $_POST["nombreCliente"],
                     "telefono1"  => $_POST["telefonoCliente1"],
                     "telefono2"  => $_POST["telefonoCliente2"],
                     "tipo"       => $_POST["tipo"],
                     "direccion"  => $_POST["direccionCliente"],
                     "id"         => $_POST["id"]);

      $respuesta = ClienteMdl::mdlEditarCliente($tabla,$datos);

      if($respuesta == "ok"){

        if(isset($_POST["infoUsuarioClienteEditar"])){

          $respuestaDelete = ClienteMdl::mdlBorrarClienteUsuario($_POST["id"]);

          if($respuestaDelete){

            $usuarios = json_decode($_POST["infoUsuarioClienteEditar"], true);

            foreach($usuarios as $key => $user){
                $idCliente = $_POST["id"];
                $nombre    = $user['nombre'];
                $telefono1 = $user['telefono1'];
                $telefono2 = $user['telefono2'];
                $direccion = $user['direccion'];
                $respuestaClienteUsuario = ClienteMdl::mdlCrearClienteUsuario($idCliente,$nombre,$telefono1,$telefono2,$direccion);
            }

          }

        }

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

  /*=============================================
	CHOOSING CUSTOMER
	=============================================*/
  static public function ctrChoosingCustomber($id){
    $table    = "clientes";
    $response = ClienteMdl::mdlChoosingCustomers($table, $id);
    return $response;
  }


}
