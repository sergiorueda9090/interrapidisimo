<?php

require_once "../../../controladores/agregarMesa.controlador.php";
require_once "../../../modelos/agregarMesa.modelo.php";

require_once '../../../controladores/asignarMesa.controlador.php';
require_once '../../../modelos/asignarMesa.modelo.php';

class imprimirFactura{

public $codigo;

public function traerImpresionFactura(){
date_default_timezone_set("America/America/Bogota");
$hoy = date("Y-m-d H:i:s");

$item = "codigo";
$valor = $this->codigo;

$respuesta = AsignarMesa::ctrImprimirFactura($valor);

$datos = array("idImprimirFactura" =>$valor);
$respuestaAjax = AsignarMesa::ctrCambioEstado($datos);

$nombre = $respuesta[0]["nombreDomiciliario"];

$totalDomi = number_format($respuesta[0]["total"]);
$subTotal = number_format($respuesta[0]["subTotal"]);

$pagarContratista = number_format($respuesta[0]["total"]-$respuesta[0]["subTotal"]);

$fecha = substr($respuesta["fecha"],0,-8);
$productos = json_decode($respuesta["orden"],true);
$total = number_format($respuesta["totalMesa"]);

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
//$pdf->SetAutoPageBreak(true);
$pdf->SetAutoPageBreak(TRUE, 0);
$pdf->AddPage('P', 'A7');

//---------------------------------------------------------

$bloque1 = <<<EOF

<table style="font-size:7px; text-align:left">
<tr>
<td style="width:260px;">
<div>
<img src="../../../vistas/img/plantilla/logoCrono.jpeg" width="100" height="100">
<br>
TIRILLA DE PAGO
<br>
Nit: 901.048.668-5
<br>
Fecha: $hoy
<br>
PBX 6451371
<br>
PBX 3227370033
<br>
Contratista
<br>
$nombre
<br>
</div>
</td>
</tr>
</table>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

// ---------------------------------------------------------
foreach ($respuesta as $key => $value) {
$precioDomi = number_format($value["precioDomicilio"]);
$bloque3 = <<<EOF
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 0.5px solid #dddddd;
  text-align: left;
  padding: 1px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
<table style="font-size:7px; text-align:left">
<tr>
<td style="width:260px;">
<div>
Cliente: $value[nombreCliente]
<br>
Precio: $precioDomi
<br>
Pago: $value[selectFormaPago]
</div>
</td>
</tr>
</table>
EOF;
$pdf->writeHTML($bloque3, false, false, false, false, '');
}


$bloque4 = <<<EOF
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 0.5px solid #dddddd;
  text-align: left;
  padding: 1px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
			<table style="font-size:7px; text-align:left">
			<tr>
           <th scope="row">Total Ventas:</th>
					   <td class="text-center">
                $totalDomi
				     </td>
			</tr>

			<tr>
           <th scope="row">Comision:</th>
					   <td class="text-center">
                $subTotal
				     </td>
			</tr>
			   <hr>
				 <tr>
	            <th scope="row">Total a pagar Contratante:</th>
	 					   <td class="text-center">
	                 0
	 				     </td>
	 			</tr>
				<tr>
						 <th scope="row">Total a pagar Contratista:</th>
							<td class="text-center">
									$pagarContratista
							</td>
			 </tr>
			</table>
EOF;


$pdf->writeHTML($bloque4, false, false, false, false, '');



// ---------------------------------------------------------
//SALIDA DEL ARCHIVO

//$pdf->Output('factura.pdf', 'D');
$pdf->Output('factura.pdf');

}
}

$factura = new imprimirFactura();
$factura -> codigo = $_GET["codigo"];
$factura -> traerImpresionFactura();

?>
