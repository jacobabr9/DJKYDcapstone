<?php
// Include the database connection
session_start();

// Remote database credentials (replace with your actual credentials)
$host = "djkyd-ai-support.site";  // Remote server's hostname or IP
$username = "root";   // MySQL username for the remote server
$password = "djkyd";  // MySQL password for the remote server
$dbname = "djkyd";    // Your database name

// Connect to the remote MySQL database
$mysqli = new mysqli("localhost", "root", "djkyd", "djkyd");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// File to store the last run timestamp
$timestampFile = 'last_run_timestamp.txt';

// Path to the Python script (ensure this is the correct path)
$pythonScriptPath = __DIR__ . '/crawler.py';  // Dynamically gets the path based on current directory

// Check if the script has already run today
if (!file_exists($timestampFile) || file_get_contents($timestampFile) < strtotime("today")) {
    // Run the Python script
    $command = "python " . escapeshellarg($pythonScriptPath);
    $output = shell_exec($command);

    // Error handling: Check if the command executed successfully
    if ($output === null) {
        // Log the error if the script doesn't run
        error_log("Error: Python script execution failed", 3, 'error_log.txt');
        echo "Error: Python script execution failed.";
    } else {
        // Log the successful execution
        file_put_contents($timestampFile, time());  // Save the current timestamp (today)
        echo "<pre>$output</pre>";  // Optionally display output for debugging
    }
} else {
    // Optional: Show message if the script already ran today
    echo "Crawler has already run today.";
}

// Query to retrieve articles and their related career paths
$sql = "SELECT n.Title, n.Link, c.CareerPathName 
        FROM news n
        JOIN career_path c ON n.CareerID = c.CareerID
        ORDER BY n.DateAdded DESC"; // Sorting by the newest articles

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Loop through and display each article
    echo "<div class='articles'>";
    while($row = $result->fetch_assoc()) {
        echo "<div class='article'>";
        echo "<h3><a href='" . $row['Link'] . "' target='_blank'>" . htmlspecialchars($row['Title']) . "</a></h3>";
        echo "<p><strong>Career Path:</strong> " . htmlspecialchars($row['CareerPathName']) . "</p>";
        echo "</div>";
    }
    echo "</div>";
} else {
    echo "No articles found.";
}

$conn->close();
?>
