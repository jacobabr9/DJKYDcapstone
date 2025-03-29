<?php
// crawler-handler.php

// Set up database connection
$servername = "localhost";
$username = "root";  // Use the crawler user
$password = "djkyd";     // Use the news password
$dbname = "djkyd";      // Use your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from POST request
if(isset($_POST['career_id']) && isset($_POST['title']) && isset($_POST['link'])) {
    $career_id = $_POST['career_id'];
    $title = $_POST['title'];
    $link = $_POST['link'];

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO news (CareerID, Title, Link) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $career_id, $title, $link);  // 'i' for integer, 's' for string

    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Missing required data.";
}

$conn->close();
?>
