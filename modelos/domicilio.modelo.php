<?php

  require_once "conexion.php";

  class DomicilioMdl{

     /*AGREGAR DOMICILIO*/
    static public function mdlAgregarDomicilio($tabla,$datos){

      $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (nombre,telefono,direccion,zona,idUsuario,barrio,precioDomicilio,precioDescuento,porcentajeDescuento,estado,direccionDestino,selectFormaPago) VALUES (:nombre,:telefono,:direccion,:zona,:idUsuario,:barrio,:precioDomicilio,:precioDescuento,:porcentajeDescuento,1,:direccionDestino,:selectFormaPago)");
      $stmt -> bindParam(":nombre",$datos["telefonoCliente"],PDO::PARAM_STR);
      $stmt -> bindParam(":telefono",$datos["nombreCliente"],PDO::PARAM_STR);
      $stmt -> bindParam(":direccion",$datos["direccionCliente"],PDO::PARAM_STR);
      $stmt -> bindParam(":zona",$datos["seleccionarPedidoDomi"],PDO::PARAM_STR);
      $stmt -> bindParam(":idUsuario",$datos["seleccionarBarrio"],PDO::PARAM_STR);
      $stmt -> bindParam(":barrio",$datos["precioDomicilio"],PDO::PARAM_STR);
      $stmt -> bindParam(":precioDomicilio",$datos["idDomiciliario"],PDO::PARAM_STR);
      $stmt -> bindParam(":precioDescuento",$datos["precioDomicilioOculto"],PDO::PARAM_STR);
      $stmt -> bindParam(":porcentajeDescuento",$datos["porcentajeDomicilio"],PDO::PARAM_STR);
      $stmt -> bindParam(":direccionDestino",$datos["direccionDestino"],PDO::PARAM_STR);
      $stmt -> bindParam(":selectFormaPago",$datos["selectFormaPago"],PDO::PARAM_STR);
      if($stmt -> execute()){
          return "ok";
      }else{
        return "error";
      }

      $stmt -> close();

      $stmt = null;

    }

    /*MOSTRAR TODOS LOS DOMICILIOS*/
    static public function mdlMostrarDomicilios($tabla,$id){
      $stmt = Conexion::conectar()->prepare("SELECT nombre,telefono,direccion,zona,idUsuario,barrio,precioDomicilio, precioDescuento,porcentajeDescuento,estado, fecha,precioDomicilio,(SELECT SUM(precioDomicilio) FROM $tabla WHERE idUsuario = $id and estado = 1) as total,(SELECT SUM(precioDescuento) FROM $tabla WHERE idUsuario = $id and estado = 1) as subTotal FROM $tabla WHERE idUsuario = $id and estado = 1");
      $stmt -> execute();
      return $stmt -> fetchAll();
      $stmt -> close();
      $stmt = null;
    }

    /*TRAER EL NOMBRE DEL USUARIO*/
   static public function mdlMostrarNombre($tabla,$item){
     $stmt = Conexion::conectar()->prepare("SELECT nombre FROM $tabla WHERE id = :id");
     $stmt -> bindParam(":id",$item,PDO::PARAM_STR);
     $stmt -> execute();
     return $stmt -> fetch();
     $stmt -> close();
     $stmt = null;
   }

   /*CAMBIO DE ESTADO*/
   static public function mdlcambioEstado($tabla,$item){
     $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estado = 0 WHERE id = :id");
     $stmt -> bindParam(":id",$item,PDO::PARAM_STR);
     if($stmt -> execute()){
       return "ok";
     }else{
       return "error";
     }
     $stmt -> close();
     $stmt = null;
   }

   /*SELECCIONAR DOMICILIO PARA EDITAR*/
   static public function mdlEditarDomicilio($tabla,$item){
     $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id = :id");
     $stmt -> bindParam(":id",$item,PDO::PARAM_STR);
     $stmt -> execute();
     return $stmt -> fetch();
     $stmt -> close();
     $stmt = null;
   }

   /*ACTUALIZAR DOMICILIO*/
   static public function mdlActualizarDomicilio($tabla,$datos){

     $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, telefono =:telefono,	direccion=:direccion, idUsuario=:idUsuario, orden=:orden, total=:total WHERE id = :id");

     $stmt -> bindParam(":id",$datos["idEditardomicilio"],PDO::PARAM_STR);
     $stmt -> bindParam(":nombre",$datos["nombreClienteEditar"],PDO::PARAM_STR);
     $stmt -> bindParam(":telefono",$datos["telefonoClienteEditar"],PDO::PARAM_STR);
     $stmt -> bindParam(":direccion",$datos["direccionClienteEditar"],PDO::PARAM_STR);
     $stmt -> bindParam(":idUsuario",$datos["usuarioClienteEditar"],PDO::PARAM_STR);
     $stmt -> bindParam(":orden",$datos["domicilioEditar"],PDO::PARAM_STR);
     $stmt -> bindParam(":total",$datos["totalEditar"],PDO::PARAM_STR);

     if($stmt->execute()){

        return "ok";

     }else{

       return "error";

     }

     $stmt -> close();
     $stmt = null;

   }

   /*ELIMINAR DOMICILIO*/
   static public function mdlEliminarDomicilio($tabla,$idEliminarDomicilio){

     $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
     $stmt -> bindParam(":id",$idEliminarDomicilio,PDO::PARAM_STR);

     if($stmt->execute()){
        return "ok";
     }else{
       return "error";
     }

     $stmt -> close();
     $stmt = null;

   }

   /*BUSCAR INFORMACION POR id*/
   static public function mdlBuscarInfoDomicilio($tabla,$datos){
     $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE idUsuario = :idDomiciliarioRegistros and estado = 1");
     $stmt -> bindParam(":idDomiciliarioRegistros",$datos,PDO::PARAM_STR);
     $stmt -> execute();
     return $stmt -> fetchAll();
     $stmt -> close();
     $stmt = null;
   }

   /*BUSCAR INFORMACION POR TELEFONO*/
   static public function mdlBuscarInfoDomicilioTelefono($tabla,$datos){
     $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE nombre = :telefonoClienteBuscar");
     $stmt -> bindParam(":telefonoClienteBuscar",$datos,PDO::PARAM_STR);
     $stmt -> execute();
     return $stmt -> fetchAll();
     $stmt -> close();
     $stmt = null;
   }


  }


 ?>
