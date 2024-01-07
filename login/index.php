<?php

require_once('../db.php');

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare an SQL statement to fetch the user's data based on the username
    $stmt = $conn->prepare("SELECT id, username, password FROM user WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // User found, verify password
        $userData = $result->fetch_assoc();
        if (password_verify($password, $userData['password'])) {
            // Password is correct
            http_response_code(200);
            $response = array("message" => "Login successful", "user_id" => $userData['id']);
            echo json_encode($response);
        } else {
            // Password is incorrect
            http_response_code(401); // Unauthorized
            $response = array("error" => "Incorrect password");
            echo json_encode($response);
        }
    } else {
        // User not found
        http_response_code(404); // Not Found
        $response = array("error" => "User not found");
        echo json_encode($response);
    }
} else {
    http_response_code(400);

    $missingFields = array();
    if (!isset($_POST['username'])) {
        $missingFields[] = 'username';
    }
    if (!isset($_POST['password'])) {
        $missingFields[] = 'password';
    }

    $response = array("error" => "Incomplete data provided", "missing_fields" => $missingFields);
    echo json_encode($response);
}
?>
