<?php

session_start();

require_once "../vendor/autoload.php";
require_once "../config/database.php";
require_once "../config/google-config.php";

header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data["credential"])) {

    echo json_encode([
        "success" => false,
        "message" => "No credential received."
    ]);

    exit;
}

$id_token = $data["credential"];

$client = new Google_Client([
    "client_id" => GOOGLE_CLIENT_ID
]);

try {

    $payload = $client->verifyIdToken($id_token);

    if (!$payload) {

        echo json_encode([
            "success" => false,
            "message" => "Invalid Token"
        ]);

        exit;
    }

    $google_id = $payload["sub"];
    $name = $payload["name"];
    $email = $payload["email"];
    $picture = $payload["picture"];

    // Continue in next step...

}
catch(Exception $e){

    echo json_encode([
        "success"=>false,
        "message"=>$e->getMessage()
    ]);

}