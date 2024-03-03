<?php

require_once "controladores/plantilla.controlador.php";
require_once "controladores/usuarios.controlador.php";
require_once "controladores/categorias.controlador.php";
require_once "controladores/delivery.controlador.php";
require_once "controladores/reportDelivery.controlador.php";

/********************START*************************/
require_once "controladores/productos.controlador.php";
require_once "controladores/clientes.controlador.php";
require_once "controladores/ventas.controlador.php";
require_once "controladores/mesas.controlador.php";
require_once "controladores/agregarMesa.controlador.php";
require_once "controladores/asignarMesa.controlador.php";
require_once "controladores/domicilio.controlador.php";
require_once "controladores/tarjetas.controladores.php";
require_once "controladores/gastos.controladores.php";
/********************END*************************/


require_once "modelos/usuarios.modelo.php";
require_once "modelos/categorias.modelo.php";
require_once "modelos/delivery.modelo.php";
require_once "modelos/reportDelivery.modelo.php";


/********************START*************************/
require_once "modelos/productos.modelo.php";
require_once "modelos/clientes.modelo.php";
require_once "modelos/ventas.modelo.php";
require_once "modelos/mesas.modelo.php";
require_once "modelos/agregarMesa.modelo.php";
require_once "modelos/asignarMesa.modelo.php";
require_once "modelos/domicilio.modelo.php";
require_once "modelos/tarjetas.modelo.php";
require_once "modelos/gastos.modelo.php";
/********************END*************************/

//require_once "extensiones/PHPMailer/PHPMailerAutoload.php";
require_once "extensiones/vendor/autoload.php";

$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();
