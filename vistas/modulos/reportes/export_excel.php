<?php
// Definir el nombre del archivo y el tipo de contenido
$filename = "excel_file.csv";
header('Content-Type: application/csv');
header('Content-Disposition: attachment; filename="' . $filename . '";');

// Abrir la salida como un archivo CSV
$output = fopen('php://output', 'w');

// Escribir los datos en el archivo CSV
$data = array(
    array('Hello', 'World!'),
    array('Good', 'Morning'),
);

foreach ($data as $row) {
    fputcsv($output, $row);
}

// Cerrar el archivo CSV
fclose($output);