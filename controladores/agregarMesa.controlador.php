<?php

class ControladorMesa{

	/*=============================================
	CREAR CATEGORIAS
	=============================================*/

	static public function ctrCrearMesa(){

		if(isset($_POST["nuevaMesa"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ° ]+$/', $_POST["nuevaMesa"])){

				$tabla = "mesas";

				$datos = strtoupper($_POST["nuevaMesa"]);

				$respuesta = ModeloMesas::mdlIngresarMesa($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La mesa ha sido guardada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "agregarMesa";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡La mesa no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "agregarMesa";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	MOSTRAR CATEGORIAS
	=============================================*/

	static public function ctrMostrarMesas($item, $valor){

		$tabla = "mesas";

		$respuesta = ModeloMesas::mdlMostrarMesas($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	EDITAR CATEGORIA
	=============================================*/

	static public function ctrEditarMesa(){

		if(isset($_POST["editarMesa"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ° ]+$/', $_POST["editarMesa"])){

				$tabla = "mesas";

				$datos = array("nombre"=>$_POST["editarMesa"],
							         "id"=>$_POST["idMesa"]);

				$respuesta = ModeloMesas::mdlEditarMesa($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La mesa ha sido cambiada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "agregarMesa";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡La mesa no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "agregarMesa";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	BORRAR CATEGORIA
	=============================================*/

	static public function ctrBorrarMesa(){

		if(isset($_GET["idMesa"])){

			$tabla ="mesas";
			$datos = $_GET["idMesa"];

			$respuesta = ModeloMesas::mdlBorrarMesa($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

					swal({
						  type: "success",
						  title: "La mesa ha sido borrada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "agregarMesa";

									}
								})

					</script>';
			}
		}

	}
}
