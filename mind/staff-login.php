<?php
// Database credentials
$host = "localhost"; 
$username = "root";   
$password = "djkyd";        
$dbname = "djkyd";   

// Create connection with your given credentials
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Start session to check for login status
session_start();

// Redirect if user is already logged in
if (isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

// Handle professor login
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['username']) && isset($_POST['password'])) {
    // Get the login form data (username and password)
    $username_login = mysqli_real_escape_string($conn, $_POST['username']);
    $password_login = mysqli_real_escape_string($conn, $_POST['password']);

    // Check if fields are empty
    if (empty($username_login) || empty($password_login)) {
        echo "All fields are required!";
        exit();
    }

    // Query the database to check if the username exists
    $login_sql = "SELECT * FROM professor WHERE Username = '$username_login'";
    $login_result = $conn->query($login_sql);

    if ($login_result->num_rows > 0) {
        // Fetch user data
        $row = $login_result->fetch_assoc();
        
        // Verify password using password_verify()
        if (password_verify($password_login, $row['Password'])) {
            // Password is correct, set session variables
            $_SESSION['username'] = $username_login;
            $_SESSION['role'] = 'professor';  // Update as necessary
            $_SESSION['professor_id'] = $row['Professor_ID'];  // Corrected the field name

            // Redirect to homepage after successful login
            header("Location: index.php");
            exit();
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "No account found with that username.";
    }
}

// If you want to handle registration separately, use the following block:
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['first_name'])) {
    // Get the registration form data
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $username_reg = mysqli_real_escape_string($conn, $_POST['username_reg']);
    $password_reg = mysqli_real_escape_string($conn, $_POST['password_reg']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $professor_id = mysqli_real_escape_string($conn, $_POST['professor_id']);
    $program_id = mysqli_real_escape_string($conn, $_POST['program_id']);

    // Check if any fields are empty
    if (empty($first_name) || empty($last_name) || empty($username_reg) || empty($password_reg) || empty($email) || empty($professor_id) || empty($program_id)) {
        echo "All fields are required!";
        exit();
    }

    // Check if Username or professor ID already exists
    $check_sql = "SELECT * FROM professor WHERE Username = '$username_reg' OR Professor_ID = '$professor_id'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        echo "The Username or professor ID already exists. Please choose a different one.";
    } else {
        // Hash the password
        $hashed_password = password_hash($password_reg, PASSWORD_DEFAULT);

        // Insert the new professor into the database
        $insert_sql = "INSERT INTO professor (First_Name, Last_Name, Username, Password, Email, Professor_ID, BIT_Program_ID) 
                       VALUES ('$first_name', '$last_name', '$username_reg', '$hashed_password', '$email', '$professor_id', '$program_id')";

        if ($conn->query($insert_sql) === TRUE) {
            // Login the user automatically
            $_SESSION['username'] = $username_reg;
            $_SESSION['role'] = 'professor';
            $_SESSION['professor_id'] = $professor_id;

            // Redirect to the homepage after successful login
            header("Location: index.php");
            exit();
        } else {
            echo "Error: " . $conn->error;
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
    <h2>Professor <strong class="yellow">Login</strong></h2>    
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
      <button type="submit" class="btn btn-success">Register</button>
    </form>
    <br>
  </div>
</div>

<!-- footer -->
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
                  <li><a href="#"><img src="icon/loc.png" alt="#" /></a>London 145<br>United Kingdom</li>
                  <li><a href="#"><img src="icon/email.png" alt="#" /></a>demo@gmail.com</li>
                  <li><a href="#"><img src="icon/call.png" alt="#" /></a>+12586954775</li>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>

</body>
</html>
