<?php
require "config.php";

$data = json_decode(file_get_contents("php://input"), true);
$user_id = intval($data['user_id']);

foreach($CHANNELS as $username => $name){
    $url = BOT_API . "getChatMember?chat_id=@{$username}&user_id={$user_id}";
    $res = json_decode(file_get_contents($url), true);

    if(
        !$res['ok'] ||
        !in_array($res['result']['status'], ['member','administrator','creator'])
    ){
        echo json_encode(["status"=>"fail"]);
        exit;
    }
}

echo json_encode(["status"=>"ok"]);
