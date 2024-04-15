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
                                              d.dateCrate,d.note,d.type, cu.nombre as cunombre
                                              FROM delviery AS d INNER JOIN usuarios u on u.id = d.idDomiciliary
                                              INNER JOIN clientes c on c.id = d.idCustomer
                                              LEFT JOIN clientesusuarios cu ON cu.id = d.idUserCustomer");

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
	FILTER LIST DELIVERY 
	=============================================*/
  static public function mdlFilterlistReportDelivery($fecha_inicio=null,$fecha_fin=null,$mensajero=null,$cliente=null){

    $fecha_inicio = $fecha_inicio === '' ? null : $fecha_inicio;
    $fecha_fin    = $fecha_fin    === '' ? null : $fecha_fin;
    $cliente      = $cliente      === '' ? null : $cliente;
    $mensajero    = $mensajero    === '' ? null : $mensajero;

    // Preparar la consulta base
      $sql = "SELECT d.id, u.id as idUsuario, 
              c.nombre as nombreCliente, c.cliente,
              u.nombre, d.selectPayMethod, d.pickupAddress, d.newAddress,
              d.destinationAddress, d.deliveryPraci, d.paymentProcess,
              d.dateCrate,d.note,d.type
              FROM delviery AS d 
              INNER JOIN usuarios u ON u.id = d.idDomiciliary
              INNER JOIN clientes c ON c.id = d.idCustomer";

      if($fecha_inicio == null &&  $fecha_fin == null && $cliente == null && $mensajero == null) {

      }else{
        $sql .= " WHERE ";
      }
      // Construir la condición de fecha si $fecha_inicio no es NULL
      if ($fecha_inicio !== null) {
          $fecha_inicio .= " 00:00:00";
          
          if($fecha_fin == null){
            $fecha_fin = $fecha_inicio;
          }

          $fecha_fin .= " 23:59:59";
          $sql .= "d.dateCrate BETWEEN :fecha_inicio AND :fecha_fin";
      }

      // Construir la condición de cliente si $cliente no es NULL
      if ($cliente !== null) {

          if($fecha_inicio == null){
            $sql .= "c.id = :cliente";
          }else{
             $sql .= " AND c.id = :cliente";
          }
          
      }

      // Construir la condición de mensajero si $mensajero no es NULL
      if ($mensajero !== null) {
        
        if($fecha_inicio == null){

          if($cliente !== null){
             $sql .= " AND u.id = :mensajero";
          }else{
            $sql .= "u.id = :mensajero";
          }
        
        }else{
          $sql .= " AND u.id = :mensajero";
        }
  
      }

      // Finalizar la consulta con el ordenamiento
      $sql .= " ORDER BY d.dateCrate, c.nombre, u.nombre";

      // Preparar la consulta
      $stmt = Conexion::conectar()->prepare($sql);

      // Asignar valores a los parámetros según corresponda
      if ($fecha_inicio !== null) {
        $stmt->bindParam(':fecha_inicio', $fecha_inicio);
        $stmt->bindParam(':fecha_fin', $fecha_fin);
      }
      if ($cliente !== null) {
        $stmt->bindParam(':cliente', $cliente);
      }
      if ($mensajero !== null) {
        $stmt->bindParam(':mensajero', $mensajero);
      }

      // Ejecutar la consulta
      $stmt->execute();

      // Obtener los resultados
      return $stmt->fetchAll();

    /*if($fecha_inicio != nulL){
      $fecha_inicio = $fecha_inicio." 00:00:00";
      $fecha_fin = $fecha_fin." 23:59:59";
      $stmt = Conexion::conectar()->prepare("SELECT d.id, u.id as idUsuario, 
                                      c.nombre as nombreCliente, c.cliente,
                                      u.nombre, d.selectPayMethod, d.pickupAddress, d.newAddress,
                                      d.destinationAddress, d.deliveryPraci, d.paymentProcess,
                                      d.dateCrate,d.note,d.type
                                      FROM delviery AS d 
                                      INNER JOIN usuarios u ON u.id = d.idDomiciliary
                                      INNER JOIN clientes c ON c.id = d.idCustomer
                                      WHERE (:fecha_inicio IS NULL OR d.dateCrate >= :fecha_inicio)
                                      AND (:fecha_fin IS NULL OR d.dateCrate <= :fecha_fin)
                                      ORDER BY d.dateCrate, c.nombre, u.nombre");
    }


    // Asignar valores a los parámetros
    $stmt->bindParam(':fecha_inicio', $fecha_inicio);
    $stmt->bindParam(':fecha_fin', $fecha_fin);
    //$stmt->bindParam(':cliente', $cliente);
    //$stmt->bindParam(':mensajero', $mensajero);

    // Ejecutar la consulta
    $stmt->execute();

    // Obtener los resultados
    return $stmt -> fetchAll();*/
  
  }



}