<?php

require_once('../db.php');

    if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];

        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Prepare an SQL statement to insert data into the database
        $stmt = $conn->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
        
        // Bind parameters to prevent SQL injection
        $stmt->bind_param("sss", $username, $hashedPassword, $email);

        // Execute the statement
        if ($stmt->execute()) {
            http_response_code(200);
            $response = array("message" => "User registered successfully");
            echo json_encode($response);
        } else {
            http_response_code(500); // Internal Server Error
            $response = array("error" => "Database error. User registration failed.");
            echo json_encode($response);
        }
    } else {
        http_response_code(400);
        $response = array("error" => "Incomplete data provided");
        echo json_encode($response);
    }


?>
