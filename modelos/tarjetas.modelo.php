<?php

require_once "conexion.php";

class TarjetasModel{

  static public function mdlUsuario($tablaUsuario){
    $stmt = Conexion::conectar()->prepare("SELECT * FROM $tablaUsuario");
    $stmt -> execute();
    return $stmt -> fetchAll();
    $stmt -> close();
    $stmt = null;
  }

  static public function mdlTarjetas($fechaInicial,$fechaFinal,$tablaDomicilios,$id){

    if($fechaInicial == null){

$stmt = Conexion::conectar()->prepare("SELECT nombre,telefono,direccion,zona,
                                              idUsuario,barrio,precioDomicilio,
                                              precioDescuento,porcentajeDescuento,estado,
                                              fecha,precioDomicilio,
                                      (SELECT SUM(precioDomicilio) FROM $tablaDomicilios WHERE idUsuario = $id) as total,
                                      (SELECT SUM(precioDescuento) FROM $tablaDomicilios WHERE idUsuario = $id) as subTotal
                                       FROM $tablaDomicilios WHERE idUsuario = $id");

      $stmt -> execute();

      return $stmt -> fetchAll();

  }else if($fechaInicial == $fechaFinal){

    $stmt = Conexion::conectar()->prepare("SELECT nombre,telefono,direccion,zona,
                                                  idUsuario,barrio,precioDomicilio,
                                                  precioDescuento,porcentajeDescuento,estado,
                                                  fecha,precioDomicilio,
                                          (SELECT SUM(precioDomicilio) FROM $tablaDomicilios WHERE idUsuario = $id and $tablaDomicilios.fecha like '%$fechaFinal%') as total,
                                          (SELECT SUM(precioDescuento) FROM $tablaDomicilios WHERE idUsuario = $id and $tablaDomicilios.fecha like '%$fechaFinal%') as subTotal
                                           FROM $tablaDomicilios WHERE idUsuario = $id and $tablaDomicilios.fecha like '%$fechaFinal%'");

  $stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

  $stmt -> execute();

  return $stmt -> fetchAll();

}else{

  $fechaActual = new DateTime();
  $fechaActual ->add(new DateInterval("P1D"));
  $fechaActualMasUno = $fechaActual->format("Y-m-d");

  $fechaFinal2 = new DateTime($fechaFinal);
  $fechaFinal2 ->add(new DateInterval("P1D"));
  $fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

  if($fechaFinalMasUno == $fechaActualMasUno){

    $stmt = Conexion::conectar()->prepare("SELECT nombre,telefono,direccion,zona,
                                                  idUsuario,barrio,precioDomicilio,
                                                  precioDescuento,porcentajeDescuento,estado,
                                                  fecha,precioDomicilio,
                                           (SELECT SUM(precioDomicilio) FROM $tablaDomicilios WHERE idUsuario = $id and $tablaDomicilios.fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno') as total,
                                           (SELECT SUM(precioDescuento) FROM $tablaDomicilios WHERE idUsuario = $id and $tablaDomicilios.fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno') as subTotal
                                            FROM $tablaDomicilios WHERE idUsuario = $id and $tablaDomicilios.fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");


   }else{

     $stmt = Conexion::conectar()->prepare("SELECT nombre,telefono,direccion,zona,
                                                   idUsuario,barrio,precioDomicilio,
                                                   precioDescuento,porcentajeDescuento,estado,
                                                   fecha,precioDomicilio,
                                            (SELECT SUM(precioDomicilio) FROM $tablaDomicilios WHERE idUsuario = $id and $tablaDomicilios.fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno') as total,
                                            (SELECT SUM(precioDescuento) FROM $tablaDomicilios WHERE idUsuario = $id and $tablaDomicilios.fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno') as subTotal
                                             FROM $tablaDomicilios WHERE idUsuario = $id and $tablaDomicilios.fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

    }

    $stmt -> execute();

    return $stmt -> fetchAll();

}

$stmt -> close();

$stmt = null;

  }

}


 ?>
