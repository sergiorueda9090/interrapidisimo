<?php

require_once "conexion.php";

class DeliveryMdl{

  static public function mdlClistDelivery($table, $id){

    if($id != null){

			$stmt = Conexion::conectar()->prepare("SELECT $table.*, clientes.nombre, clientes.telefono1, clientes.telefono2, clientes.direccion, 
                                            usuarios.nombre as nombreDomiciliario FROM $table 
                                            INNER JOIN clientes ON $table.idCustomer = clientes.id
                                            INNER JOIN usuarios ON $table.idDomiciliary = usuarios.id WHERE $table.id = :id");

			$stmt -> bindParam(":id", $id, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT $table.*, clientes.nombre, clientes.telefono1, clientes.telefono2, clientes.direccion,
                                            usuarios.nombre as nombreDomiciliario FROM $table 
                                            INNER JOIN clientes ON $table.idCustomer = clientes.id
                                            INNER JOIN usuarios ON $table.idDomiciliary = usuarios.id");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}


		$stmt -> close();

		$stmt = null;
  }
	/*=============================================
	SHOW CUSTOMER
	=============================================*/
    static public function mdlListClientes($table){

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $table");
        $stmt -> execute();
        return $stmt->fetchAll();
        $stmt -> close();
        $stmt = null;

    }

    /*=============================================
	CREATE DELIVERY
   =============================================*/
   static public function mdlCreateDelivery($table, $datos){

    $stmt = Conexion::conectar()->prepare("INSERT INTO $table(idCustomer,idDomiciliary,type,typeOfPay,selectPayMethod,pickupAddress,newAddress,destinationAddress,note,deliveryPraci,paymentProcess,userCreate,idUserCustomer) VALUES (:idCustomer,:idDomiciliary,:type,:typeOfPay,:selectPayMethod,:pickupAddress,:newAddress,:destinationAddress,:note,:deliveryPraci,:paymentProcess,:userCreate,:idUserCustomer)");

      $stmt->bindParam(":idCustomer",         $datos["idCustomer"],           PDO::PARAM_INT);
      $stmt->bindParam(":idDomiciliary",      $datos["idDomiciliary"],        PDO::PARAM_INT);
      $stmt->bindParam(":type",               $datos["type"],                 PDO::PARAM_STR);
      $stmt->bindParam(":typeOfPay",          $datos["typeOfPay"],            PDO::PARAM_STR);
      $stmt->bindParam(":selectPayMethod",    $datos["selectPayMethod"],      PDO::PARAM_STR);
      $stmt->bindParam(":pickupAddress",      $datos["pickupAddress"],        PDO::PARAM_STR);
      $stmt->bindParam(":newAddress",         $datos["newAddress"],           PDO::PARAM_STR);
      $stmt->bindParam(":destinationAddress", $datos["destinationAddress"],   PDO::PARAM_STR);
      $stmt->bindParam(":note",               $datos["note"],                 PDO::PARAM_STR);
      $stmt->bindParam(":deliveryPraci",      $datos["deliveryPraci"],        PDO::PARAM_STR);
      $stmt->bindParam(":paymentProcess",     $datos["money"],                PDO::PARAM_STR);
      $stmt->bindParam(":userCreate",         $datos["idUser"],               PDO::PARAM_INT);
      $stmt->bindParam(":idUserCustomer",     $datos["idUserCustomer"],       PDO::PARAM_STR);

    if($stmt->execute()){

      return "ok";

    }else{

      return "error";

    }

    $stmt->close();

    $stmt = null;

   }

  /*=============================================
	UPDATE DELIVERY
   =============================================*/
   static public function mdlEditarDelivery($table, $datos){

    $stmt = Conexion::conectar()->prepare("UPDATE $table SET idDomiciliary = :idDomiciliary, type = :type, typeOfPay = :typeOfPay, selectPayMethod = :selectPayMethod, pickupAddress = :pickupAddress, newAddress = :newAddress, destinationAddress = :destinationAddress, note = :note, deliveryPraci = :deliveryPraci, paymentProcess = :paymentProcess, userCreate = :userCreate, idUserCustomer = :idUserCustomer WHERE id = :id");

    $stmt->bindParam(":idDomiciliary",      $datos["idDomiciliary"],        PDO::PARAM_INT);
    $stmt->bindParam(":type",               $datos["type"],                 PDO::PARAM_STR);
    $stmt->bindParam(":typeOfPay",          $datos["typeOfPay"],            PDO::PARAM_STR);
    $stmt->bindParam(":selectPayMethod",    $datos["selectPayMethod"],      PDO::PARAM_STR);
    $stmt->bindParam(":pickupAddress",      $datos["pickupAddress"],        PDO::PARAM_STR);
    $stmt->bindParam(":newAddress",         $datos["newAddress"],           PDO::PARAM_STR);
    $stmt->bindParam(":destinationAddress", $datos["destinationAddress"],   PDO::PARAM_STR);
    $stmt->bindParam(":note",               $datos["note"],                 PDO::PARAM_STR);
    $stmt->bindParam(":deliveryPraci",      $datos["deliveryPraci"],        PDO::PARAM_STR);
    $stmt->bindParam(":paymentProcess",     $datos["money"],                PDO::PARAM_STR);
    $stmt->bindParam(":userCreate",         $datos["idUser"],               PDO::PARAM_INT);
    $stmt->bindParam(":id",                 $datos["id"],                   PDO::PARAM_INT);
    $stmt->bindParam(":idUserCustomer",     $datos["idUserCustomer"],       PDO::PARAM_STR);

    if($stmt->execute()){
        return "ok";
    }else{
        return "error";
    }

    $stmt->close();
    $stmt = null;
}

	/*=============================================
	BORRAR DELIVERY
	=============================================*/

	static public function mdlBorrarDelivery($tabla, $datos){

    $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

    $stmt->bindParam(":id", $datos, PDO::PARAM_INT);
    
    if($stmt->execute()){
        return "ok";
    } else {
        return "error";
    }

    

		$stmt -> close();

		$stmt = null;


	}

    /*=============================================
	  UPDATE MONEY
   =============================================*/
   static public function mdlEditMoneyDelivery($table, $id, $moneyEdita){

    $stmt = Conexion::conectar()->prepare("UPDATE $table SET  paymentProcess = :paymentProcess WHERE id = :id");
    $stmt->bindParam(":id",             $id,          PDO::PARAM_INT);
    $stmt->bindParam(":paymentProcess", $moneyEdita,  PDO::PARAM_STR);

    if($stmt->execute()){
        return "ok";
    }else{
        return "error";
    }

    $stmt->close();
    $stmt = null;
}

	/*=============================================
	SHOW USERS CUSTOMER
	=============================================*/
  static public function mdlShowUserCustomers($table, $id){
    $stmt = Conexion::conectar()->prepare("SELECT * FROM $table WHERE idUsuario = :id");
    $stmt->bindParam(":id", $id, PDO::PARAM_STR);
    $stmt -> execute();
    return $stmt->fetchAll();
    $stmt -> close();
    $stmt = null;
}

}