<?php
require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";

class AjaxClientes{

	/*=============================================
	EDITAR USUARIO
	=============================================*/

	public $idCliente;

	public function ajaxEditarCliente(){

  	$item = "id";

  	$valor = $this->idCliente;

  	$respuesta = ClienteCtr::ctrMostrarClientes($item,$valor);

		echo json_encode($respuesta);

	}


}

/*=============================================
EDITAR USUARIO
=============================================*/
if(isset($_POST["idCliente"])){
	$editar = new AjaxClientes();
	$editar -> idCliente = $_POST["idCliente"];
	$editar -> ajaxEditarCliente();
}

?>
