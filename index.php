<?php

function welcome()
{
    http_response_code(200); // OK
    $response = array("message" => "Welcome to the API!");
    echo json_encode($response);
}



?>
