<?php
// insert_article.php

// Set up database connection
$servername = "localhost";
$username = "crawler";  // Use the crawler user
$password = "news";     // Use the news password
$dbname = "djkyd";      // Use your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from POST request
$career_id = $_POST['career_id'];
$title = $_POST['title'];
$link = $_POST['link'];

// Prepare and execute SQL query
$sql = "INSERT INTO news (CareerID, Title, Link) VALUES ('$career_id', '$title', '$link')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
