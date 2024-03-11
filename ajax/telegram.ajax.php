<?php
require_once "../controladores/telegram.controlador.php";
require_once "../modelos/telegram.modelo.php";

class AjaxTelegram{

	public $username;
    public $idTelegram;

	public function ajaxEditarTelegram(){

        $username   = $this->username;
        $idTelegram = $this->idTelegram;

        $respuesta = ctrTelegram::ctrUpdateTelegram($username, $idTelegram);

        echo json_encode($respuesta);

	}

}

/*=============================================
EDITAR USUARIO
=============================================*/
if(isset($_POST["username"])){
	$show = new AjaxTelegram();
	$show->username = $_POST["username"];
    $show->idTelegram = $_POST["idTelegram"];
	$show->ajaxEditarTelegram();
}


?>
