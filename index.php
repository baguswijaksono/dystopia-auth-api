<?php
    $http_response_code = 200; 

    http_response_code($http_response_code); 
    $response = array(
        "code" => $http_response_code,
        "message" => "Welcome to the API :3"
    );
    echo json_encode($response);
?>
