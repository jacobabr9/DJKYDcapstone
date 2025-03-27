<!DOCTYPE html>
<html lang="en">
<head>
  <!-- basic -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- mobile metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="viewport" content="initial-scale=1, maximum-scale=1">
  <!-- site metas -->
  <title>mind</title>
  <meta name="keywords" content="">
  <meta name="description" content="">
  <meta name="author" content="">
  <!-- fevicon -->
  <link rel="icon" href="images/fevicon.png" type="image/gif" />
  <!-- bootstrap css -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!-- style css -->
  <link rel="stylesheet" href="css/style.css">
  <!-- Responsive-->
  <link rel="stylesheet" href="css/responsive.css">  
  <!-- Scrollbar Custom CSS -->
  <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
  <!-- Tweaks for older IEs-->
  <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>

<body class="main-layout">
  <!-- loader  --
  <div class="loader_bg">
    <div class="loader"><img src="images/loading.gif" alt="#" /></div>
  </div>
  <!-- end loader -->

  <!-- header -->
  <header>
    <div class="header-top">
      <div class="header">
        <div class="container-fluid">
          <div class="row">
            <div class="col-xl-2 col-lg-4 col-md-4 col-sm-3 col logo_section">
              <div class="full">
                <div class="center-desk">
                  <div class="logo">
                    <a href="index.php"><img src="images/colorized.png" alt="#" /></a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-10 col-lg-8 col-md-8 col-sm-9">
              <div class="header_information">
                <div class="menu-area">
                  <div class="limit-box">
                    <nav class="main-menu ">
                      <ul class="menu-area-main">
                        <li class="active"> <a href="index.php">Home</a> </li>
                        <li> <a href="#courses">My Courses </a> </li>
                        <li> <a href="#about">About</a> </li>
                        <li> <a href="#learn">My Profile</a> </li>
                        <li> <a href="#important">Become an Instructor</a> </li>
                        <li> <a href="#contact">Contact</a> </li>
                      </ul>
                    </nav>
                  </div>
                </div> 
                <div class="mean-last">
                  <a href="#"><img src="images/search_icon.png" alt="#" /></a> <a href="#">login/sing up</a>
                </div>              
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
  <!-- end header -->

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

// Fetch career paths for the dropdown
$sql_career_paths = "SELECT Career ID, CareerPathName FROM career_path";
$career_result = $mysqli->query($sql_career_paths);

// Get the selected career path from the search form
$career_path_id = isset($_GET['career_path']) ? $_GET['career_path'] : 'all';

// Build the SQL query based on the selected career path
if ($career_path_id == 'all') {
    // Show all articles
    $sql = "SELECT n.Title, n.Link, c.CareerPathName 
            FROM news n
            JOIN career_path c ON n.Career ID = c.Career ID
            ORDER BY n.DateAdded DESC"; // Sorting by the newest articles
} else {
    // Show articles related to the selected Career Path ID (including AI)
    $sql = "SELECT n.Title, n.Link, c.CareerPathName 
            FROM news n
            JOIN career_path c ON n.Career ID = c.Career ID
            WHERE n.Career ID = ? 
            ORDER BY n.DateAdded DESC";
}

$stmt = $mysqli->prepare($sql);

// If a specific Career Path is selected, bind the parameter
if ($career_path_id != 'all') {
    $stmt->bind_param('i', $career_path_id); // Bind the CareerPath ID parameter
}

$stmt->execute();
$result = $stmt->get_result();

?>

<form method="get" action="">
    <label for="career_path">Choose a Career Path or AI-related Job:</label>
    <select name="career_path" id="career_path">
        <option value="all" <?php if ($career_path_id == 'all') echo 'selected'; ?>>All Career Paths</option>
        <option value="10" <?php if ($career_path_id == '10') echo 'selected'; ?>>AI Replacing Jobs</option>
        <?php
        // Display career paths in dropdown
        while ($row = $career_result->fetch_assoc()) {
            echo "<option value='" . $row['Career ID'] . "' " . ($career_path_id == $row['Career ID'] ? 'selected' : '') . ">" . htmlspecialchars($row['CareerPathName']) . "</option>";
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
        echo "<div class='article'>";
        echo "<h3><a href='" . $row['Link'] . "' target='_blank'>" . htmlspecialchars($row['Title']) . "</a></h3>";
        echo "<p><strong>Career Path:</strong> " . htmlspecialchars($row['CareerPathName']) . "</p>";
        echo "</div>";
    }
    echo "</div>";
} else {
    echo "No articles found.";
}

$mysqli->close();
?>

<!-- Footer -->
<footer>
  <div class="footer">
    <div class="container">
      <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
          <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
              <div class="address">
                <h3>Contact us</h3>
                <ul class="local">
                  <li><a href="#"><img src="icon/loc.png" alt="#" />London 145<br>United Kingdom</a></li>
                  <li><a href="#"><img src="icon/email.png" alt="#" />demo@gmail.com</a></li>
                  <li><a href="#"><img src="icon/call.png" alt="#" />+12586954775</a></li>
                </ul>
                <ul class="social_link">
                  <li><a href="#"><img src="icon/fb.png"></a></li>
                  <li><a href="#"><img src="icon/tw.png"></a></li>
                  <li><a href="#"><img src="icon/lin(2).png"></a></li>
                  <li><a href="#"><img src="icon/instagram.png"></a></li>
                </ul>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="address">
                <h3>Courses</h3>
                <ul class="Menu_footer">
                  <li class="active"> <a href="#">Masters Degree</a> </li>
                  <li><a href="#">Post GraduateU</a> </li>
                  <li><a href="#">Ndergraduate</a> </li>
                  <li><a href="#">Engineering</a> </li>
                  <li><a href="#">Ph.D Degree</a> </li>
                </ul>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="address">
                <h3>Information</h3>
                <ul class="Links_footer">
                  <li class="active"><a href="#">Campus Tour</a></li>
                  <li><a href="#">Student Life</a></li>
                  <li><a href="#">Scholarships</a></li>
                  <li><a href="#">Admission</a></li>
                  <li><a href="#">Leadership</a></li>
                </ul>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="address">
                <a href="index.php"><img src="images/compactWHITE.png" alt="logo"></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>

<!-- Javascript files-->
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/jquery-3.0.0.min.js"></script>
<script src="js/plugin.js"></script>
<script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="js/custom.js"></script>

</body>
</html>
