<?php
require_once "../controladores/reportDelivery.controlador.php";
require_once "../modelos/reportDelivery.modelo.php";


class AjaxReportDelivery{

	/*=============================================
	CHOOSING CUSTUMER
	=============================================*/

	public $idCustomer;

	public function ajaxShowReportDelivery(){

		$id = $this->idCustomer;

		$respuesta = ReportDeliveryCtr::ctrShowReportDeliverys($id);

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


?>
