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
<!-- body -->

<body class="main-layout">
  <!-- loader  --
  <div class="loader_bg">
    <div class="loader"><img src="images/loading.gif" alt="#" /></div>
  </div>
  <-- end loader -->
  <!-- header -->
  <header>
    <!-- header inner -->
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
                       <a href="#"><img src="images/search_icon.png" alt="#" /></a> <a href="#">login/sing up</a></div>              
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

// Remote database credentials (replace with your actual credentials)
$host = "djkyd-ai-support.site";  // Remote server's hostname or IP
$username = "root";   // MySQL username for the remote server
$password = "djkyd";  // MySQL password for the remote server
$dbname = "djkyd";    // Your database name

// Create connection with your given credentials
$mysqli = new mysqli("localhost", "root", "djkyd", "djkyd");

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

    <!--  footer -->
    <footer>
      <div class="footer ">
        <div class="container">
          <div class="row">

            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 ">
              <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 ">
                  <div class="address">
                    <h3>Contact us </h3>
                    <ul class="local">
                      <li>
                        <a href="#"><img src="icon/loc.png" alt="#" /></a>London 145
                        <br>United Kingdom </li>
                        <li>
                          <a href="#"><img src="icon/email.png" alt="#" /></a>demo@gmail.com </li>
                          <li>
                            <a href="#"><img src="icon/call.png" alt="#" /></a>+12586954775 </li>
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
                            <li class="active"><a href="#">Campus Tour</a> </li>
                            <li><a href="#">Student Lifes</a> </li>
                            <li><a href="#">Cholarship</a> </li>
                            <li><a href="#"> Admission</a> </li>
                            <li><a href="#">Leadership</a> </li>
                          </ul>
                        </div>
                      </div>

                      <div class="col-lg-3 col-md-6 col-sm-6 ">
                        <div class="address">
                          <a href="index.php"> <img src="images/compactWHITE.png" alt="logo"></a>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>

              </div>
              <div class="copyright">
                <div class="container">
                  <p>Copyright © 2019 Design by <a href="https://html.design/">Free Html Templates </a></p>
                </div>
              </div>
            </div>
          </footer>
          <!-- end footer -->
          <!-- Javascript files-->
          <script src="js/jquery.min.js"></script>
          <script src="js/popper.min.js"></script>
          <script src="js/bootstrap.bundle.min.js"></script>
          <script src="js/jquery-3.0.0.min.js"></script>
          <script src="js/plugin.js"></script>
          <!-- sidebar -->
          <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
          <script src="js/custom.js"></script>
          <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>


          <script>
// This example adds a marker to indicate the position of Bondi Beach in Sydney,
// Australia.
function initMap() {
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 11,
    center: {
      lat: 40.645037,
      lng: -73.880224
    },
  });

  var image = 'images/maps-and-flags.png';
  var beachMarker = new google.maps.Marker({
    position: {
      lat: 40.645037,
      lng: -73.880224
    },
    map: map,
    icon: image
  });
}
</script>
<!-- google map js -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8eaHt9Dh5H57Zh0xVTqxVdBFCvFMqFjQ&callback=initMap"></script>
<!-- end google map js -->



</body>

</html>
