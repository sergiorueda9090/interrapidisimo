<?php
require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";


require_once "../controladores/delivery.controlador.php";
require_once "../modelos/delivery.modelo.php";


class AjaxDelivery{

	/*=============================================
	CHOOSING CUSTUMER
	=============================================*/

	public $idCustomer;
	public $idDelivery;
	public $money;
	public $idCustomerUser;

	public function ajaxEditarCliente(){

  	$id = $this->idCustomer;

  	$respuesta = ClienteCtr::ctrChoosingCustomber($id);

		echo json_encode($respuesta);

	}

	public function ajaxShowDelivery(){

		$id = $this->idDelivery;

		$respuesta = DeliveryCTR::ctrShowDeliverys($id);

		echo json_encode($respuesta);

	}

	public function ajaxEditMoneyDelivery(){

		$id 		= $this->idDelivery;
		$moneyEdita = $this->money;

		$respuesta = DeliveryCTR::ctrEditMoneyDeliverys($id,$moneyEdita);

		echo json_encode($respuesta);

	}

	public function ajaxSelectUsuarioClientes(){
		$id 		= $this->idCustomerUser;
		$respuesta = DeliveryCTR::ctrShowUserCustomers($id);
		echo json_encode($respuesta);
	}


}

/*=============================================
EDITAR USUARIO
=============================================*/
if(isset($_POST["idCustomer"])){
	$show = new AjaxDelivery();
	$show->idCustomer = $_POST["idCustomer"];
	$show->ajaxEditarCliente();
}

if(isset($_POST["iddelivery"])){
	$showDelivery = new AjaxDelivery();
	$showDelivery->idDelivery = $_POST["iddelivery"];
	$showDelivery->ajaxShowDelivery();
}

if(isset($_POST["iddeliveryEditar"])){
	$editMoneyDelivery 				= new AjaxDelivery();
	$editMoneyDelivery->idDelivery 	= $_POST["iddeliveryEditar"];
	$editMoneyDelivery->money 		= $_POST["money"];
	$editMoneyDelivery->ajaxEditMoneyDelivery();
}

if(isset($_POST["idCustomerUser"])){
	$showUserClientes  = new AjaxDelivery();
	$showUserClientes->idCustomerUser 	= $_POST["idCustomerUser"];
	$showUserClientes->ajaxSelectUsuarioClientes();
}

?>
