<?php
$dbConfig = array(
    "servername" => "localhost",
    "username" => "root",
    "password" => "", 
    "dbname" => "dystopia"
);

$conn = new mysqli($dbConfig['servername'], $dbConfig['username'], $dbConfig['password'], $dbConfig['dbname']);

if ($conn->connect_error) {
    http_response_code(500); 
    echo json_encode(array("error" => "Connection failed: " . $conn->connect_error));
    exit();
}

function handleRoutes($conn) {

    $request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    switch ($request_uri) {
        case '/':
            welcome();
            break;
        default:
            http_response_code(404); 
            $response = array("error" => "Page not found");
            echo json_encode($response);
            break;
    }
}

$request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

handleRoutes($conn);

function welcome()
{
    http_response_code(200); // OK
    $response = array("message" => "Welcome to the API!");
    echo json_encode($response);
}

?>
