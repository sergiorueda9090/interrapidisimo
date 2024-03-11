<?php

$data = file_get_contents('php://input');
$logFile = "webhooksenddata.json";
$log = fopen($logFile, "a");
fwrite($log, $data);
fclose($log);



// Obtener el contenido del mensaje entrante
$content = file_get_contents("php://input");
$update = json_decode($content, true);

// Verificar si se recibió un mensaje y si tiene información del chat
if (isset($update['message']) && isset($update['message']['chat']) && isset($update['message']['chat']['id'])) {
    // Obtener los datos del chat
    $chatData = $update['message']['chat'];

    // Guardar los datos del chat en la base de datos
    guardarChat($chatData);
}

// Función para guardar los datos del chat en la base de datos
function guardarChat($chatData) {
    // Conexión a la base de datos (cambiar los valores según tu configuración)
    $servername = "localhost";
    $username = "example_user";
    $password = "password";
    $database = "example_database";

    $conn = new mysqli($servername, $username, $password, $database);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Obtener los datos del chat
    $chatId = $chatData['id'];
    $firstName = $chatData['first_name'];
    $lastName = isset($chatData['last_name']) ? $chatData['last_name'] : '';


    // Preparar la consulta SQL para insertar los datos del chat en la tabla 'chats'
    $sql = "INSERT INTO telegram (chat_id, first_name, last_name) VALUES (?, ?, ?)";
    
    // Preparar la declaración
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $chatId, $firstName, $lastName);

    // Ejecutar la consulta SQL
    if ($stmt->execute()) {
        echo "Los datos del chat se han guardado correctamente en la base de datos.";
    } else {
        echo "Error al guardar los datos del chat en la base de datos: " . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();
}
