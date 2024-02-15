<?php

  require_once "../../../extensiones/excel/PHPExcel-1.8/Classes/PHPExcel.php";
  require_once "../../../controladores/ventas.controlador.php";
  require_once "../../../modelos/ventas.modelo.php";

  if(isset($_GET["fechaInicial"])){
    $fechaInicial = $_GET["fechaInicial"];
    $fechaFinal = $_GET["fechaFinal"];
  }else{
    $fechaInicial = null;
    $fechaFinal = null;
  }


  $respuesta = Reportes::ctrExcel($fechaInicial,$fechaFinal);
  $respustaGastos =Reportes::ctrExcelGastos($fechaInicial,$fechaFinal);


  $objPHPExcel = new PHPExcel();

  $objPHPExcel->getProperties()
  ->setCreator('Reportes de ventas')
  ->setDescription('Documento de ventas');

  $objPHPExcel->setActiveSheetIndex(0);
  $objPHPExcel->getActiveSheet()->setTitle('Ventas');
  $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
  $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
  $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(50);
  $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
  $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(26);
  $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(26);
  $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(26);
  $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(26);
  $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(26);
  $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(26);
  $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(26);
  $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(26);

  $objPHPExcel->getActiveSheet()->setCellValue('A1', 'FECHAS');
  $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Nombre Domiciliario');
  $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Nombre Cliente');
  $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Telefono');
  $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Direccion');
  $objPHPExcel->getActiveSheet()->setCellValue('F1', 'Direccion Destino');
  $objPHPExcel->getActiveSheet()->setCellValue('G1', 'Precion Domicilio');
  $objPHPExcel->getActiveSheet()->setCellValue('H1', 'Porcentaje Descuento');
  $objPHPExcel->getActiveSheet()->setCellValue('I1', 'Precio Descuento Domicilio');
  $objPHPExcel->getActiveSheet()->setCellValue('J1', 'FORMA DE PAGO');
  $objPHPExcel->getActiveSheet()->setCellValue('K1', 'SUB-TOTAL');
  $objPHPExcel->getActiveSheet()->setCellValue('L1', 'TOTAL');



  $estiloTituloColumnas = array(
    'font' => array(
  	'name'  => 'Arial',
  	'bold'  => true,
  	'size' =>10,
  	'color' => array(
  	'rgb' => 'FFFFFF'
	)
    ),
    'fill' => array(
  	'type' => PHPExcel_Style_Fill::FILL_SOLID,
  	'color' => array('rgb' => '538DD5')
    ),
    'borders' => array(
  	'allborders' => array(
  	'style' => PHPExcel_Style_Border::BORDER_THIN
	)
    ),
    'alignment' =>  array(
  	'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
  	'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER
    )
	);

  $estiloTituloColumnasDomicilios = array(
    'font' => array(
    'name'  => 'Arial',
    'bold'  => true,
    'size' =>10,
    'color' => array(
    'rgb' => 'FFFFFF'
    )
    ),
    'fill' => array(
    'type' => PHPExcel_Style_Fill::FILL_SOLID,
    'color' => array('rgb' => 'FFC107')
    ),
    'borders' => array(
    'allborders' => array(
    'style' => PHPExcel_Style_Border::BORDER_THIN
    )
    ),
      'alignment' =>  array(
    'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
    'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER
      )
  );

  $estiloInformacion = new PHPExcel_Style();
	$estiloInformacion->applyFromArray( array(
    'font' => array(
	'name'  => 'Arial',
	'color' => array(
	'rgb' => '000000'
	)
    ),
    'fill' => array(
	'type'  => PHPExcel_Style_Fill::FILL_SOLID
	),
    'borders' => array(
	'allborders' => array(
	'style' => PHPExcel_Style_Border::BORDER_THIN
	)
    ),
	'alignment' =>  array(
	'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER
    )
	));

  $objPHPExcel->getActiveSheet()->getStyle('A1:L1')->applyFromArray($estiloTituloColumnas);
  $n = 4;
  foreach ($respuesta as $key => $value) {
    $objPHPExcel->getActiveSheet()->setCellValue('A'.($key+2), $value["fechaDomicilio"]);
    $objPHPExcel->getActiveSheet()->setCellValue('B'.($key+2), $value["nombreUsuario"]);
    $objPHPExcel->getActiveSheet()->setCellValue('C'.($key+2),$value["nombreDomiciliario"]);
    $objPHPExcel->getActiveSheet()->setCellValue('D'.($key+2), $value["telefono"]);
    $objPHPExcel->getActiveSheet()->setCellValue('E'.($key+2), $value["direccion"]);
    $objPHPExcel->getActiveSheet()->setCellValue('F'.($key+2), $value["direccionDestino"]);
    $objPHPExcel->getActiveSheet()->setCellValue('G'.($key+2), number_format($value["precioDomicilio"]));
    $objPHPExcel->getActiveSheet()->setCellValue('H'.($key+2), $value["porcentajeDescuento"].'%');
    $objPHPExcel->getActiveSheet()->setCellValue('I'.($key+2), number_format($value["precioDescuento"]));
    $objPHPExcel->getActiveSheet()->setCellValue('J'.($key+2), $value["formaDepago"]);
    $n++;
  }
    $objPHPExcel->getActiveSheet()->setCellValue('K'.($key+2), number_format($value["subtotal"]));
    $objPHPExcel->getActiveSheet()->setCellValue('L'.($key+2), number_format($value["total"]));


    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(60);
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);


    $objPHPExcel->getActiveSheet()->setCellValue('A'.($n), 'FECHA DEL GASTO');
    $objPHPExcel->getActiveSheet()->setCellValue('B'.($n), 'DESCRIPCION DEL GASTO');
    $objPHPExcel->getActiveSheet()->setCellValue('C'.($n), 'VALOR DEL GASTO');


      $estiloTituloColumnas = array(
        'font' => array(
      	'name'  => 'Arial',
      	'bold'  => true,
      	'size' =>10,
      	'color' => array(
      	'rgb' => 'FFFFFF'
    	)
        ),
        'fill' => array(
      	'type' => PHPExcel_Style_Fill::FILL_SOLID,
      	'color' => array('rgb' => '538DD5')
        ),
        'borders' => array(
      	'allborders' => array(
      	'style' => PHPExcel_Style_Border::BORDER_THIN
    	)
        ),
        'alignment' =>  array(
      	'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
      	'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER
        )
    	);

      $estiloTituloColumnasDomicilios = array(
        'font' => array(
        'name'  => 'Arial',
        'bold'  => true,
        'size' =>10,
        'color' => array(
        'rgb' => 'FFFFFF'
        )
        ),
        'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => 'FFC107')
        ),
        'borders' => array(
        'allborders' => array(
        'style' => PHPExcel_Style_Border::BORDER_THIN
        )
        ),
          'alignment' =>  array(
        'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER
          )
      );

      $estiloInformacion = new PHPExcel_Style();
    	$estiloInformacion->applyFromArray( array(
        'font' => array(
    	'name'  => 'Arial',
    	'color' => array(
    	'rgb' => '000000'
    	)
        ),
        'fill' => array(
    	'type'  => PHPExcel_Style_Fill::FILL_SOLID
    	),
        'borders' => array(
    	'allborders' => array(
    	'style' => PHPExcel_Style_Border::BORDER_THIN
    	)
        ),
    	'alignment' =>  array(
    	'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
    	'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER
        )
    	));

    $objPHPExcel->getActiveSheet()->getStyle('A'.$n.':'.'C'.$n)->applyFromArray($estiloTituloColumnas);
    $n = $n+1;
    foreach ($respustaGastos as $keydos => $valueGasto) {
      $objPHPExcel->getActiveSheet()->setCellValue('A'.($keydos+$n), $valueGasto["fechaGasto"]);
      $objPHPExcel->getActiveSheet()->setCellValue('B'.($keydos+$n), $valueGasto["nombreGasto"]);
      $objPHPExcel->getActiveSheet()->setCellValue('C'.($keydos+$n), number_format($valueGasto["valorGasto"]));
    }



  header('Content-Type: application/vnd.ms-excel');
  header('Content-Disposition: attachment;filename="Excel.xls"');
  header('Cache-Control: max-age=0');

  $objWrite = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
  $objWrite->save('php://output');


?>
