<?php

use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

  class DomicilioCtr{

    /*AGREGAR DOMICILIO*/
    static public function ctrAgregarDomicilio($datos){

      /*$impresora = "npcronos";

      $conector = new WindowsPrintConnector($impresora);

      $imprimir = new Printer($conector);

      $imprimir -> text("Hola mundo"."\n");

      $imprimir -> cut();

      $imprimir -> close();*/

      $tabla = "domicilios";
      $respuesta = DomicilioMdl::mdlAgregarDomicilio($tabla,$datos);
      return $respuesta;
    }

    /*MOSTRAR TODOS LOS DOMICILIOS*/
    static public function ctrMostrarDomicilios($dato){
      $tabla = "domicilios";
      $id = $dato;
      $respuesta = DomicilioMdl::mdlMostrarDomicilios($tabla,$id);
      return $respuesta;
    }

    /*TRAER EL NOMBRE DEL USUARIO*/
    static public function ctrMostrarNombre($item){
      $tabla = "usuarios";
      $respuesta = DomicilioMdl::mdlMostrarNombre($tabla,$item);
      return $respuesta;
    }

    /*CAMBIO DE ESTADO*/
    static public function ctrcambioEstado($item){
        $tabla = "domicilios";
        $respuesta = DomicilioMdl::mdlcambioEstado($tabla,$item);
        return $respuesta;
    }

    /*SELECCIONAR DOMICILIO PARA EDITAR*/
   static public function ctrEditarDomicilio($item){
     $tabla = "domicilios";
     $respuesta = DomicilioMdl::mdlEditarDomicilio($tabla,$item);
     return $respuesta;
   }

   /*ACTUALIZAR DOMICILIO*/
   static public function ctrActualizarDomicilio($datos){
     $tabla = "domicilios";
     $respuesta = DomicilioMdl::mdlActualizarDomicilio($tabla,$datos);
     return $respuesta;
   }

   /*ELIMINAR DOMICILIO*/
   static public function ctrEliminarDomicilio(){

     if(isset($_GET["idDomicilio"])){
        $idEliminarDomicilio = $_GET["idDomicilio"];
        $tabla = "domicilios";
        $respuesta = DomicilioMdl::mdlEliminarDomicilio($tabla,$idEliminarDomicilio);
        if($respuesta == "ok"){
          echo '<script>
          swal({
              type: "success",
              title: "El domicilio ha sido eliminado correctamente",
              showConfirmButton: true,
              confirmButtonText: "Cerrar"
              }).then(function(result){
                  if (result.value) {

                  window.location = "asignarDomicilio";

                  }
                })
          </script>';
        }else{
          echo '<script>
          swal({
              type: "success",
              title: "El domicilio no ha sido eliminado correctamente",
              showConfirmButton: true,
              confirmButtonText: "Cerrar"
              }).then(function(result){
                  if (result.value) {

                  window.location = "asignarDomicilio";

                  }
                })
          </script>';
        }

     }

   }

   /*BUSCAR INFORMACION POR ID*/
   static public function ctrBuscarInfoDomicilio($datos){
     $tabla = "domicilios";
     $respuesta = DomicilioMdl::mdlBuscarInfoDomicilio($tabla,$datos);
     return $respuesta;
   }

   /*BUSCAR INFORMACION POR TELEFONO*/
   static public function ctrBuscarInfoDomicilioTelefono($datos){
     $tabla = "clientes";
     $respuesta = DomicilioMdl::mdlBuscarInfoDomicilioTelefono($tabla,$datos);
     return $respuesta;
   }

  }

 ?>
