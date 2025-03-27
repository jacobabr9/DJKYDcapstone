<?php
// Database credentials
$host = "djkyd-ai-support.site"; 
$username = "root";   
$password = "djkyd";        
$dbname = "djkyd";   

// Create connection with your given credentials
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Registration Process
    if (isset($_POST['register'])) {
        // Get the form data (like first name, last name, etc.)
        $first_name = mysqli_real_escape_string($mysqli, $_POST['first_name']);
        $last_name = mysqli_real_escape_string($mysqli, $_POST['last_name']);
        $username_reg = mysqli_real_escape_string($mysqli, $_POST['username_reg']);
        $password_reg = mysqli_real_escape_string($mysqli, $_POST['password_reg']);
        $email = mysqli_real_escape_string($mysqli, $_POST['email']);
        $professor_id = mysqli_real_escape_string($mysqli, $_POST['professor_id']);
        $program_id = mysqli_real_escape_string($mysqli, $_POST['program_id']);

        // Check if any fields are empty
        if (empty($first_name) || empty($last_name) || empty($username_reg) || empty($password_reg) || empty($email) || empty($professor_id) || empty($program_id)) {
            echo "All fields are required!";
            exit();
        }

        // Check if Username or Professor ID already exists
        $check_sql = "SELECT * FROM professor WHERE Username = '$username_reg' OR `Professor ID` = '$professor_id'";
        $check_result = $mysqli->query($check_sql);

        if ($check_result->num_rows > 0) {
            echo "<p class='text-danger'>The Username or Professor ID already exists. Please choose a different one.</p>";
        } else {
            // Hash the password
            $hashed_password = password_hash($password_reg, PASSWORD_DEFAULT);

            // Insert the new professor into the database
            $insert_sql = "INSERT INTO professor (`First name`, `Last name`, `Username`, `Password`, `Email`, `Professor ID`, `BIT program ID`) 
                           VALUES ('$first_name', '$last_name', '$username_reg', '$hashed_password', '$email', '$professor_id', '$program_id')";

            if ($mysqli->query($insert_sql) === TRUE) {
                // Login the user automatically
                $_SESSION['username'] = $username_reg;  // Store username in session
                $_SESSION['professor_id'] = $professor_id;  // Store professor ID in session

                // Redirect to the homepage or another page after successful login
                header("Location: index.php"); 
                exit();
            } else {
                echo "<p class='text-danger'>Error: " . $mysqli->error . "</p>";
            }
        }
    }

    // Login Process
    if (isset($_POST['login'])) {
        // Get the login form data
        $username = mysqli_real_escape_string($mysqli, $_POST['username']);
        $password = mysqli_real_escape_string($mysqli, $_POST['password']);

        // Check if fields are empty
        if (empty($username) || empty($password)) {
            echo "Please enter both username and password!";
            exit();
        }

        // Check if the username exists
        $login_sql = "SELECT * FROM professor WHERE Username = '$username'";
        $login_result = $mysqli->query($login_sql);

        if ($login_result->num_rows == 1) {
            $user = $login_result->fetch_assoc();

            // Verify the password
            if (password_verify($password, $user['Password'])) {
                // Successful login, store session
                $_SESSION['username'] = $user['Username'];
                $_SESSION['role'] = 'student';  // 'faculty' or 'student' based on user data
                $_SESSION['professor_id'] = $user['Professor ID'];

                // Redirect to the professor dashboard
                header("Location: staff_dashboard.php");
                exit();
            } else {
                echo "<p class='text-danger'>Invalid password!</p>";
            }
        } else {
            echo "<p class='text-danger'>No user found with that username.</p>";
        }
    }
}
?>

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
</head>

<body class="main-layout">
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
               <div class="mean-last">
                       <a href="#"><img src="images/search_icon.png" alt="#" /></a> <a href="#">login/sign up</a></div>              
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
        <!-- Login Form -->
        <form action="" method="POST">
          <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username" name="username" required>
          </div>
          <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
          </div>
          <button type="submit" class="btn btn-primary" name="login">Login</button>
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
            <label for="professor_id">Professor ID:</label>
            <input type="text" class="form-control" id="professor_id" name="professor_id" required>
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
          <button type="submit" class="btn btn-success" name="register">Register</button>
        </form>
      </div>
    </div>
    <!-- end login  --------------------------------------->

    <!-- footer -->
    <footer>
      <div class="footer">
        <div class="container">
          <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 ">
              <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 ">
                  <div class="address">
                    <h3>Contact us </h3>
                    <ul class="local">
                      <li><a href="#"><img src="icon/loc.png" alt="#" /> London 145, United Kingdom </a></li>
                      <li><a href="#"><img src="icon/email.png" alt="#" /> demo@gmail.com </a></li>
                      <li><a href="#"><img src="icon/call.png" alt="#" /> +12586954775 </a></li>
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
    <!-- end footer -->

    <!-- Javascript files-->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.0.0.min.js"></script>
    <script src="js/plugin.js"></script>
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/custom.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
</body>
</html>
