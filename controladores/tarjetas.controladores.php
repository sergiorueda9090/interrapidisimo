<?php

 class Tarjetas{

   static public function ctrUsuario(){
     $tablaUsuario = "usuarios";
     $respuesta = TarjetasModel::mdlUsuario($tablaUsuario);
     return $respuesta;

   }

   static public function ctrTarjetas($fechaInicial,$fechaFinal,$id){

     $tablaDomicilios = "domicilios";

     $respuesta = TarjetasModel::mdlTarjetas($fechaInicial,$fechaFinal,$tablaDomicilios,$id);

     return $respuesta;

   }

 }


?>
