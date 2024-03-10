<h1 style="background:white; text-align:center;">
<?php

include "config.php";
$webHookUrl = "https://470web.com/telegramIndex";
$apiUrl = "https://api.telegram.org/bot{$BOT_TOKEN}/setWebhook?url={$webHookUrl}";
$response = file_get_contents($apiUrl);
echo $response;

?>

</h1>