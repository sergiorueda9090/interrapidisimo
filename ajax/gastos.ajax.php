<?php

require_once "../controladores/gastos.controladores.php";
require_once "../modelos/gastos.modelo.php";

class AjaxGasto{
	/*=============================================
	EDITAR CLIENTE
	=============================================*/
	public $idGasto;
	public function ajaxEditarGasto(){
		$item = "idGastos";
		$valor = $this->idGasto;
		$respuesta = ControladorGasto::ctrMostrarGasto($item, $valor);
		echo json_encode($respuesta);
	}
}

/*=============================================
EDITAR CLIENTE
=============================================*/
if(isset($_POST["idGasto"])){
	$cliente = new AjaxGasto();
	$cliente -> idGasto = $_POST["idGasto"];
	$cliente -> ajaxEditarGasto();
}
