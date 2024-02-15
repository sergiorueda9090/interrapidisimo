<?php

class Reportes{

  static public function ctrVentas($fechaInicial,$fechaFinal){
    $tabla = 'domicilios';
    $respuesta = ReportesMdl::mdlVentas($tabla,$fechaInicial,$fechaFinal);
    return $respuesta;
  }

  /*=======================================
   VENDEDORES TOTAL
  ======================================*/
  static public function ctrTotalVendedores($fechaInicial,$fechaFinal){
    $tablaDomicilios = 'domicilios';
    $tablaUsuarios = 'usuarios';
    $respuesta = ReportesMdl::mdlTotalVendedores($tablaDomicilios,$tablaUsuarios,$fechaInicial,$fechaFinal);
    return $respuesta;
  }


  /*====================================
   GRAFICO DE VENTAS EN DOMICILIOS
  ====================================*/
  static public function ctrVentasDomicilios($fechaInicial,$fechaFinal){
    $tablaDomicilios = 'domicilios';
    $respuesta = ReportesMdl::mdlVentasDomicilios($tablaDomicilios,$fechaInicial,$fechaFinal);
    return $respuesta;
  }


  /*=======================================
   DOMICILIOS TOTAL
  ======================================*/
  static public function ctrTotalDomicilios($fechaInicial,$fechaFinal){
    $tablaDomicilios = 'domicilios';
    $tablaUsuarios = 'usuarios';
    $respuesta = ReportesMdl::mdlTotalDomicilios($tablaDomicilios,$tablaUsuarios,$fechaInicial,$fechaFinal);
    return $respuesta;
  }

  /*=========================================
  DESCARGAR EXCEL
  ===========================================*/
  static public function ctrExcel($fechaInicial,$fechaFinal){
    $tablaMesa = 'asignarMesa';
    $tablaUsuarios = 'usuarios';
    $respuesta = ReportesMdl::mdlExcel($tablaMesa,$tablaUsuarios,$fechaInicial,$fechaFinal);
    return $respuesta;
  }

  static public function ctrExcelDomicilios($fechaInicial,$fechaFinal){
    $tablaDomicilios = 'domicilios';
    $tablaUsuarios = 'usuarios';
    $respuesta = ReportesMdl::mdlExcelDomicilios($tablaDomicilios,$tablaUsuarios,$fechaInicial,$fechaFinal);
    return $respuesta;
  }

  /*==============================================
  REPORTE EXCEL GASTOS
  ==================================================*/
  static public function ctrExcelGastos($fechaInicial,$fechaFinal){
    $respuesta = ReportesMdl::mdlExcelGastos($fechaInicial,$fechaFinal);
    return $respuesta;
  }

}
