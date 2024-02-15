<?php

  require_once "conexion.php";

  class AsignarMesaModel{

    /*ASIGNAR MESA Y MESERO*/
    static public function mdlAsigarMesa($tabla,$datos){

      $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (idMesa,idMesero,estado,nombreCliente,numeroCliente,fechaCliente) VALUES (:idMesa,:idMesero,:estado,:nombreCliente,:numeroCliente,:fechaCliente)");
      $stmt -> bindParam(":idMesa",$datos["idMesaAsignada"],PDO::PARAM_STR);
      $stmt -> bindParam(":idMesero",$datos["idPersona"],PDO::PARAM_STR);
      $stmt -> bindParam(":estado", $datos["estado"],PDO::PARAM_STR);
      $stmt -> bindParam(":nombreCliente",$datos["nombreCliente"],PDO::PARAM_STR);
      $stmt -> bindParam(":numeroCliente",$datos["numeroCliente"],PDO::PARAM_STR);
      $stmt -> bindParam(":fechaCliente", $datos["fechaReserva"],PDO::PARAM_STR);

      if($stmt -> execute()){
            return "ok";
      }else{
            return "error";
      }

      $stmt -> close();
      $stmt =null;

    }

    /*TRAER NOMBRES DE LOS MESEROS DEPENDIENDO DE LA MESA ASIGNADA*/
    static public function mdlNombreMeseros($tablaUsuarios,$tablaAsignarMesa,$id){

      $stmt = Conexion::conectar()->prepare("SELECT $tablaUsuarios.nombre,$tablaUsuarios.foto,$tablaAsignarMesa.idMesa,$tablaAsignarMesa.idMesero,$tablaAsignarMesa.orden,$tablaAsignarMesa.totalMesa,$tablaAsignarMesa.estado,$tablaAsignarMesa.id  FROM $tablaUsuarios
                                             INNER JOIN $tablaAsignarMesa on $tablaAsignarMesa.idMesero = $tablaUsuarios.id
                                             WHERE idMesa = :idMesa");

      $stmt -> bindParam(":idMesa",$id,PDO::PARAM_STR);

      $stmt -> execute();

      return $stmt -> fetchAll();

      $stmt -> close();

      $stmt = null;


    }

    /*MOSTRAR INFORMACION DEL LOS MESEROS EN LAS MESAS*/
    static public function mdlMostrarInformacionMesero($tabla,$id){

      $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id = :id");

      $stmt -> bindParam(":id",$id,PDO::PARAM_STR);

      $stmt -> execute();

      return $stmt -> fetchAll();

      $stmt -> close();

      $stmt = null;

    }

    /*ACTUALIZAR ORDEN*/
    static public function mdlActualizarOrden($tabla,$datos){

      $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET orden = :orden, totalMesa = :totalMesa WHERE idMesa = :idMesa AND idMesero = :idMesero AND estado = 1");
      $stmt -> bindParam(":orden",$datos["orden"],PDO::PARAM_STR);
      $stmt -> bindParam(":idMesa",$datos["idMesa"],PDO::PARAM_STR);
      $stmt -> bindParam(":idMesero",$datos["idMesero"],PDO::PARAM_STR);
      $stmt -> bindParam(":totalMesa",$datos["total"],PDO::PARAM_STR);

      if($stmt -> execute()){
          return "ok";
      }else{
          return "error";
      }

      $stmt -> close();

      $stmt = null;

    }

    /*MOSTRAR ORDEN*/
   static public function mdlMostrarOrden($tabla,$datos){

     $stmt = Conexion::conectar()->prepare("SELECT orden FROM $tabla WHERE idMesa = :idMesa AND idMesero = :idMesero AND estado = 1");

     $stmt -> bindParam(":idMesa",$datos["idMesa"],PDO::PARAM_STR);
     $stmt -> bindParam(":idMesero",$datos["idMesero"],PDO::PARAM_STR);

     $stmt -> execute();

     return $stmt -> fetch();

     $stmt -> close();

     $stmt = null;

   }

   /*SELECCIONAMOS TODOS LOS PRODUCTO DEPENDIENTO DE SU CATEGORIA*/
   static public function mdlMostrarProductosCategorias($tabla,$id){

     $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_categoria = :id");

     $stmt -> bindParam(":id",$id,PDO::PARAM_STR);

     $stmt -> execute();

     return $stmt -> fetchAll();

     $stmt -> close();

     $stmt = null;

   }

   /*SELECCIONAR DESCRIPCION DEL PRODUCTO A COMPRAR*/
   static public function mdlMosrarDescripcionProducto($tabla,$valor){

     $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id = :id");

     $stmt -> bindParam(":id",$valor,PDO::PARAM_STR);

     $stmt -> execute();

     return $stmt -> fetch();

     $stmt -> close();

     $stmt = null;

   }


   /*IMPRIMIR FACTURA*/
  static public function mdlImprimirFactura($tabla,$datos){

    $stmt = Conexion::conectar()->prepare("SELECT usuarios.nombre AS nombreDomiciliario,domicilios.nombre as nombreCliente,
                                                  domicilios.precioDomicilio, domicilios.selectFormaPago,domicilios.fecha,
                                                  (SELECT SUM(precioDomicilio) FROM domicilios WHERE idUsuario = :id and estado = 1) as total,
                                                  (SELECT SUM(precioDescuento) FROM domicilios WHERE idUsuario = :id and estado = 1) as subTotal
                                                  FROM domicilios INNER JOIN usuarios on usuarios.id = domicilios.idUsuario
                                                  WHERE idUsuario = :id and domicilios.estado = 1");

    $stmt -> bindParam(":id",$datos,PDO::PARAM_STR);

    $stmt -> execute();

    return $stmt -> fetchAll();

    $stmt -> close();

    $stmt = null;

  }

  /*IMPRIMIR FACTURA UNA*/
 static public function mdlImprimirFacturaUna($tabla,$datos){

   $stmt = Conexion::conectar()->prepare("SELECT usuarios.nombre as nombreUsuario,domicilios.nombre as nombreMensajero,
                                                 telefono,direccion,precioDomicilio,
                                                 selectFormaPago,precioDomicilio,precioDescuento,
                                                 domicilios.fecha as fechaDomi,direccionDestino
                                          FROM domicilios
                                          INNER JOIN usuarios on usuarios.id = domicilios.idUsuario
                                          WHERE domicilios.id = :id and domicilios.estado = 1");

   $stmt -> bindParam(":id",$datos,PDO::PARAM_STR);

   $stmt -> execute();

   return $stmt -> fetchAll();

   $stmt -> close();

   $stmt = null;

 }

  /*CAMBIAR EL ESTADO DE AL ORDEN A 0*/
  static public function mdlCambioEstado($tabla,$datos){

    $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estado = 0 WHERE idUsuario = :id");

    $stmt -> bindParam(":id",$datos["idImprimirFactura"],PDO::PARAM_STR);

    if($stmt -> execute()){

      return "ok";

    }else{

        return "error";
    }

      $stmt -> close();

      $stmt = null;


  }

  /*ELIMINAR ORDEN*/
  static public function mdlEliminarOrden($tabla,$datos){

    $stmt = Conexion::conectar()->prepare("DELETE FROM `asignarMesa` WHERE id = :id");

    $stmt -> bindParam(":id",$datos["id"],PDO::PARAM_STR);

    if($stmt -> execute()){

      return "ok";

    }else{

      return "error";

    }

    $stmt -> close();

    $stmt = null;

  }

  }

 ?>
