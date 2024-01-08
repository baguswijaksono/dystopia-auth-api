<?php
include('../db.php');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create User table
$sqlUser = "
CREATE TABLE IF NOT EXISTS User (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    points INT NOT NULL DEFAULT 0
)";
if ($conn->query($sqlUser) === TRUE) {
    echo "User table created successfully<br>";
} else {
    echo "Error creating User table: " . $conn->error . "<br>";
}

// Create unlockedArea table
$sqlUnlockedArea = "
CREATE TABLE IF NOT EXISTS unlockedArea (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    area_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES User(id),
    FOREIGN KEY (area_id) REFERENCES area(id)
)";
if ($conn->query($sqlUnlockedArea) === TRUE) {
    echo "unlockedArea table created successfully<br>";
} else {
    echo "Error creating unlockedArea table: " . $conn->error . "<br>";
}

// Create area table
$sqlArea = "
CREATE TABLE IF NOT EXISTS area (
    id INT AUTO_INCREMENT PRIMARY KEY,
    area VARCHAR(50) NOT NULL
)";
if ($conn->query($sqlArea) === TRUE) {
    echo "area table created successfully<br>";
} else {
    echo "Error creating area table: " . $conn->error . "<br>";
}

// Create ability table
$sqlAbility = "
CREATE TABLE IF NOT EXISTS ability (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ability VARCHAR(50) NOT NULL
)";
if ($conn->query($sqlAbility) === TRUE) {
    echo "ability table created successfully<br>";
} else {
    echo "Error creating ability table: " . $conn->error . "<br>";
}

// Create unlockedAbility table
$sqlUnlockedAbility = "
CREATE TABLE IF NOT EXISTS unlockedAbility (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ability_id INT NOT NULL,
    user_id INT NOT NULL,
    FOREIGN KEY (ability_id) REFERENCES ability(id),
    FOREIGN KEY (user_id) REFERENCES User(id)
)";
if ($conn->query($sqlUnlockedAbility) === TRUE) {
    echo "unlockedAbility table created successfully<br>";
} else {
    echo "Error creating unlockedAbility table: " . $conn->error . "<br>";
}

// Create Checkpoints table
$sqlCheckpoints = "
CREATE TABLE IF NOT EXISTS Checkpoints (
    id INT AUTO_INCREMENT PRIMARY KEY,
    checkpoint VARCHAR(50) NOT NULL
)";
if ($conn->query($sqlCheckpoints) === TRUE) {
    echo "Checkpoints table created successfully<br>";
} else {
    echo "Error creating Checkpoints table: " . $conn->error . "<br>";
}

// Create latestCheckpoint table
$sqlLatestCheckpoint = "
CREATE TABLE IF NOT EXISTS latestCheckpoint (
    id INT AUTO_INCREMENT PRIMARY KEY,
    userID INT NOT NULL,
    CheckpointID INT NOT NULL,
    FOREIGN KEY (userID) REFERENCES User(id),
    FOREIGN KEY (CheckpointID) REFERENCES Checkpoints(id)
)";
if ($conn->query($sqlLatestCheckpoint) === TRUE) {
    echo "latestCheckpoint table created successfully<br>";
} else {
    echo "Error creating latestCheckpoint table: " . $conn->error . "<br>";
}

// Create item table
$sqlItem = "
CREATE TABLE IF NOT EXISTS item (
    id INT AUTO_INCREMENT PRIMARY KEY,
    item VARCHAR(50) NOT NULL
)";
if ($conn->query($sqlItem) === TRUE) {
    echo "item table created successfully<br>";
} else {
    echo "Error creating item table: " . $conn->error . "<br>";
}

// Create unlockedItem table
$sqlUnlockedItem = "
CREATE TABLE IF NOT EXISTS unlockedItem (
    id INT AUTO_INCREMENT PRIMARY KEY,
    item_id INT NOT NULL,
    user_id INT NOT NULL,
    FOREIGN KEY (item_id) REFERENCES item(id),
    FOREIGN KEY (user_id) REFERENCES User(id)
)";
if ($conn->query($sqlUnlockedItem) === TRUE) {
    echo "unlockedItem table created successfully<br>";
} else {
    echo "Error creating unlockedItem table: " . $conn->error . "<br>";
}

// Create achievement table
$sqlAchievement = "
CREATE TABLE IF NOT EXISTS achievement (
    id INT AUTO_INCREMENT PRIMARY KEY,
    achievement VARCHAR(50) NOT NULL,
    description TEXT
)";
if ($conn->query($sqlAchievement) === TRUE) {
    echo "achievement table created successfully<br>";
} else {
    echo "Error creating achievement table: " . $conn->error . "<br>";
}

// Create unlockedAchievement table
$sqlUnlockedAchievement = "
CREATE TABLE IF NOT EXISTS unlockedAchievement (
    id INT AUTO_INCREMENT PRIMARY KEY,
    achievement_id INT NOT NULL,
    user_id INT NOT NULL,
    FOREIGN KEY (achievement_id) REFERENCES achievement(id),
    FOREIGN KEY (user_id) REFERENCES User(id)
)";
if ($conn->query($sqlUnlockedAchievement) === TRUE) {
    echo "unlockedAchievement table created successfully<br>";
} else {
    echo "Error creating unlockedAchievement table: " . $conn->error . "<br>";
}

$conn->close(); // Close the connection
?>
