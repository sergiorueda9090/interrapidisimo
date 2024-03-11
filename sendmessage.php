<?php

// Token de tu bot de Telegram
$botToken = '7022150351:AAGhcgNl6YY2CAupmhyXUw4cGcnUSPJk0Vg';

// Función para enviar un mensaje por Telegram a un usuario específico
function enviarMensajeTelegram($userId, $mensaje) {
    global $botToken;
    $url = "https://api.telegram.org/bot$botToken/sendMessage";
    $params = array(
        'chat_id' => $userId,
        'text' => $mensaje
    );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $resultado = curl_exec($ch);
    curl_close($ch);
    return $resultado;
}


$usuariosMensajes = array(
    '2027398274' => 'Hola, usuario 1. Este es tu mensaje personalizado.',
    '6350913805' => 'Hola, usuario 2. Este es tu mensaje personalizado.'
);

// Bucle para enviar los mensajes por Telegram a cada usuario
foreach ($usuariosMensajes as $userId => $mensaje) {
    // Enviar el mensaje por Telegram
    enviarMensajeTelegram($userId, $mensaje);
}

?>
