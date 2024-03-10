<?php
include "config.php";
$data = file_get_contents('php://input');
$logFile = "webhooksenddata.json";
$log = fopen($logFile, "a");
fwrite($log, $data);
fclose($log);


$getData = json_decode($data, true);
$userId = 2027398274;//$getData['message']['from']['id'];
$botMessage = "Hi, there";

// Construir los parámetros de la solicitud
$parameters = array(
    "chat_id" => $userId,
    "text" => $botMessage,
    "parse_mode" => $parseMode
);

// URL de la API de Telegram para enviar mensajes
$telegramApiUrl = "https://api.telegram.org/bot{BOT_TOKEN}/sendMessage"; // Reemplaza 'TU_TOKEN' con el token de tu bot

// Inicializar cURL
$curl = curl_init($telegramApiUrl);

// Establecer opciones para la solicitud cURL
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $parameters);

// Ejecutar la solicitud cURL y almacenar la respuesta
$response = curl_exec($curl);

// Verificar si hay errores
if ($response === false) {
    $error = curl_error($curl);
    echo "Error al enviar la solicitud cURL: $error";
} else {
    echo "Mensaje enviado correctamente!";
}

// Cerrar la sesión cURL
curl_close($curl);

?>