<?php

require_once "../controladores/agregarMesa.controlador.php";
require_once "../modelos/agregarMesa.modelo.php";

require_once "../controladores/asignarMesa.controlador.php";
require_once "../modelos/asignarMesa.modelo.php";

class AjaxMesa{

	/*=============================================
	EDITAR CATEGORÍA
	=============================================*/
	public $idMesa;

	public function ajaxEditarMesa(){
		$item = 'id';
		$valor = $this->idMesa;
		$respuesta = ControladorMesa::ctrMostrarMesas($item, $valor);
		echo json_encode($respuesta);
	}

	public $idMesero;
	public $idMesaOrden;
	public $orden;
	public $total;

	/*ACTUALIZAR ORDERN*/
	public function ajaxAgrgarOrden(){

		$datos = array("idMesero" =>$this->idMesero,
									 "idMesa" => $this->idMesaOrden,
								   "orden" => $this->orden,
								 	 "total" => $this->total);

		$respuesta = AsignarMesa::ctrActualizarOrden($datos);

		echo $respuesta;

	}

	/*MOSTRAR PEDIDO*/
	public $idMeseroMostrar;
	public $idMesaMostrar;
	public $idItemEstado;

	public function ajaxMostrarPedido(){

		$datos = array("idMesero" =>$this->idMeseroMostrar,
									 "idMesa" => $this->idMesaMostrar,
								 	 "estado" => $this->$idItemEstado);

		$respuesta = AsignarMesa::ctrMostrarOrden($datos);

		echo json_encode($respuesta);

	}

	/*TRAER DESCRIPCION DE LOS PRODUCTOS*/
	public $idProducto;

	public function ajaxDescripcionProducto(){
		$valor = $this->idProducto;
		$respuesta = AsignarMesa::crtMosrarDescripcionProducto($valor);
		echo json_encode($respuesta);
	}

	/*CAMBIAR EL ESTADO DE AL ORDEN A CERO*/
	public $idImprimir;

	public function ajaxActualizarEstado(){
		$datos = array("idImprimirFactura" =>$this->idImprimir);
		$respuesta = AsignarMesa::ctrCambioEstado($datos);
		echo $respuesta;
	}

}

/*=============================================
EDITAR CATEGORÍA
=============================================*/
if(isset($_POST["idMesa"])){
	$mesa = new AjaxMesa();
	$mesa -> idMesa = $_POST["idMesa"];
	$mesa -> ajaxEditarMesa();
}

/*ACTUALIZAR ORDEN*/
if(isset($_POST["idMesero"])){
		$agregarOrden = new AjaxMesa();
		$agregarOrden -> idMesero = $_POST["idMesero"];
		$agregarOrden -> idMesaOrden = $_POST["idMesa"];
		$agregarOrden -> orden = $_POST["orden"];
		$agregarOrden -> total = $_POST["total"];
		$agregarOrden -> ajaxAgrgarOrden();
}


/*MOSTRAR PEDIDO*/
if(isset($_POST["idMeseroMostrar"])){
	$mostrarP = new AjaxMesa();
	$mostrarP -> idMeseroMostrar = $_POST["idMeseroMostrar"];
	$mostrarP -> idMesaMostrar = $_POST["idMesaMostrar"];
	$mostrarP -> idItemEstado = $_POST["idItemEstado"];
	$mostrarP -> ajaxMostrarPedido();
}

/*TRAER DESCRIPCION DE LOS PRODUCTOS*/
if(isset($_POST["idProducto"])){
	$descripcionProducto = new AjaxMesa();
	$descripcionProducto -> idProducto = $_POST["idProducto"];
	$descripcionProducto -> ajaxDescripcionProducto();
}

/*CAMBIAR EL ESTADO DE AL ORDEN A CERO*/
if(isset($_POST["idImprimir"])){
	$estado = new AjaxMesa();
 	$estado -> idImprimir = $_POST["idImprimir"];
	$estado -> ajaxActualizarEstado();
}
