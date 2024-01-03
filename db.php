<?php
$dbConfig = array(
    "servername" => "localhost",
    "username" => "root",
    "password" => "",
    "database" => "dystopia"
);

$conn = new mysqli($dbConfig['servername'], $dbConfig['username'], $dbConfig['password'], $dbConfig['database']);

if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(array("error" => "Connection failed: " . $conn->connect_error));
    exit();
}


?>
