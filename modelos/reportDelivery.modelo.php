<?php

require_once "conexion.php";

class RportDeliveryMdl{

  static public function mdlListReportDelivery($id){

    if($id != null){

			$stmt = Conexion::conectar()->prepare("SELECT d.id, u.id as idUsuario, 
                                            c.nombre as nombreCliente, c.cliente,
                                            u.nombre, d.selectPayMethod, d.pickupAddress, d.newAddress,
                                            d.destinationAddress, d.deliveryPraci, d.paymentProcess, d.dateCrate 
                                            FROM delviery AS d INNER JOIN usuarios u on u.id = d.idDomiciliary
                                            INNER JOIN clientes c on c.id = d.idCustomer WHERE u.id = :id");

			$stmt -> bindParam(":id", $id, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT d.id, u.id as idUsuario, 
                                              c.nombre as nombreCliente, c.cliente,
                                              u.nombre, d.selectPayMethod, d.pickupAddress, d.newAddress,
                                              d.destinationAddress, d.deliveryPraci, d.paymentProcess,
                                              d.dateCrate,d.note,d.type
                                              FROM delviery AS d INNER JOIN usuarios u on u.id = d.idDomiciliary
                                              INNER JOIN clientes c on c.id = d.idCustomer");

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




}