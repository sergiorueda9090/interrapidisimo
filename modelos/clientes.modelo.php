<?php

require_once "conexion.php";

class ClienteMdl{

  static public function mdlCrearCliente($tabla,$datos){

    $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(cliente,nombre,telefono1,telefono2,direccion) VALUES (:cliente,:nombre,:telefono1,:telefono2,:direccion)");

    $stmt->bindParam(":cliente",    $datos["cliente"],   PDO::PARAM_STR);
    $stmt->bindParam(":nombre",     $datos["nombre"],    PDO::PARAM_STR);
    $stmt->bindParam(":telefono1",  $datos["telefono1"], PDO::PARAM_STR);
    $stmt->bindParam(":telefono2",  $datos["telefono2"], PDO::PARAM_STR);
    $stmt->bindParam(":direccion",  $datos["direccion"], PDO::PARAM_STR);

    if($stmt->execute()){

      //return "ok";
       // Realizar una consulta para obtener el último ID insertado
       $query = "SELECT MAX(id) AS last_id FROM $tabla";
       $stmt = Conexion::conectar()->prepare($query);
       $stmt->execute();
       $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
       return $resultado['last_id'];

    }else{

      return false;

    }

    $stmt->close();

    $stmt = null;

  }

  static public function mdlCrearClienteUsuario($idCliente,$nombre,$telefono1,$telefono2,$direccion){
    
    $tabla = "clientesusuarios";

    $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(idUsuario,nombre,direccion,telefono1,telefono2) VALUES (:idUsuario,:nombre,:direccion,:telefono1,:telefono2)");

    $stmt->bindParam(":idUsuario",  $idCliente,   PDO::PARAM_STR);
    $stmt->bindParam(":nombre",     $nombre,    PDO::PARAM_STR);
    $stmt->bindParam(":direccion",  $direccion, PDO::PARAM_STR);
    $stmt->bindParam(":telefono1",  $telefono1, PDO::PARAM_STR);
    $stmt->bindParam(":telefono2",  $telefono2, PDO::PARAM_STR);
    

    if($stmt->execute()){

      return "ok";

    }else{

      return "error";

    }

    $stmt->close();

    $stmt = null;

  }

  static public function mdlMostrarClientes($tabla, $item, $valor){

    if($item != null){

      $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

      $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

      $stmt -> execute();

      return $stmt -> fetch();

    }else{

      $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

      $stmt -> execute();

      return $stmt -> fetchAll();

    }

    $stmt->close();

    $stmt = null;

  }


  static public function mdlMostrarClientesUsuarios($tabla, $item, $valor){

    if($item != null){

      $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

      $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

      $stmt -> execute();

      return $stmt -> fetchAll();

    }else{

      $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

      $stmt -> execute();

      return $stmt -> fetchAll();

    }

    $stmt->close();

    $stmt = null;

  }


  static public function mdlEditarCliente($tabla, $datos){

    $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET cliente   = :cliente, 
                                                             nombre    = :nombre,
                                                             telefono1 = :telefono1,
                                                             telefono2 = :telefono2,
                                                             direccion = :direccion 
                                          WHERE id = :id");

    $stmt->bindParam(":cliente",    $datos["cliente"],   PDO::PARAM_STR);
    $stmt->bindParam(":nombre",     $datos["nombre"],    PDO::PARAM_STR);
    $stmt->bindParam(":telefono1",  $datos["telefono1"], PDO::PARAM_STR);
    $stmt->bindParam(":telefono2",  $datos["telefono2"], PDO::PARAM_STR);
    $stmt->bindParam(":direccion",  $datos["direccion"], PDO::PARAM_STR);
    $stmt->bindParam(":id",         $datos["id"],        PDO::PARAM_INT);

    if($stmt -> execute()){

      return "ok";

    }else{

      return "error";

    }

    $stmt -> close();

    $stmt = null;

  }


  /*=============================================
  BORRAR USUARIO
  =============================================*/

  static public function mdlBorrarCliente($tabla, $datos){

    $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

    $stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

    if($stmt -> execute()){

      return "ok";

    }else{

      return "error";

    }

    $stmt -> close();

    $stmt = null;


  }

  /*=============================================
	CHOOSING CUSTOMER
	=============================================*/
  static public function mdlChoosingCustomers($table, $id){

    if($id != null){

      $stmt = Conexion::conectar()->prepare("SELECT * FROM $table WHERE id = :id");

      $stmt -> bindParam(":id", $id, PDO::PARAM_INT);

      $stmt -> execute();

      return $stmt->fetch();

    }

    $stmt->close();

    $stmt = null;

  }

  /********DELETE USERS CUSTOMER************** */
static public function mdlBorrarClienteUsuario($id){

  $stmt = Conexion::conectar()->prepare("DELETE FROM clientesusuarios WHERE idUsuario = :id");

  $stmt -> bindParam(":id", $id, PDO::PARAM_INT);

  if($stmt -> execute()){

    return true;

  }else{

    return false;

  }

  $stmt -> close();

  $stmt = null;


}

}



