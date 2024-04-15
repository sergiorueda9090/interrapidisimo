<?php
// Evitar salida adicional antes de las cabeceras
ob_clean();

require_once "../../../controladores/reportDelivery.controlador.php";
require_once "../../../modelos/reportDelivery.modelo.php";

// Obtener los parámetros GET si están presentes
$fechaInicio = isset($_GET['fechaInicio']) ? $_GET['fechaInicio'] : null;
$fechaFin = isset($_GET['fechaFin']) ? $_GET['fechaFin'] : null;
$mensajero = isset($_GET['mensajero']) ? $_GET['mensajero'] : null;
$cliente = isset($_GET['cliente']) ? $_GET['cliente'] : null;

// Definir el nombre del archivo
$filename = "archivo_excel.xlsx";

// Configurar las cabeceras para indicar que el contenido es un archivo de Excel
header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header("Content-Disposition: attachment; filename=\"$filename\"");

// Obtener los datos de la base de datos
$deliverys = ReportDeliveryCtr::ctrFilterListReportsDeliverys($fechaInicio, $fechaFin, $mensajero, $cliente);

// Comenzar a construir el contenido del archivo Excel
$data = "Mensajero\tCliente\tUsuario\tTipo de pago\tMetodo de pago\tEstado del dinero\tNota\tValor\tFecha\n";

// Recorrer los resultados y agregarlos al contenido del archivo Excel
foreach ($deliverys as $value) {
    $data .= $value["nombre"] . "\t";
    $data .= $value["nombreCliente"] . "\t";
    $data .= $value["cliente"] . "\t";
    $data .= ucfirst(strtolower($value["type"])) . "\t";
    $data .= ucfirst(strtolower($value["selectPayMethod"])) . "\t";
    if ($value["paymentProcess"] == "enproceso") {
        $data .= "En proceso\t";
    } else {
        $data .= $value['paymentProcess'] . "\t";
    }
    $data .= $value["note"] . "\t";
    $data .= $value["deliveryPraci"] . "\t";
    $data .= $value["dateCrate"] . "\n";
}

// Escribir el contenido en el archivo de salida
echo $data;

// Finalizar la ejecución del script
exit;
?>
