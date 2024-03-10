<?php
require_once "../controladores/reportDelivery.controlador.php";
require_once "../modelos/reportDelivery.modelo.php";


class AjaxReportDelivery{

	/*=============================================
	CHOOSING CUSTUMER
	=============================================*/

	public $idCustomer;
	public $fecha_inicio;
	public $fecha_fin;
	public $cliente;
	public $mensajero;

	public function ajaxShowReportDelivery(){

		$id = $this->idCustomer;

		$respuesta = ReportDeliveryCtr::ctrShowReportDeliverys($id);

		echo json_encode($respuesta);

	}

	public function ajaxFilterListReportsDeliverys(){
		$fecha_inicio = $this->fecha_inicio;
		$fecha_fin    = $this->fecha_fin;
		$cliente      = $this->cliente;
		$mensajero    = $this->mensajero;
		$respuesta    = ReportDeliveryCtr::ctrFilterListReportsDeliverys($fecha_inicio,$fecha_fin,$mensajero,$cliente);
		echo json_encode($respuesta);
	}


}

/*=============================================
EDITAR USUARIO
=============================================*/
if(isset($_POST["idUsuario"])){
	$show = new AjaxReportDelivery();
	$show->idCustomer = $_POST["idUsuario"];
	$show->ajaxShowReportDelivery();
}

if(isset($_POST["fechaInicio"]) || isset($_POST["fechaFin"]) || isset($_POST["mensajero"]) || isset($_POST["cliente"])){
	$filter = new AjaxReportDelivery();
	$filter->fecha_inicio 	= $_POST["fechaInicio"]  ?? null;
	$filter->fecha_fin 		= $_POST["fechaFin"] 	 ?? null;
	$filter->mensajero 		= $_POST["mensajero"] 	 ?? null;
	$filter->cliente  		= $_POST["cliente"]    	 ?? null;
	$filter->ajaxFilterListReportsDeliverys();
}


?>
