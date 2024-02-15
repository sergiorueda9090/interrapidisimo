<?php

require_once '../../../controladores/asignarMesa.controlador.php';
require_once '../../../modelos/asignarMesa.modelo.php';

class imprimirFactura{

public $idDomicilio;

public function traerImpresionFactura(){

$item = "idDomicilio";
$valor = $this->idDomicilio;
$respuesta = AsignarMesa::ctrImprimirFacturaUna($valor);
$nombreT = $respuesta[0]["nombreMensajero"];
$direccionT = $respuesta[0]["direccion"];
$telefonoT = $respuesta[0]["telefono"];
$direccionDestino = $respuesta[0]["direccionDestino"];
$selectFormaPagoT = $respuesta[0]["selectFormaPago"];

$fechaHora = $respuesta[0]['fechaDomi'];
$nombre = $respuesta[0]["nombreUsuario"];

$totalDomi = number_format($respuesta[0]["precioDomicilio"]);
$subTotal = number_format($respuesta[0]["precioDescuento"]);

$pagarContratista = number_format($respuesta[0]["precioDomicilio"]-$respuesta[0]["precioDescuento"]);

$fecha = substr($respuesta["fecha"],0,-8);


require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$PDF_MARGIN_LEFT = 0;
$PDF_MARGIN_TOP = 0;
$PDF_MARGIN_RIGHT = 0;
$pdf->SetMargins($PDF_MARGIN_LEFT, $PDF_MARGIN_TOP, $PDF_MARGIN_RIGHT);
//LTRB
$PDF_MARGIN_HEADER = 0;
$PDF_MARGIN_FOOTER = 0;
$pdf->SetHeaderMargin($PDF_MARGIN_HEADER);
$pdf->SetFooterMargin($PDF_MARGIN_FOOTER);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetAutoPageBreak(TRUE, 0);
$pdf->AddPage('P', 'A7');


//---------------------------------------------------------

$bloque1 = <<<EOF

<table style="font-size:9.5px; text-align:left">
<tr>
<td style="width:160px;">
<div>
<img src="../../../vistas/img/plantilla/logoCrono.jpeg" width="100" height="100">
<br>
TIRILLA DE PAGO
<br>
Nit: 901.048.668-5
<br>
Fecha: $fechaHora
<br>
PBX 6451371
<br>
PBX 3227370033
<br>
Contratista
<br>
Mensajero:$nombre
<br>
CLIENTE:$nombreT
<br>
Direccion:$direccionT
<br>
Direccion Destino:$direccionDestino
<br>
Telefono:$telefonoT
<br>
Pago:$selectFormaPagoT
<br>
T.Pagar:$totalDomi
</div>
</td>
</tr>
</table>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

// ---------------------------------------------------------
// ----------------------------------------

// ---------------------------------------------------------
//SALIDA DEL ARCHIVO

//$pdf->Output('factura.pdf', 'D');
$pdf->Output('factura.pdf');

}
}

$factura = new imprimirFactura();
$factura -> idDomicilio = $_GET["idDomicilio"];
$factura -> traerImpresionFactura();

?>
