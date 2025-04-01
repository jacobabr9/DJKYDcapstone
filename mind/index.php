<!DOCTYPE html>

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
?>

<html lang="en">
<head>
  <link rel="icon" type="image/x-icon" href="favicon.ico">
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
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBtQWtEYuBpcKtgrH7Yd1UoXqWat8vhhOY&callback=initMap" async defer></script>
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>
<!-- body -->

<body class="main-layout">
  <!-- loader  -->
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
                  <nav class="main-menu">
                    <ul class="menu-area-main">
                      <li class="active"><a href="index.php">Home</a></li>

                      <!-- Students link visible for everyone, with JS alert if not logged in as student -->
                      <li>
                        <a href="students-page.php" 
                           onclick="return checkLogin('student');">Students</a>
                      </li>

                      <!-- Faculty link visible for everyone, with JS alert if not logged in as professor -->
                      <li>
                        <a href="faculty-page.php" 
                           onclick="return checkLogin('professor');">Faculty</a>
                      </li>

                      <li><a href="forum.php">Community</a></li>
                      <li><a href="ask-ai.php">Ask AI</a></li>
                      <li><a href="news.php">News</a></li>

                      <!-- Logout button visible only if logged in -->
                      <?php
                      if (isset($_SESSION['username']) && isset($_SESSION['role'])) {
                          echo '<li><form action="" method="POST" style="display:inline;">
                                  <button type="submit" class="btn btn-danger">Logout</button>
                                </form></li>';
                      }
                      ?>
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

<?php
// Handle logout when the button is clicked
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_SESSION['username'])) {
        session_unset();
        session_destroy();
        echo '<script>alert("You have been logged out successfully.");</script>';
        header("Location: index.php");
        exit();
    } else {
        echo '<script>alert("You are not logged in yet.");</script>';
    }
}
?>

<!-- JavaScript function to check login status and role -->
<script>
  function checkLogin(role) {
    // Check if the user is logged in
    <?php if (!isset($_SESSION['username'])): ?>
      alert('You need to log in first.');
      return false; // prevent navigating to the page
    <?php endif; ?>

    // Check if the logged-in user has the correct role
    var userRole = '<?php echo $_SESSION['role'] ?? ''; ?>';

    if (userRole !== role) {
      alert('You must log in as a ' + role + ' to access this page.');
      return false; // prevent navigating to the page
    }

    // Allow navigation if the user has the correct role
    return true;
  }
</script>



     <!-- end header -->
     <section class="slider_section">
      <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
          <li data-target="#myCarousel" data-slide-to="1"></li>
          <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">

            <div class="container-fluid padding_dd">
              <div class="carousel-caption">
                <div class="row">
                  <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12">
                    <div class="text-bg">
                    <h1>Welcome to the BIT student support hub!</h1>
                      <p>By the DJKYD Team</p>
                      <p><strong>Disclaimer:</strong> This website is the final Capstone Project of a team of 4th-year IRM students at Carleton University. We are not officially affiliated with Carleton University, nor do we provide information on their behalf. All content is for informational purposes only.</p>
                    </div>
                  </div>
                  <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12">
                    <div class="images_box">
                      <figure><img src="images/img2.png"></figure>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item">

            <div class="container-fluid padding_dd">
              <div class="carousel-caption">

                <div class="row">
                  <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12">
                    <div class="text-bg">

                      <h1>Your One-Stop Hub for Students and Faculty</h1>
                      <p>High Quality Resources and Help Available!</p>
                      <p><strong>Disclaimer:</strong> This website is the final Capstone Project of a team of 4th-year IRM students at Carleton University. We are not officially affiliated with Carleton University, nor do we provide information on their behalf. All content is for informational purposes only.</p>

                    </div>
                  </div>

                  <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12">
                    <div class="images_box">
                      <figure><img src="images/img3.png"></figure>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>


          <div class="carousel-item">

            <div class="container-fluid padding_dd">
              <div class="carousel-caption ">
                <div class="row">
                  <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12">
                    <div class="text-bg">

                      <h1>Navigating AI in Education & Careers</h1>
                      <p>Tailored Support for BIT Students</p>
                      <p><strong>Disclaimer:</strong> This website is the final Capstone Project of a team of 4th-year IRM students at Carleton University. We are not officially affiliated with Carleton University, nor do we provide information on their behalf. All content is for informational purposes only.</p>

                    </div>
                  </div>
                  <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12">
                    <div class="images_box">
                      <figure><img src="images/img4.png"></figure>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>

<!-- MAKE --> 
<div class="make">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="titlepage">
          <h2>Sign up or login <strong class="white_colo">using the button in the top right to access all our resources!</strong></h2>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end MAKE --> 
 
</section>
</div>
</header>

