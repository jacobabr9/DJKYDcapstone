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
  <title>DJKYD</title>
  <meta name="keywords" content="">
  <meta name="description" content="">
  <meta name="author" content="">
  <!-- favicon -->
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

<body>

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
                    <nav class="main-menu">
                      <ul class="menu-area-main">
                      <li><a href="index.php">Home</a></li>
                      <li><a href="#courses">Students</a></li>
                      <li><a href="faculty-page.php">Faculty</a></li>
                      <li><a href="#learn">Community</a></li>
                      <li><a href="#important">Ask AI</a></li>
                      <li class="active"><a href="#contact">News</a></li>
                      </ul>
                    </nav>
                  </div>
                </div> 
                <div class="mean-last">
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

  <br>
  <br>
  <br>
  <br>

  <form method="get" action="">
      <label for="career_path">Choose a Career Path:</label>
      <select name="career_path" id="career_path">
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
          echo "<h3><a href='" . ($row['Link'] ? $row['Link'] : '#') . "' target='_blank'>" . htmlspecialchars($row['Title']) . "</a></h3>";
          echo "<p><strong>Career Path:</strong> " . htmlspecialchars($row['CareerPathName']) . "</p>";
          echo "</article>";
      }
      echo "</div>";
  } else {
      echo "No articles found.";
  }

  $mysqli->close();
  ?>

<!--  footer -->
    <footer>
      <div class="footer ">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <h2><br><br></h2>
            </div>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 ">
              <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 ">
                  <div class="address">
                    <h3>Contact Us </h3>
                    <ul class="loca">
                      <li>
                        <a href="#"><img src="icon/loc.png" alt="#" /></a>1125 Colonel By Dr, Ottawa,<br> ON K1S 5B6
                        <br>Canada </li>
                        <li>
                          <a href="#"><img src="icon/email.png" alt="#" /></a>djkyd@cmail.carleton.ca </li>
                          <li>
                            <a href="#"><img src="icon/call.png" alt="#" /></a>(613) 520-2600 </li>
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
                          <h3>For Students</h3>
                          <ul class="Menu_footer">
                            <li class="active"> <a href="#">Resources for getting started</a> </li>
                            <li><a href="#">Carleton policies/guidelines</a> </li>
                            <li><a href="#">Governmental policies</a> </li>
                            <li><a href="#">Coursework support</a> </li>
                            <li><a href="#">Skills development</a> </li>
                            <li><a href="#">Career support</a> </li>
                            <li><a href="#">Learn by participating in events and communities</a> </li>
                            <li><a href="#">Reach out for further support</a> </li>
                          </ul>
                        </div>
                      </div>
                      <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="address">
                          <h3>For Faculty</h3>
                          <ul class="Links_footer">
                            <li class="active"><a href="#">Resources for getting started</a> </li>
                            <li><a href="#">Carleton policies/guidelines</a> </li>
                            <li><a href="#">Governmental policies</a> </li>
                            <li><a href="#">Planning your course(s)</a> </li>
                            <li><a href="#">How to support students</a> </li>
                            <li><a href="#">Reports</a> </li>
                            <li><a href="#">Participation opportunities</a> </li>
                            <li><a href="#">Reach out for further support</a> </li>
                          </ul>
                        </div>
                      </div>

                      <div class="col-lg-3 col-md-6 col-sm-6 ">
                        <div class="address">
                          <a href="#"> <img src="images/compactWHITE.png" alt="logo"></a>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>

              </div>
              <div class="copyright">
                <div class="container">
                  <p><strong>DJKYD 2025</strong> — Final Capstone Project Submission</a></p>
				  <p>David, Jacob, Kamji, Yasmeen, Dominic</p>
                </div>
              </div>
            </div>
          </footer>
          <!-- end footer -->

</body>
</html>
