<?php

// Set up database connection
$servername = "localhost";
$username = "root";  // Use the crawler user
$password = "djkyd"; // Use the news password
$dbname = "djkyd";   // Use your database name

// Create the database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    // If connection fails, return a JSON error response
    echo json_encode(["status" => "error", "message" => "Connection failed: " . $conn->connect_error]);
    exit();
}

// Get data from POST request
if(isset($_POST['career_id']) && isset($_POST['title']) && isset($_POST['link'])) {
    // Sanitize and validate input data
    $career_id = $_POST['career_id'];
    $title = $_POST['title'];
    $link = $_POST['link'];

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO news (CareerID, Title, Link) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $career_id, $title, $link);  // 'i' for integer, 's' for string

    // Check if the query executes successfully
    if ($stmt->execute()) {
        // Return success as JSON
        echo json_encode(["status" => "success", "message" => "New record created successfully"]);
    } else {
        // Return error if execution fails
        echo json_encode(["status" => "error", "message" => "Error: " . $stmt->error]);
    }

    // Close the prepared statement
    $stmt->close();
} else {
    // Return error if any required data is missing
    echo json_encode(["status" => "error", "message" => "Missing required data."]);
}

// Close the database connection
$conn->close();

?>
