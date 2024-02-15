<?php
require_once "../controladores/domicilio.controlador.php";
require_once "../modelos/domicilio.modelo.php";

class ajaxDomicilio{

  public $telefonoCliente;
  public $nombreCliente;
  public $direccionCliente;
  public $usuarioCliente;
  public $total;
  public $domicilio;
  public $direccionDestino;
  public $selectFormaPago;

  public function agregarDomicilio(){
    $datos = array("telefonoCliente"=>$this->telefonoCliente,
                 "nombreCliente"=>$this->nombreCliente,
                 "direccionCliente"=>$this->direccionCliente,
                 "seleccionarPedidoDomi"=>$this->seleccionarPedidoDomi,
                 "seleccionarBarrio"=>$this->seleccionarBarrio,
                 "precioDomicilio"=>$this->precioDomicilio,
                 "idDomiciliario"=>$this->idDomiciliario,
                 "precioDomicilioOculto"=>$this->precioDomicilioOculto,
                 "porcentajeDomicilio"=>$this->porcentajeDomicilio,
                 "direccionDestino"=>$this->direccionDestino,
                 "selectFormaPago"=>$this->selectFormaPago);


    $respuesta = DomicilioCtr::ctrAgregarDomicilio($datos);
    echo $respuesta;
  }

  /*CAMBIAR EL ESTADO DEL DOMICILIO*/
  public $idDomicilio;
  public function cambioEstado(){
    $item = $this->idDomicilio;
    $respuesta = DomicilioCtr::ctrcambioEstado($item);
    echo $respuesta;
  }

  /*SELECCIONAR DOMICILIO PARA EDITAR*/
  public $idEditarDomicilio;
  public function editarDomicilio(){
    $item = $this->idEditarDomicilio;
    $respuesta = DomicilioCtr::ctrEditarDomicilio($item);
    echo json_encode($respuesta);
  }

  /*ACTUALIZAR DOMICILIO*/
  public $idEditardomicilio;
  public $telefonoClienteEditar;
  public $nombreClienteEditar;
  public $direccionClienteEditar;
  public $usuarioClienteEditar;
  public $totalEditar;
  public $domicilioEditar;

  public function actualizarDomicilio(){

    $datos = array("idEditardomicilio"=>$this->idEditardomicilio,
                   "telefonoClienteEditar"=>$this->telefonoClienteEditar,
                   "nombreClienteEditar"=>$this->nombreClienteEditar,
                   "direccionClienteEditar"=>$this->direccionClienteEditar,
                   "usuarioClienteEditar"=>$this->usuarioClienteEditar,
                   "totalEditar"=>$this->totalEditar,
                   "domicilioEditar"=>$this->domicilioEditar);

    $respuesta = DomicilioCtr::ctrActualizarDomicilio($datos);

    echo $respuesta;

  }

  public $idDomiciliarioRegistros;
  public function buscarInfoDomicilio(){
    $datos = $this->idDomiciliarioRegistros;
    $respuesta = DomicilioCtr::ctrBuscarInfoDomicilio($datos);
    echo json_encode($respuesta);
  }

  public $telefonoClienteBuscar;
  public function buscarInfoDomicilioTelefono(){
    $datos = $this->telefonoClienteBuscar;
    $respuesta = DomicilioCtr::ctrBuscarInfoDomicilioTelefono($datos);
    echo json_encode($respuesta);
  }

}

/*AGREGAR DOMICILIO*/
if(isset($_POST["telefonoCliente"])){
  $agregar = new ajaxDomicilio();
  $agregar -> telefonoCliente = $_POST["telefonoCliente"];
  $agregar -> nombreCliente = $_POST["nombreCliente"];
  $agregar -> direccionCliente = $_POST["direccionCliente"];
  $agregar -> seleccionarPedidoDomi = $_POST["seleccionarPedidoDomi"];
  $agregar -> seleccionarBarrio = $_POST["seleccionarBarrio"];
  $agregar -> precioDomicilio = $_POST["precioDomicilio"];
  $agregar -> idDomiciliario = $_POST["idDomiciliario"];
  $agregar -> precioDomicilioOculto = $_POST["precioDomicilioOculto"];
  $agregar -> porcentajeDomicilio = $_POST["porcentajeDomicilio"];
  $agregar -> direccionDestino = $_POST["direccionDestino"];
  $agregar -> selectFormaPago = $_POST["selectFormaPago"];
  $agregar -> agregarDomicilio();
}

/*CAMBIAR EL ESTADO DEL DOMICILIO*/
if(isset($_POST["idDomicilio"])){
    $estado = new ajaxDomicilio();
    $estado -> idDomicilio = $_POST["idDomicilio"];
    $estado -> cambioEstado();
}

/*SELECCIONAR DOMICILIO PARA EDITAR*/
if(isset($_POST["idEditarDomicilio"])){
    $editar = new ajaxDomicilio();
    $editar -> idEditarDomicilio = $_POST["idEditarDomicilio"];
    $editar -> editarDomicilio();
}

/*ACTUALIZAR DOMICILIO*/
if(isset($_POST["idEditardomicilio"])){
  $actualizar = new ajaxDomicilio();
  $actualizar -> idEditardomicilio = $_POST["idEditardomicilio"];
  $actualizar -> telefonoClienteEditar = $_POST["telefonoClienteEditar"];
  $actualizar -> nombreClienteEditar = $_POST["nombreClienteEditar"];
  $actualizar -> direccionClienteEditar = $_POST["direccionClienteEditar"];
  $actualizar -> usuarioClienteEditar = $_POST["usuarioClienteEditar"];
  $actualizar -> totalEditar = $_POST["totalEditar"];
  $actualizar -> domicilioEditar = $_POST["domicilioEditar"];
  $actualizar -> actualizarDomicilio();
}

/*BUSCAR INFORMACION POR ID*/
if(isset($_POST["idDomiciliarioRegistros"])){
  $infoTelfono = new ajaxDomicilio();
  $infoTelfono -> idDomiciliarioRegistros = $_POST["idDomiciliarioRegistros"];
  $infoTelfono -> buscarInfoDomicilio();
}

/*BUSCAR INFORMACION POR NUMERO*/
if(isset($_POST["telefonoClienteBuscar"])){
  $infoTelfono = new ajaxDomicilio();
  $infoTelfono -> telefonoClienteBuscar = $_POST["telefonoClienteBuscar"];
  $infoTelfono -> buscarInfoDomicilioTelefono();
}

?>
