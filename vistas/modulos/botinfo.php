<?php

include 'config.php';

$apiUlr = "https://api.telegram.org/bot{$BOT_TOKEN}/getMe";
$response = file_get_contents($apiUlr);

if($response === false){
    echo "Error getting bot info";
    exit(0);
}else{
    $data = json_decode($response, true);
    if($data['ok'] == true){
        echo "Bot name: {$data['result']['username']}<br>";
        echo "Bot id: {$data['result']['id']}<br>";
    }else{
        echo "Error getting bot info";
        exit(0);
    }
}