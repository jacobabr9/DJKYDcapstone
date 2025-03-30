<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Basic meta tags and CSS files -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>mind</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/responsive.css">
  <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
</head>

<body>

  <!-- Header Section -->
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
                    <nav class="main-menu">
                      <ul class="menu-area-main">
                        <li class="active"> <a href="index.php">Home</a> </li>
                        <li> <a href="#courses">My Courses</a> </li>
                        <li> <a href="#about">About</a> </li>
                        <li> <a href="#learn">My Profile</a> </li>
                        <li> <a href="#important">Become an Instructor</a> </li>
                        <li> <a href="#contact">Contact</a> </li>
                      </ul>
                    </nav>
                  </div>
                </div> 
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content Section -->
  <div class="container mt-5">
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

    // Fetch career paths for the dropdown
    $sql_career_paths = "SELECT CareerID, CareerPathName FROM career_path";
    $career_result = $mysqli->query($sql_career_paths);

    // Get the selected career path from the search form
    $career_path_id = isset($_GET['career_path']) ? (int)$_GET['career_path'] : 'all';

    // Build the SQL query based on the selected career path
    if ($career_path_id == 'all') {
        // Show all articles from career paths 1 through 9
        $sql = "SELECT n.Title, n.Link, c.CareerPathName 
                FROM news n
                JOIN career_path c ON n.CareerID = c.CareerID
                WHERE n.CareerID BETWEEN 1 AND 9
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
            echo "<h3><a href='" . htmlspecialchars($row['Link']) . "' target='_blank'>" . htmlspecialchars($row['Title']) . "</a></h3>";
            echo "<p><strong>Career Path:</strong> " . htmlspecialchars($row['CareerPathName']) . "</p>";
            echo "</article>";
        }
        echo "</div>";
    } else {
        echo "<p>No articles found.</p>";
    }

    $mysqli->close();
    ?>
  </div>

  <!-- Footer Section -->
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
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>

</body>
</html>
