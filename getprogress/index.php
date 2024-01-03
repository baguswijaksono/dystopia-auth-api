<?php
include('../db.php');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Assume you received the user ID through a GET parameter
$userID = $_GET['user_id']; // Make sure to validate and sanitize user input

// SQL query to fetch player progress details
$sql = "
SELECT User.username, User.email, User.points,
       GROUP_CONCAT(DISTINCT area.area) AS unlocked_areas,
       GROUP_CONCAT(DISTINCT ability.ability) AS unlocked_abilities,
       GROUP_CONCAT(DISTINCT Checkpoints.checkpoint) AS latest_checkpoints,
       GROUP_CONCAT(DISTINCT item.item) AS unlocked_items
FROM User
LEFT JOIN unlockedArea ON User.id = unlockedArea.user_id
LEFT JOIN area ON unlockedArea.area_id = area.id
LEFT JOIN unlockedAbility ON User.id = unlockedAbility.user_id
LEFT JOIN ability ON unlockedAbility.ability_id = ability.id
LEFT JOIN latestCheckpoint ON User.id = latestCheckpoint.userID
LEFT JOIN Checkpoints ON latestCheckpoint.CheckpointID = Checkpoints.id
LEFT JOIN unlockedItem ON User.id = unlockedItem.user_id
LEFT JOIN item ON unlockedItem.item_id = item.id
WHERE User.id = $userID
GROUP BY User.id;
";

$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $progress = $result->fetch_assoc();

    // Organize the result into a cleaner JSON structure
    $cleanedResult = [
        'username' => $progress['username'],
        'email' => $progress['email'],
        'points' => $progress['points'],
        'progress_details' => [
            'unlocked_areas' => explode(',', $progress['unlocked_areas']),
            'unlocked_abilities' => explode(',', $progress['unlocked_abilities']),
            'latest_checkpoints' => explode(',', $progress['latest_checkpoints']),
            'unlocked_items' => explode(',', $progress['unlocked_items'])
        ]
    ];

    // Encode the cleaned data into JSON format
    header('Content-Type: application/json');
    echo json_encode($cleanedResult, JSON_PRETTY_PRINT);
} else {
    echo "No progress found for the specified user.";
}

$conn->close(); // Close the connection
?>
