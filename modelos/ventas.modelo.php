<?php

require_once "conexion.php";

class ReportesMdl{

  static public function mdlVentas($tabla, $fechaInicial, $fechaFinal){

     if($fechaInicial == null){

         $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

         $stmt ->execute();

         return $stmt ->fetchAll();

      }else if($fechaInicial == $fechaFinal){

         $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha like '%$fechaFinal%'");

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

           $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

        }else{

           $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinal'");

       }

           $stmt -> execute();

           return $stmt -> fetchAll();

       }
     }

     /*=======================================
      VENDEDORES TOTAL
     ======================================*/
     static public function mdlTotalVendedores($tablaDomicilios,$tablaUsuarios,$fechaInicial,$fechaFinal){

    if($fechaInicial == null){

      $stmt = Conexion::conectar()->prepare("SELECT $tablaDomicilios.idUsuario,sum($tablaDomicilios.precioDomicilio) AS total,$tablaUsuarios.nombre
                                             FROM $tablaDomicilios INNER JOIN $tablaUsuarios ON
                                             $tablaUsuarios.id = $tablaDomicilios.idUsuario GROUP BY($tablaDomicilios.idUsuario)");
        $stmt ->execute();

        return $stmt ->fetchAll();

    }else if($fechaInicial == $fechaFinal){

      $stmt = Conexion::conectar()->prepare("SELECT $tablaDomicilios.idUsuario,sum($tablaDomicilios.precioDomicilio) AS total,$tablaUsuarios.nombre
                                             FROM $tablaDomicilios INNER JOIN $tablaUsuarios ON
                                             $tablaUsuarios.id = $tablaDomicilios.idUsuario WHERE $tablaDomicilios.fecha like '%$fechaFinal%' GROUP BY($tablaDomicilios.idUsuario)");

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

          $stmt = Conexion::conectar()->prepare("SELECT $tablaDomicilios.idUsuario,sum($tablaDomicilios.precioDomicilio) AS total,$tablaUsuarios.nombre
                                                    FROM $tablaDomicilios INNER JOIN $tablaUsuarios ON
                                                    $tablaUsuarios.id = $tablaDomicilios.idUsuario WHERE $tablaDomicilios.fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' GROUP BY($tablaDomicilios.idUsuario)");


      }else{

        $stmt = Conexion::conectar()->prepare("SELECT $tablaDomicilios.idUsuario,sum($tablaDomicilios.precioDomicilio) AS total,$tablaUsuarios.nombre
                                                  FROM $tablaDomicilios INNER JOIN $tablaUsuarios ON
                                                  $tablaUsuarios.id = $tablaDomicilios.idUsuario WHERE $tablaDomicilios.fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' GROUP BY($tablaDomicilios.idUsuario)");

      }

          $stmt -> execute();

          return $stmt -> fetchAll();

      }

      $stmt -> close();
      $stmt = null;

     }

     /*====================================
      GRAFICO DE VENTAS EN DOMICILIOS
     ====================================*/
     static public function mdlVentasDomicilios($tablaDomicilios, $fechaInicial, $fechaFinal){

        if($fechaInicial == null){

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tablaDomicilios WHERE estado = 0");

            $stmt ->execute();

            return $stmt ->fetchAll();

         }else if($fechaInicial == $fechaFinal){

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tablaDomicilios WHERE fecha like '%$fechaFinal%' AND estado = 0");

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

              $stmt = Conexion::conectar()->prepare("SELECT * FROM $tablaDomicilios WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' AND estado = 0");

           }else{

              $stmt = Conexion::conectar()->prepare("SELECT * FROM $tablaDomicilios WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinal' AND estado = 0");

          }

              $stmt -> execute();

              return $stmt -> fetchAll();

          }
        }

     /*=======================================
      DOMICILIOS TOTAL
     ======================================*/
     static public function mdlTotalDomicilios($tablaDomicilios,$tablaUsuarios,$fechaInicial,$fechaFinal){

    if($fechaInicial == null){

      $stmt = Conexion::conectar()->prepare("SELECT $tablaDomicilios.idUsuario,$tablaUsuarios.nombre, SUM($tablaDomicilios.total) AS totalDomicilios FROM $tablaDomicilios
                                             INNER JOIN $tablaUsuarios ON $tablaDomicilios.idUsuario = $tablaUsuarios.id WHERE $tablaDomicilios.estado = 0
                                             GROUP BY ($tablaDomicilios.idUsuario)");
        $stmt ->execute();

        return $stmt ->fetchAll();

    }else if($fechaInicial == $fechaFinal){



      $stmt = Conexion::conectar()->prepare("SELECT $tablaDomicilios.idUsuario,$tablaUsuarios.nombre, SUM($tablaDomicilios.total) AS totalDomicilios FROM $tablaDomicilios
                                             INNER JOIN $tablaUsuarios ON $tablaDomicilios.idUsuario = $tablaUsuarios.id WHERE $tablaDomicilios.estado = 0
                                             AND $tablaDomicilios.fecha like '%$fechaFinal%' GROUP BY($tablaDomicilios.idUsuario)");


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

          $stmt = Conexion::conectar()->prepare("SELECT $tablaDomicilios.idUsuario,$tablaUsuarios.nombre, SUM($tablaDomicilios.total) AS totalDomicilios FROM $tablaDomicilios
                                                 INNER JOIN $tablaUsuarios ON $tablaDomicilios.idUsuario = $tablaUsuarios.id WHERE $tablaDomicilios.estado = 0
                                                 AND $tablaDomicilios.fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'
                                                 GROUP BY($tablaDomicilios.idUsuario)");


      }else{

        $stmt = Conexion::conectar()->prepare("SELECT $tablaDomicilios.idUsuario,$tablaUsuarios.nombre, SUM($tablaDomicilios.total) AS totalDomicilios FROM $tablaDomicilios
                                               INNER JOIN $tablaUsuarios ON $tablaDomicilios.idUsuario = $tablaUsuarios.id WHERE $tablaDomicilios.estado = 0
                                               AND $tablaDomicilios.fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'
                                               GROUP BY($tablaDomicilios.idUsuario)");

      }

          $stmt -> execute();

          return $stmt -> fetchAll();

      }

      $stmt -> close();
      $stmt = null;

     }


     /*==================================
      DESCARGAR REPORTE EN EXCEL
     ===================================*/
     static public function mdlExcel($tablaMesa,$tablaUsuarios,$fechaInicial, $fechaFinal){

        if($fechaInicial == null){

            $stmt = Conexion::conectar()->prepare("SELECT usuarios.nombre as nombreUsuario,domicilios.nombre as nombreDomiciliario,
                                                         domicilios.telefono,
                                                         domicilios.direccion,domicilios.direccionDestino,
                                                         domicilios.precioDomicilio,domicilios.precioDescuento,
                                                         domicilios.porcentajeDescuento,
                                                         domicilios.fecha as fechaDomicilio,
                                                         domicilios.selectFormaPago as formaDepago,
                                                         (SELECT SUM(precioDomicilio) FROM domicilios) as total,
                                                         (SELECT SUM(precioDescuento) FROM domicilios) AS subtotal
                                                  FROM domicilios
                                                  INNER JOIN usuarios on usuarios.id = domicilios.idUsuario");


            $stmt ->execute();

            return $stmt ->fetchAll();

         }else if($fechaInicial == $fechaFinal){

            $stmt = Conexion::conectar()->prepare("SELECT usuarios.nombre as nombreUsuario,domicilios.nombre as nombreDomiciliario,
                                                         domicilios.telefono,
                                                         domicilios.direccion,domicilios.direccionDestino,
                                                         domicilios.precioDomicilio,domicilios.precioDescuento,
                                                         domicilios.porcentajeDescuento,
                                                         domicilios.fecha as fechaDomicilio,
                                                         domicilios.selectFormaPago as formaDepago,
                                                         (SELECT SUM(precioDomicilio) FROM domicilios WHERE fecha like '%$fechaFinal%') as total,
                                                         (SELECT SUM(precioDescuento) FROM domicilios WHERE fecha like '%$fechaFinal%') AS subtotal
                                                  FROM domicilios
                                                  INNER JOIN usuarios on usuarios.id = domicilios.idUsuario
                                                  WHERE domicilios.fecha like '%$fechaFinal%'");

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

              $stmt = Conexion::conectar()->prepare("SELECT usuarios.nombre as nombreUsuario,domicilios.nombre as nombreDomiciliario,
                                                           domicilios.telefono,
                                                           domicilios.direccion,domicilios.direccionDestino,
                                                           domicilios.precioDomicilio,domicilios.precioDescuento,
                                                           domicilios.porcentajeDescuento,
                                                           domicilios.fecha as fechaDomicilio,
                                                           domicilios.selectFormaPago as formaDepago,
                                                           (SELECT SUM(precioDomicilio) FROM domicilios WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno') as total,
                                                           (SELECT SUM(precioDescuento) FROM domicilios WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno') AS subtotal
                                                    FROM domicilios
                                                    INNER JOIN usuarios on usuarios.id = domicilios.idUsuario
                                                    WHERE domicilios.fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

           }else{

              $stmt = Conexion::conectar()->prepare("SELECT usuarios.nombre as nombreUsuario,domicilios.nombre as nombreDomiciliario,
                                                           domicilios.telefono,
                                                           domicilios.direccion,domicilios.direccionDestino,
                                                           domicilios.precioDomicilio,domicilios.precioDescuento,
                                                           domicilios.porcentajeDescuento,
                                                           domicilios.fecha as fechaDomicilio,
                                                           domicilios.selectFormaPago as formaDepago,
                                                           (SELECT SUM(precioDomicilio) FROM domicilios WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno') as total,
                                                           (SELECT SUM(precioDescuento) FROM domicilios WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno') AS subtotal
                                                    FROM domicilios
                                                    INNER JOIN usuarios on usuarios.id = domicilios.idUsuario
                                                    WHERE domicilios.fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");
          }

              $stmt -> execute();

              return $stmt -> fetchAll();

          }
        }


      static public function mdlExcelDomicilios($tablaDomicilios,$tablaUsuarios,$fechaInicial,$fechaFinal){

       if($fechaInicial == null){

        $stmt = Conexion::conectar()->prepare("SELECT $tablaDomicilios.idUsuario,$tablaDomicilios.nombre AS cliente,$tablaDomicilios.telefono,$tablaDomicilios.orden,$tablaDomicilios.total,$tablaDomicilios.fecha,$tablaUsuarios.nombre FROM $tablaDomicilios
                                                INNER JOIN $tablaUsuarios ON $tablaDomicilios.idUsuario = $tablaUsuarios.id WHERE $tablaDomicilios.estado = 0");
        $stmt ->execute();

        return $stmt ->fetchAll();

       }else if($fechaInicial == $fechaFinal){



         $stmt = Conexion::conectar()->prepare("SELECT $tablaDomicilios.idUsuario,$tablaDomicilios.nombre AS cliente,$tablaDomicilios.telefono,$tablaDomicilios.orden,$tablaDomicilios.total,$tablaDomicilios.fecha,$tablaUsuarios.nombre FROM $tablaDomicilios
                                                INNER JOIN $tablaUsuarios ON $tablaDomicilios.idUsuario = $tablaUsuarios.id WHERE $tablaDomicilios.estado = 0
                                                AND $tablaDomicilios.fecha like '%$fechaFinal%'");


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

             $stmt = Conexion::conectar()->prepare("SELECT $tablaDomicilios.idUsuario,$tablaDomicilios.nombre AS cliente,$tablaDomicilios.telefono,$tablaDomicilios.orden,$tablaDomicilios.total,$tablaDomicilios.fecha,$tablaUsuarios.nombre FROM $tablaDomicilios
                                                    INNER JOIN $tablaUsuarios ON $tablaDomicilios.idUsuario = $tablaUsuarios.id WHERE $tablaDomicilios.estado = 0
                                                    AND $tablaDomicilios.fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");


         }else{

           $stmt = Conexion::conectar()->prepare("SELECT $tablaDomicilios.idUsuario,$tablaDomicilios.nombre AS cliente,$tablaDomicilios.telefono,$tablaDomicilios.orden,$tablaDomicilios.total,$tablaDomicilios.fecha,$tablaUsuarios.nombre FROM $tablaDomicilios
                                                  INNER JOIN $tablaUsuarios ON $tablaDomicilios.idUsuario = $tablaUsuarios.id WHERE $tablaDomicilios.estado = 0
                                                  AND $tablaDomicilios.fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

         }

             $stmt -> execute();

             return $stmt -> fetchAll();

         }

         $stmt -> close();
         $stmt = null;

        }

        /*==============================================
        REPORTE EXCEL GASTOS
        ==================================================*/
        static public function mdlExcelGastos($fechaInicial,$fechaFinal){

          if($fechaInicial == null){

           $stmt = Conexion::conectar()->prepare("SELECT * FROM gastos");

           $stmt ->execute();

           return $stmt ->fetchAll();

          }else if($fechaInicial == $fechaFinal){

              $stmt = Conexion::conectar()->prepare("SELECT * FROM gastos WHERE fechaGasto = like '%$fechaFinal%'");


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

                $stmt = Conexion::conectar()->prepare("SELECT * FROM gastos WHERE fechaGasto BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");


            }else{

              $stmt = Conexion::conectar()->prepare("SELECT * FROM gastos WHERE fechaGasto BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

            }

                $stmt -> execute();

                return $stmt -> fetchAll();

            }

            $stmt -> close();
            $stmt = null;

        }




   }
