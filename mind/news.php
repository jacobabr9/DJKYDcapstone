<?php
// Include the database connection
session_start();

// Database credentials
$host = "localhost"; 
$username = "root";   
$password = "djkyd";        
$dbname = "djkyd";   

// Create connection with your given credentials
$mysqli = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// File to store the last run timestamp
$timestampFile = 'last_run_timestamp.txt';

// Path to the Python script (ensure this is the correct path)
$pythonScriptPath = __DIR__ . '/crawler.py';  // Dynamically gets the path based on current directory

// Check if the script has already run today
if (!file_exists($timestampFile) || file_get_contents($timestampFile) < strtotime("today")) {
    // Run the Python script
    $command = "python " . escapeshellarg($pythonScriptPath) . " 2>&1";  // Capture stderr
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

// Fetch career paths for the dropdown
$sql_career_paths = "SELECT CareerID, CareerPathName FROM career_path";
$career_result = $mysqli->query($sql_career_paths);

// Get the selected career path from the search form
$career_path_id = isset($_GET['career_path']) ? (int)$_GET['career_path'] : 'all';

// Build the SQL query based on the selected career path
if ($career_path_id == 'all') {
    // Show all articles
    $sql = "SELECT n.Title, n.Link, c.CareerPathName 
            FROM news n
            JOIN career_path c ON n.CareerID = c.CareerID
            ORDER BY n.Published_at DESC"; // Sorting by the newest articles
} else {
    // Show articles related to the selected Career Path ID
    $sql = "SELECT n.Title, n.Link, c.CareerPathName 
            FROM news n
            JOIN career_path c ON n.CareerID = c.CareerID
            WHERE n.CareerID = ? 
            ORDER BY n.Published_at DESC";  // Sorting by the newest articles
}

$stmt = $mysqli->prepare($sql);

// If a specific Career Path is selected, bind the parameter
if ($career_path_id != 'all') {
    $stmt->bind_param('i', $career_path_id); // Bind the CareerPath ID parameter
}

$stmt->execute();
$result = $stmt->get_result();
?>

<br>
<br>
<br>
<br>

<form method="get" action="">
    <label for="career_path">Choose a Career Path:</label>
    <select name="career_path" id="career_path">
        <option value="all" <?php if ($career_path_id == 'all') echo 'selected'; ?>>All Career Paths</option>
        <?php
        // Display career paths in dropdown
        while ($row = $career_result->fetch_assoc()) {
            echo "<option value='" . $row['CareerID'] . "' " . ($career_path_id == $row['CareerID'] ? 'selected' : '') . ">" . htmlspecialchars($row['CareerPathName']) . "</option>";
        }
        ?>
    </select>
    <input type="submit" value="Search">
</form>

<?php
// Display the articles based on the selected Career Path
if ($result->num_rows > 0) {
    echo "<div class='articles'>";
    while ($row = $result->fetch_assoc()) {
        echo "<article class='article'>";
        echo "<h3><a href='" . $row['Link'] . "' target='_blank'>" . htmlspecialchars($row['Title']) . "</a></h3>";
        echo "<p><strong>Career Path:</strong> " . htmlspecialchars($row['CareerPathName']) . "</p>";
        echo "</article>";
    }
    echo "</div>";
} else {
    echo "No articles found.";
}

$mysqli->close();
?>
