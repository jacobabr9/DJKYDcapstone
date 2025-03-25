<!DOCTYPE html> 

<?php
// Database credentials
$host = "djkyd-ai-support.site"; 
$username = "root";   
$password = "djkyd";        
$dbname = "djkyd";   

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<?php
// Database connection setup (already done above)

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data (like first name, last name, etc.)
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $username_reg = mysqli_real_escape_string($conn, $_POST['username_reg']);
    $password_reg = mysqli_real_escape_string($conn, $_POST['password_reg']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $student_id = mysqli_real_escape_string($conn, $_POST['student_id']); // CHANGE
    $program_id = mysqli_real_escape_string($conn, $_POST['program_id']);

    // Check if any fields are empty
    if (empty($first_name) || empty($last_name) || empty($username_reg) || empty($password_reg) || empty($email) || empty($student_id) || empty($program_id)) {
        echo "All fields are required!";
        exit();
    }

    // Check if Username or TEACHER ID already exists (CHANGE TO TEACHER)
    $check_sql = "SELECT * FROM teacher WHERE Username = '$username_reg' OR `Teacher ID` = '$teacher_id'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        echo "<p class='text-danger'>The Username or Student ID already exists. Please choose a different one.</p>";
    } else {
        // Insert the new TEACHER into the database
        $insert_sql = "INSERT INTO teacher (`First name`, `Last name`, `Username`, `Password`, `Email`, `Teacher ID`, `BIT program ID`) 
                       VALUES ('$first_name', '$last_name', '$username_reg', '$password_reg', '$email', '$teacher_id', '$program_id')";

        if ($conn->query($insert_sql) === TRUE) {
            // Login the user automatically
            $_SESSION['username'] = $username_reg;  // Store username in session
            $_SESSION['teacher_id'] = $teacher_id;  // Optionally, store the TEACHER ID in session (if you need it)

            // Redirect to the homepage or another page after successful login
            header("Location: index.php"); 
            exit(); // Make sure to call exit() after header to stop the script from continuing
        } else {
            echo "<p class='text-danger'>Error: " . $conn->error . "</p>";
        }
    }
}
?>

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


<!-- login  ------------------------------------------->
<div id="about" class="about">
  <div class="container">
    <h2>Teacher <strong class="yellow">Login</strong></h2>    
    <form action="" method="POST">
      <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" class="form-control" id="username" name="username" required>
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" id="password" name="password" required>
      </div>
      <button type="submit" class="btn btn-primary">Login</button>
    </form>

    <h2>Don't Have an Account? <strong class="yellow">Make one!</strong></h2>

    <!-- Registration Form -->
    <form action="" method="POST">
      <div class="form-group">
        <label for="first_name">First Name:</label>
        <input type="text" class="form-control" id="first_name" name="first_name" required>
      </div>
      <div class="form-group">
        <label for="last_name">Last Name:</label>
        <input type="text" class="form-control" id="last_name" name="last_name" required>
      </div>
      <div class="form-group">
        <label for="username_reg">Username:</label>
        <input type="text" class="form-control" id="username_reg" name="username_reg" required>
      </div>
      <div class="form-group">
        <label for="password_reg">Password:</label>
        <input type="password" class="form-control" id="password_reg" name="password_reg" required>
      </div>
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" name="email" required>
      </div>
      <div class="form-group">
        <label for="student_id">Student ID:</label> <!-- CHANGE THIS STUFF TO TEACHER -->
        <input type="text" class="form-control" id="teacher_id" name="teacher_id" required>
      </div>
      <div class="form-group">
        <label for="program_id">Program:</label>
        <select class="form-control" id="program_id" name="program_id" required>
          <option value="1">Information Resource Management</option>
          <option value="2">Interactive Multimedia & Design</option>
          <option value="3">Network Technology</option>
          <option value="4">Optical Systems & Sensors</option>
        </select>
      </div>
      <button type="submit" class="btn btn-success">Register</button>
    </form>
    <br>


  </div>
</div>
<!-- end login --------------------------------------->


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
