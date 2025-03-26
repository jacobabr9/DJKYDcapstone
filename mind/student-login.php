<?php
// Database credentials
$host = "djkyd-ai-support.site"; 
$username = "root";   
$password = "djkyd";        
$dbname = "djkyd";   

// Create connection with your given credentials
$mysqli = new mysqli("localhost", "root", "djkyd", "djkyd");

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Start session to check for login status
session_start();

// Redirect if user is already logged in
if (isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

// Handle student registration
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data (like first name, last name, etc.)
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $username_reg = mysqli_real_escape_string($conn, $_POST['username_reg']);
    $password_reg = mysqli_real_escape_string($conn, $_POST['password_reg']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $student_id = mysqli_real_escape_string($conn, $_POST['student_id']);
    $program_id = mysqli_real_escape_string($conn, $_POST['program_id']);

    // Check if any fields are empty
    if (empty($first_name) || empty($last_name) || empty($username_reg) || empty($password_reg) || empty($email) || empty($student_id) || empty($program_id)) {
        echo "All fields are required!";
        exit();
    }

    // Check if Username or Student ID already exists
    $check_sql = "SELECT * FROM students WHERE Username = '$username_reg' OR `Student ID` = '$student_id'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        echo "<p class='text-danger'>The Username or Student ID already exists. Please choose a different one.</p>";
    } else {
        // Insert the new student into the database
        $insert_sql = "INSERT INTO students (`First name`, `Last name`, `Username`, `Password`, `Email`, `Student ID`, `BIT program ID`) 
                       VALUES ('$first_name', '$last_name', '$username_reg', '$password_reg', '$email', '$student_id', '$program_id')";

        if ($conn->query($insert_sql) === TRUE) {
            // Login the user automatically
            $_SESSION['username'] = $username_reg;  // Store username in session
            $_SESSION['student_id'] = $student_id;  // Optionally, store the student ID in session (if you need it)

            // Redirect to the homepage or another page after successful login
            header("Location: index.php"); 
            exit(); // Make sure to call exit() after header to stop the script from continuing
        } else {
            echo "<p class='text-danger'>Error: " . $conn->error . "</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="viewport" content="initial-scale=1, maximum-scale=1">
  <title>mind</title>
  <link rel="icon" href="images/fevicon.png" type="image/gif" />
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/responsive.css">  
  <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
  <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
</head>
<body class="main-layout">

<!-- login  ------------------------------------------->
<div id="about" class="about">
  <div class="container">
    <h2>Student <strong class="yellow">Login</strong></h2>    
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
        <label for="student_id">Student ID:</label>
        <input type="text" class="form-control" id="student_id" name="student_id" required>
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

<!-- footer -->
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
                  <li><a href="#"><img src="icon/loc.png" alt="#" /></a>London 145<br>United Kingdom </li>
                  <li><a href="#"><img src="icon/email.png" alt="#" /></a>demo@gmail.com </li>
                  <li><a href="#"><img src="icon/call.png" alt="#" /></a>+12586954775 </li>
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

<!-- Javascript files-->
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/jquery-3.0.0.min.js"></script>
<script src="js/plugin.js"></script>
<script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="js/custom.js"></script>
<script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>

</body>
</html>
