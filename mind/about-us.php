<!DOCTYPE html>

session_start();

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
                <a href="#"><img src="images/colorized.png" alt="Logo" /></a>
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
                    <li class="active"> <a href="#">Home</a> </li> <!--  CHANGE THIS TO index.php IN OTHER FILES!!!-->

                    <!-- Students link visible only if logged in as a student -->
                    <li>
                      <a href="students-page.php" onclick="return checkLogin('student');">Students</a>
                    </li>

                    <!-- Faculty link visible only if logged in as a professor -->
                    <li>
                      <a href="faculty-page.php" onclick="return checkLogin('professor');">Faculty</a>
                    </li>

                    <li> <a href="forum">Community</a> </li>
                    <li> <a href="https://2ea3-2620-22-4000-1203-1ff7-e5db-419a-b075.ngrok-free.app/">Ask AI</a> </li>
                    <li> <a href="news.php">News</a> </li>    

                  </ul> 
                </nav>
              </div>
            </div> 
            <div class="mean-last">
              
                    <!-- Logout button visible only if logged in -->
                    <?php
                    if (isset($_SESSION['username']) && isset($_SESSION['role'])) {
                        echo '<a href="logout.php" class="btn">Logout</a>';
                    } else {
                      echo '<li><a href="select-teacher-or-student.php" class="btn">Sign Up/Login</a></li>';
                          }
                    ?>
            </div>              
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

     <?php
// Start the session
session_start();

// Check if the user is logged in and if they are a student
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'student') {
    // If the user is not logged in or is not a student, show an error message
    echo "<p>You must be logged in as a student to view this page.</p>";
    // Optionally, redirect to the login page
    // header("Location: login.php");
    exit(); // Stop further execution to prevent access to the page
}
?>

     <!-- end header -->
     <section class="slider_section">
      <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!--<ol class="carousel-indicators">
        </ol>-->
        <div class="carousel-inner">
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

</section>
</div>
</header>



<!-- about  -->
<!--<div id="about" class="about">
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
</div>-->
<!-- end abouts -->



<!-- our -->
<!--<div id="important" class="important">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="titlepage">
          <h2><strong class="yellow">AI Resources for Students</strong></h2>
          <h2>Getting Started</h2>
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
</div>-->

<!-- end our -->
<!-- Courses -->
<!--<div id="courses" class="Courses">
  <div class="container-fluid padding_left3">
    <div class="row">
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
        <div class="box_bg">
          <div class="box_bg_img">
            <div class="row">
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <div class="box_my">
                  <figure><img src="images/my1.jpg"></figure>
                  <div class="overlay">
                    <h3>Data Structures</h3>
                    <p>It is a long established fact that a reader will be distracted by the readable content o</p>
                  </div>
                </div>
              </div>
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <div class="box_my">
                  <figure><img src="images/my2.jpg"></figure>
                  <div class="overlay">
                    <h3>Cinematography</h3>
                    <p>It is a long established fact that a reader will be distracted by the readable content o</p>
                  </div>
                </div>
              </div>
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <div class="box_my">
                  <figure><img src="images/my3.jpg"></figure>
                  <div class="overlay">
                    <h3>Skills</h3>
                    <p>It is a long established fact that a reader will be distracted by the readable content o</p>
                  </div>
                </div>
              </div>
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <div class="box_my">
                  <figure><img src="images/my4.jpg"></figure>
                  <div class="overlay">
                    <h3>Teaching Science</h3>
                    <p>It is a long established fact that a reader will be distracted by the readable content o</p>
                  </div>
                </div>
              </div>



            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 border_right">
        <div class="box_text">
          <div class="titlepage">
            <h2>My <strong class="yellow"> Courses</strong></h2>
          </div>
          <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>
          <a href="Javascript:void(0)">Read more</a>
        </div>
      </div> 
    </div>
  </div>
</div>-->
<!-- end Courses -->

<!-- learn -->

