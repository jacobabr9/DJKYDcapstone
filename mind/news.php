<?php
// Include the database connection
session_start();
$host = "localhost"; 
$username = "root";   
$password = "";        
$dbname = "djkyd";    

$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
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
