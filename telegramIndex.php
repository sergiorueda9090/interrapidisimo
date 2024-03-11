<?php
$data = file_get_contents('php://input');
$logFile = "webhooksenddata.json";
$log = fopen($logFile, "a");
fwrite($log, $data);
fclose($log);


// Obtener los datos recibidos del webhook de Telegram
$content = file_get_contents('php://input');
$update = json_decode($content, true);

// Verificar si se recibió un mensaje y si tiene información del remitente
if (isset($update['message']) && isset($update['message']['from'])) {
    // Obtener la información del remitente
    $from = $update['message']['from'];
    $firstName = $from['first_name'];
    $lastName = $from['last_name'];
    $phoneNumber = $from['phone_number'];
    
    // Crear un array con la información esencial y el número telefónico
    $userData = array(
        'first_name' => $firstName,
        'last_name' => $lastName,
        'phone_number' => $phoneNumber
    );

    // Convertir el array a formato JSON
    $jsonUserData = json_encode($userData);
    
    // Escribir el JSON en el archivo "telefono.json"
    file_put_contents('telefono.json', $jsonUserData);
}
?>