<div class="make">
  <div class="container">
    <!-- IRM Capstone Project Summary -->
    <div class="row" style="margin-bottom: 0px;">
      <div class="col-md-12">
        <div class="titlepage" style="text-align: center;">
          <h2>IRM Capstone Project – DJKYD</h2>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <div class="make_text">
          <h2>
            <span style="color: white; display: block;">

              <strong>Overview</strong><br>
              The DJKYD team (David Da Graca, Jacob Abraham, Kamji Shehu, Yasmeen Jabi, Dominic Murphy) developed an AI Support Hub as our final-year capstone project in the Bachelor of Information Technology – Information Resource Management stream. This web-based platform offers Carleton University students and faculty centralized guidance on academic, ethical, and practical use of artificial intelligence. The aim was to foster informed, responsible engagement with AI technologies in learning and teaching environments.

              <br><br>

              <strong>Problem Statement</strong><br>
              With AI tools rapidly entering classrooms, both students and instructors are left unsure about what’s permitted, what’s ethical, and how to use these tools responsibly. The existing Carleton documentation was either scattered, outdated, or overly technical. Our project addressed this gap by creating a user-centered website focused on information clarity, digital literacy, and inclusive design.

              <br><br>

              <strong>Key Components</strong><br>

              <u>1. AI Resource Hub Website</u><br>
              - Built using HTML, CSS, JavaScript, PHP, Flask (for chatbot integration), and MySQL.<br>
              - Provides simplified guides on AI ethics, plagiarism, citation tools, and assignment-specific AI considerations.<br>
              - Includes dynamic search, category filters, and accessibility enhancements to align with WCAG standards.<br>
              - Designed responsively to support both desktop and mobile users.

              <br><br>

              <u>2. Community Forum (phpBB)</u><br>
              - Fully configured and branded phpBB forum hosted on our server.<br>
              - Organized into categories (e.g., Coursework Help, AI Tools Q&A, Policy Discussions).<br>
              - Integrated with MySQL for user registration, moderation, and post management.<br>
              - Seeded with over 20 sample posts to simulate activity and show functionality during demo sessions.<br>
              - Accessible only to Carleton students via a custom login script and email verification.

              <br><br>

              <u>3. AI Chatbot Prototype</u><br>
              - Developed using a lightweight Flask application to handle user input and generate responses locally.<br>
              - Backend written in Python, connected to a small language model hosted via LM Studio on the same machine.<br>
              - Frontend built with basic HTML, CSS, and JavaScript, enabling real-time interaction through a chat window embedded in the homepage.<br>
              - Uses a simplified model to ensure reasonable response times without needing advanced GPU hardware.<br>
              - Current setup includes preloaded FAQ data; future development will integrate Carleton-specific policy documents using vector-based semantic search.<br>
            
              <br><br>

              <u>4. Server Deployment & Security</u><br>
              - Hosted on a DigitalOcean VPS running Ubuntu 22.04.<br>
              - Installed and configured full LAMP stack: Linux, Apache, MySQL, and PHP.<br>
              - All source files managed via GitHub with version control and CI/CD using GitHub Actions.<br>
              - HTTPS enforced using Certbot and Let’s Encrypt SSL.<br>
              - phpMyAdmin used for database management and monitoring.

              <br><br>

              <u>5. Backup & Recovery Plan</u><br>
              - Automated server backups implemented using `rsync` and `cron` to a secure secondary volume.<br>
              - Separate daily database dump via shell script into a compressed archive folder.<br>
              - Manual backup checkpoints maintained after each major feature push for recovery testing.<br>
              - Disaster recovery simulated during testing week—successfully restored to a previous build after database corruption.

              <br><br>

              <strong>Challenges & Lessons Learned</strong><br>
              - Initial chatbot integration was more complex than expected due to token limits and API restrictions; we pivoted to a local model for demo purposes.<br>
              - Styling phpBB to match our website took trial-and-error with template overrides and CSS tweaks.<br>
              - Server setup exposed us to real-world troubleshooting (e.g., port conflicts, database timeouts).<br>
              - Our biggest takeaway: always plan double the time for deployment and testing—final week bugs reminded us of the importance of buffer time.

              <br><br>

              <strong>Future Outlook</strong><br>
              - Train chatbot on actual Carleton policies and connect to course-specific prompts.<br>
              - Expand forum moderation tools and introduce SSO using Carleton credentials.<br>
              - Build faculty-only sections for discussions on academic policy and grading with AI.<br>
              - Conduct broader UX testing with real Carleton users and partner with the university’s TLSS or Library for sustainable adoption.<br>

              <br><br>

              <strong>Conclusion</strong><br>
              This capstone was more than a technical build—it was a community-centered design initiative. We created a solution that bridges knowledge gaps, promotes responsible technology use, and can grow into something with long-term institutional value. Our work reflects not just technical skill, but also our passion for clarity, inclusivity, and digital leadership.

            </span>
          </h2>
        </div>
      </div>
    </div>
  </div>
</div>


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
    <footr>
      <div class="footer ">
        <div class="container">
          <div class="row">

            <!--<div class="col-md-12">
              <form class="news">
                <input class="newslatter" placeholder="Email" type="text" name=" Email">
                <button class="submit">Subscribe</button>
              </form>
            </div>-->
            <div class="col-md-12">
              <h2><br><br></h2>
              <!--<span>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in  </span>-->
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
                  <p>Copyright © 2019 Design by <a href="https://html.design/">Free Html Templates </a></p>
                </div>
              </div>
            </div>
          </footr>
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
