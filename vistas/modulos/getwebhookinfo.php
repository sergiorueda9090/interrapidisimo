<h1 style="background:white; text-align:center;">
<?php

include "config.php";
$apiUrl = "https://api.telegram.org/bot{$BOT_TOKEN}/getWebhookInfo";
$response = file_get_contents($apiUrl);
echo $response;
?>

</h1>