<!-- about  -->
<div id="about" class="about">
  <div class="container">
    <div class="row">
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
        <div class="about-box">
          <h2>About: <strong class="yellow">Why is this useful?</strong></h2>
          <p> Due to the advancement in AI, navigating appropriate use in the classroom and finding jobs has become more challenging. On our website, you will find support for both <b>students</b> and <b>faculty</b> that is tailored to your program, all in <b>one</b> place. </p>
        </div>
      </div>
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
        <div class="about-box">
          <figure><img src="images/about.jpg" alt="#" /></figure>
        </div>
      </div>
    </div>

  </div>
</div>
<!-- end abouts -->



<!-- our -->
<div id="important" class="important">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="titlepage">
          <h2>Some <strong class="yellow">Important Facts</strong></h2>
          <span>A brief insight into the global AI climate (all according to <a href="https://www.vellum.ai/blog/must-know-ai-facts-and-statistics"><u>Vellum</u>)</a></span>
        </div>
      </div>
    </div>
  </div>
  <div class="important_bg">
    <div class="container">
      <div class="row">

        <div class="col col-xs-12">
          <div class="important_box">
            <h3>74%</h3>
            <span>more demand for AI related skills since 2021</span>
          </div>
        </div>
        <div class="col col-xs-12">
          <div class="important_box">
            <h3>73%</h3>
            <span>of companies are seeking talent related to AI</span>
          </div>
        </div>
        <div class="col col-xs-12">
          <div class="important_box">
            <h3>75%</h3>
            <span>of the 73% are unsuccessful in filling this demand</span>
          </div>
        </div>
        <div class="col col-xs-12">
          <div class="important_box">
            <h3>34%</h3>
            <span>of companies lack enough data scientists to keep up with AI</span>
          </div>
        </div>
        <div class="col col-xs-12">
          <div class="important_box">
            <h3>21x</h3>
            <span>more job postings related to AI in the past 3 years</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<!-- end our -->

<!-- learn -->
<div id="learn" class="learn">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="titlepage">
          <h2>Discover <strong class="yellow">Available Support</strong></h2>
          <span><b>Program Specific Support: Bachelor of Information Technology (BIT)</b><br>1. Information Resource Management (IRM)<br>2. Interactive Multimedia & Design (IMD)<br>3. Network Technology (NET)<br>4. Optical Systems & Sensors (OSS)<br><br><b>Student and Faculty: Tailored Resources</b><br>1. Navigate appropriate and inappropriate use of AI<br>2. Resources for student and faculty perspectives respectively<br>3. Find a diverse list of resources<br><br><b>Internal Resources: Carleton University</b><br>1. Policies/guidelines<br>2. Find participation opportunities<br>3. Coursework and teaching support<br>4. Contact information<br><br><b>External Resources: Beyond the University</b><br>1. Governmental policies <br>2. AI indexes<br>3. Reports<br><br><b>Learn: Build Skills</b><br>1. Identify field-specific and AI-proof skills<br>2. Resources for skill development<br><br><b>Interact: AI Chatbot</b><br>1. Ask specific questions about your field in relation to AI<br><br><b>Stay Up-to-date: Relevant and Recent News</b><br>1. Use our integrated web crawler that will consolidate AI news related to your field</span>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="learn_box">
          <!--<figure><img src="images/img.jpg" alt="img"/></figure>-->
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end learn --> 


<!-- contact -->
<div id="contact" class="contact">
  <div class="container-fluid padding_left2">
    <div class="white_color">
      <div class="row">

        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
          <div id="map">
          </div>

        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">

          <form class="contact_bg">
            <div class="row">
              <div class="col-md-12">
                <div class="titlepage">
                  <h2>Send <strong class="yellow">Us Questions</strong></h2>
                </div>
                <div class="col-md-12">
                  <input class="contactus" placeholder="Your Name" type="text" name="Your Name">
                </div>
                <div class="col-md-12">
                  <input class="contactus" placeholder="Your Email" type="text" name="Your Email">
                </div>
                <div class="col-md-12">
                  <input class="contactus" placeholder="Your Phone" type="text" name="Your Phone">
                </div>
                <div class="col-md-12">
                  <textarea class="textarea" placeholder="Message" type="text" name="Message"></textarea>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                  <button class="send">Send</button>
                </div>
              </div>
            </form>
          </div>
        </div>

      </div>
    </div>

    <!-- end contact -->

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
                          <a href="index.php"> <img src="images/compactWHITE.png" alt="logo"></a>
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
  function initMap() {
    var map = new google.maps.Map(document.getElementById("map"), {
      center: { lat: 45.3831, lng: -75.6976 },
      zoom: 16, 
      mapTypeId: "satellite" 
    });
  }
</script>
              
<!-- google map js -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBtQWtEYuBpcKtgrH7Yd1UoXqWat8vhhOY&callback=initMap"></script>
<!-- end google map js -->

</body>

</html>
