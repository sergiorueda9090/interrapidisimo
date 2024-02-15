<?php

  class AsignarMesa{

    /*ASIGNAR MESA Y MESERO*/
    static public function ctrAsigarMesa(){

      if(isset($_POST["idPersonaAsignado"])){

        $idPersona = $_POST["idPersonaAsignado"];
        $idMesa = $_POST["idMesaAsignada"];
        $nombreCliente = $_POST["nombreCliente"];
        $numeroCliente = $_POST["numeroCliente"];
        $fechaReserva = $_POST["fechaReserva"];

        $tabla = 'asignarMesa';

        $datos = array("idMesaAsignada" => $idMesa,
                        "idPersona" => $idPersona,
                        "estado" => 1,
                        "nombreCliente" => $nombreCliente,
                        "numeroCliente" => $numeroCliente,
                        "fechaReserva" => $fechaReserva);

        $respuesta = AsignarMesaModel::mdlAsigarMesa($tabla,$datos);

        if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La mesa ha sido guardada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "mesas";

									}
								})

					</script>';

				}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡La mesa no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "mesas";

							}
						})

			  	</script>';

			}

      }
   }

    /*TRAER NOMBRES DE LOS MESEROS DEPENDIENDO DE LA MESA ASIGNADA*/
    static public function ctrNombreMeseros($id){
      $tablaUsuarios = "usuarios";
      $tablaAsignarMesa = "asignarMesa";
      $respuesta = AsignarMesaModel::mdlNombreMeseros($tablaUsuarios,$tablaAsignarMesa,$id);
      return $respuesta;
    }

   /*MOSTRAR INFORMACION DEL LOS MESEROS EN LAS MESAS*/
   static public function ctrMostrarInformacionMesero($id){
     $tabla = "usuarios";
     $respuesta = AsignarMesaModel::mdlMostrarInformacionMesero($tabla,$id);
     return $respuesta;
   }

   /*ACTUALIZAR ORDEN*/
   static public function ctrActualizarOrden($datos){
     $tabla = "asignarMesa";
     $respuesta = AsignarMesaModel::mdlActualizarOrden($tabla,$datos);
     return $respuesta;
   }

   /*MOSTRAR ORDEN*/
   static public function ctrMostrarOrden($datos){
     $tabla = "asignarMesa";
     $respuesta = AsignarMesaModel::mdlMostrarOrden($tabla,$datos);
     return $respuesta;
   }

   /*SELECCIONAMOS TODOS LOS PRODUCTO DEPENDIENTO DE SU CATEGORIA*/
   static public function ctrMostrarProductosCategorias($id){
     $tabla = "productos";
     $respuesta = AsignarMesaModel::mdlMostrarProductosCategorias($tabla,$id);
     return $respuesta;
   }


   /*SELECCIONAR DESCRIPCION DEL PRODUCTO A COMPRAR*/
   static public function crtMosrarDescripcionProducto($valor){
     $tabla = "productos";
     $respuesta = AsignarMesaModel::mdlMosrarDescripcionProducto($tabla,$valor);
     return $respuesta;

   }

   /*IMPRIMIR FACTURA*/
   static public function ctrImprimirFactura($datos){
     $tabla = "domicilios";
     $respuesta = AsignarMesaModel::mdlImprimirFactura($tabla,$datos);
     return $respuesta;
   }

   /*IMPRIMIR FACTURA*/
   static public function ctrImprimirFacturaUna($datos){
     $tabla = "domicilios";
     $respuesta = AsignarMesaModel::mdlImprimirFacturaUna($tabla,$datos);
     return $respuesta;
   }

   /*CAMBIAR EL ESTADO DE AL ORDEN A 0*/
   static public function ctrCambioEstado($datos){
     $tabla = "domicilios";
     $respuesta = AsignarMesaModel::mdlCambioEstado($tabla,$datos);
     return $respuesta;
   }


   /*ELIMINAR ORDEN*/
   static public function ctrEliminarOrden(){

      if(isset($_GET["idItemMesero"])){

        $idItemMesero = $_GET["idItemMesero"];
        $idItemMesa = $_GET["idItemMesa"];
        $idItemEstado = $_GET["idItemEstado"];
        $id = $_GET["id"];

        $datos = array("idItemMesero"=>$idItemMesero,
                       "idItemMesa"=>$idItemMesa,
                       "idItemEstado"=>$idItemEstado,
                       "id"=>$id);

        $tabla = 'asignarMesa';

        $respuesta = AsignarMesaModel::mdlEliminarOrden($tabla,$datos);

        if($respuesta == "ok"){

          echo'<script>

          swal({
              type: "success",
              title: "La orden ha sido borrada correctamente",
              showConfirmButton: true,
              confirmButtonText: "Cerrar"
              }).then(function(result){
                  if (result.value) {

                  window.location = "mesas";

                  }
                })

          </script>';

        }else{

        echo'<script>

          swal({
              type: "error",
              title: "¡La orden no ha sido borrada correctamente!",
              showConfirmButton: true,
              confirmButtonText: "Cerrar"
              }).then(function(result){
              if (result.value) {

              window.location = "mesas";

              }
            })

          </script>';

      }

      }
   }

 }




 ?>
