<?php

// Token de tu bot de Telegram
$botToken = '7022150351:AAGhcgNl6YY2CAupmhyXUw4cGcnUSPJk0Vg'; // Reemplaza 'TU_TOKEN' con el token de tu bot

// Números de teléfono a los que enviarás los mensajes
$phoneNumbers = [
    '+573143801560', // Reemplaza '+1234567890' con el número de teléfono al que quieras enviar el mensaje
];

// Mensaje que deseas enviar
$message = 'Hola desde PHP! Este es un mensaje enviado desde PHP a través de mi bot de Telegram.';

// Configura la solicitud para enviar el mensaje a través del bot de Telegram
$apiUrl = 'https://api.telegram.org/bot' . $botToken . '/sendMessage';
foreach ($phoneNumbers as $phoneNumber) {
    $params = [
        'chat_id' => $phoneNumber,
        'text' => $message
    ];

    // Inicializa una sesión CURL
    $ch = curl_init($apiUrl);

    // Configura las opciones CURL
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Ejecuta la solicitud
    $result = curl_exec($ch);

    // Verifica si hubo algún error
    if(curl_errno($ch)) {
        echo 'Error al enviar mensaje a ' . $phoneNumber . ': ' . curl_error($ch);
    } else {
        echo 'Mensaje enviado a ' . $phoneNumber . ' con éxito.<br>';
    }

    // Cierra la sesión CURL
    curl_close($ch);
}
