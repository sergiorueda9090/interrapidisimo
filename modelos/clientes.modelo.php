<?php

require_once "conexion.php";

class ClienteMdl{

  static public function mdlCrearCliente($tabla,$datos){

    $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre,telefono,direccion) VALUES (:nombre,:telefono,:direccion)");

    $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
    $stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
    $stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);

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


  static public function mdlEditarCliente($tabla, $datos){

    $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, direccion = :direccion, telefono = :telefono WHERE id = :id");

    $stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
    $stmt -> bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
    $stmt -> bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
    $stmt -> bindParam(":id", $datos["id"], PDO::PARAM_STR);

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

}
