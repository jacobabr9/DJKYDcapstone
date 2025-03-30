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
                      <li> <a href="index.php">Home</a> </li>
                      <li> <a href="students-page.html">Students</a> </li>
                      <li class="active"> <a href="#about">Faculty</a> </li>
                      <li> <a href="#learn">Community</a> </li>
                      <li> <a href="#important">Ask AI</a> </li>
                      <li> <a href="#contact">News</a> </li>
                      <li> <a href="#contact">My Profile</a> </li>
                     </ul>
                   </nav>
                 </div>
               </div> 
               <div class="mean-last">
                       <a href="#"><img src="images/search_icon.png" alt="#" /></a> <a href="student-login.php">Sign Up/Login</a></div>              
             </div>
           </div>
         </div>
       </div>
     </div>
     <!-- end header inner -->

     <?php
// Start the session
session_start();

// Check if the user is logged in and if they are a student
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'faculty') {
    // If the user is not logged in or is not a student, show an error message
    echo "<p>You must be logged in as faculty to view this page.</p>";
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

<!-- learn -->

<div id="learn" class="learn">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="titlepage">
        <h2><strong class="yellow">AI Resources for Faculty</strong></h2><br><br>
          <h2>Getting Started<strong class="yellow"></strong></h2>
          <span><a href="https://www.ibm.com/think/topics/artificial-intelligence"><u>What is artificial intelligence (AI)?</u></a></span><br>
          <span><a href="https://www.ibm.com/think/topics/ai-ethics#:~:text=Examples%20of%20AI%20ethics%20issues,%2C%20trust%2C%20and%20technology%20misuse."><u>What is AI ethics?</u></a></span><br>
          <span><a href="https://carleton.ca/tls/teachingresources/generative-artificial-intelligence/"><u>Teaching and Learning Services (TLS) Teaching Resources for Generative AI</u></a></span><br>
          <span><a href="https://hai.stanford.edu/ai-index"><u>Stanford AI Index</u></a></span><br>
          <span><a href="https://www.cisco.com/c/m/en_us/solutions/ai/readiness-index.html"><u>Cisco 2024 AI Readiness Index</u></a></span><br>
          <span><a href="https://www.ibm.com/think/topics/ai-ethics#:~:text=Examples%20of%20AI%20ethics%20issues,%2C%20trust%2C%20and%20technology%20misuse."><u>What is AI ethics?</u></a></span><br>
          <span><a href="https://carleton.ca/sppa/category/research-themes/digital-government-data-ai/"><u>Posts sorted by Digital Government (Data & AI)</u></a></span><br><br><br>
         
          <h2>Govermental Policies<strong class="yellow"></strong></h2>
          <span><a href="https://ised-isde.canada.ca/site/innovation-better-canada/en/artificial-intelligence-and-data-act"><u>Government of Canada Artificial Intelligence and Data Act</u></a></span><br>
          <span><a href="https://uwindsor-law.libguides.com/AI/Regulation"><u>Artificial Intelligence Regulation: Legislation and Bills</u></a></span><br>
          <span><a href="https://www.ontario.ca/page/ontarios-trustworthy-artificial-intelligence-ai-framework"><u>Ontario’s Trustworthy Artificial Intelligence (AI) Framework</u></a></span><br><br><br>
          
          <h2>General Carleton Policies/Guidelines<strong class="yellow"></strong></h2>
          <span><a href="https://library.carleton.ca/about/policies/electronic-resources-acceptable-use-policy"><u>Electronic Resources Acceptable Use Policy</u></a></span><br>
          <span><a href="https://carleton.ca/tls/teachingresources/recommendations-and-guidelines/"><u>Generative AI Recommendations and Guidelines</u></a></span><br>
          <span><a href="https://carleton.ca/its/2024/copilot-university-recommended-generative-ai-platform/"><u>Microsoft Copilot is the University’s Recommended Generative AI Platform</u></a></span><br><br><br>
         
          <h2>Planning Your Course(s)<strong class="yellow"></strong></h2>
          <span><a href="https://carleton.ca/tls/teachingresources/sample-syllabus-statements-for-ai-use-in-courses/"><u>Sample syllabus statements for AI use in courses</u></a></span><br><br><br>

          <h2>How to Support Students<strong class="yellow"></strong></h2>
          <span><a href="https://carleton.ca/tls/teachingresources/teaching-without-the-use-of-ai/"><u>Teaching Without the Use of AI</u></a></span><br>
          <span><a href="https://carleton.ca/tls/teachingresources/generative-artificial-intelligence/generative-artificial-intelligence-in-the-classroom/"><u>Generative Artificial Intelligence in the Classroom</u></a></span><br>
          <span><a href="https://library.carleton.ca/services/library-instruction"><u>Getting Library Instruction</u></a></span><br>
          <span><a href="https://library.carleton.ca/guides/help/generative-ai-chatgpt-and-citations"><u>Generative AI / ChatGPT and Citations</u></a></span><br><br><br>

          <h2>Reports<strong class="yellow"></strong></h2>
          <span><a href="https://carleton.ca/tls/teachingresources/wp-content/uploads/The-Use-of-AI-in-Teaching-and-Learning-2023.pdf"><u>AI in Teaching at Carleton: Opportunities and Challenges</u></a></span><br>
          <span><a href="https://www.weforum.org/stories/emerging-technologies/"><u>World Economic Forum: Emerging Technologies</u></a></span><br>
          <span><a href="https://www.jff.org/idea/skills-and-talent-development-in-the-age-of-ai/"><u>Skills and Talent Development in the Age of AI</u></a></span><br>
          <span><a href="https://ised-isde.canada.ca/site/public-opinion-research/en/views-canadians-artificial-intelligence-final-report"><u>Views of Canadians on Artificial Intelligence: Final Report</u></a></span><br><br><br>

          <h2>Participation and Learning Opportunities<strong class="yellow"></strong></h2>
          <span><a href="https://tlscarleton.apprendo.io/tls-events#/"><u>Teaching and Learning Services (TLS) Events Page</u></a></span><br>
          <span><a href="https://carleton.ca/nmai/"><u>Network Management and Artificial Intelligence Lab</u></a></span><br>
          <span><a href="https://carleton.ca/tim/trustworthy-ai-lab/"><u>Trustworthy AI Lab</u></a></span><br>
          <span><a href="https://library.carleton.ca/feature/library-launches-genai-quickstart-course-brightspace"><u>Library launches GenAI Quickstart course for Faculty in Brightspace</u></a></span><br>
          <span><a href="https://carleton.ca/tls/future-learning-lab/fusion/"><u>FUSION Skills Development Program (Including an AI Literacy Module)</u></a></span><br>
          <span><a href="https://library.carleton.ca/library-news/visit-exhibit-ai-imagery-and-global-health-until-april-4"><u>Visit the exhibit on AI, Imagery, and Global Health until April 4</u></a></span><br>
          <span><a href="https://tlscarleton.apprendo.io/tls-events/8245#/"><u>HOAI Series: Integrating AI into Teaching and Learning (April 8th)</u></a></span><br>
          <span><a href="https://carleton.ca/challengeconference/"><u>The AI Summit – Navigating Disruption and Transformation (May 13th)</u></a></span><br>
          <span><a href="https://tlscarleton.apprendo.io/tls-events/8246#/"><u>HOAI Series: Students' Use of AI – A Student Panel (April 15th)</u></a></span><br><br><br>

          <h2>Reach out for Further Support<strong class="yellow"></strong></h2>
          <span><a href="https://newsroom.carleton.ca/2023/carleton-experts-available-artificial-intelligence/"><u>Carleton Experts Available: Artificial Intelligence</u></a></span><br>
          <span><a href="https://carleton.ca/tls/contact-us/"><u>Contact Teaching and Learning Services</u></a></span><br>
          <span><a href="https://library.carleton.ca/contact"><u>Contact the MacOdrum Library</u></a></span>
          <span> or</span>
          <span><a href="askthelibrary@carleton.ca"><u>askthelibrary@carleton.ca</u></a></span><br>
          <span><a href="https://carleton.ca/its/contact/"><u>Contact Information Technology Services (ITS)</u></a></span>

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
<!-- MAKE --> 
<div class="make">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="titlepage">
          <h2> <strong class="white_colo"></strong></h2>
        </div>
      </div>
    </div>
    <!--<div class="row">
      <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12">
        <div class="make_text">
          <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.
          </p>
          <a href="Javascript:void(0)">Strat now</a>
        </div>
      </div>
      <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12">
        <div class="make_img">
          <figure><img src="images/make_img.jpg"></figure>
        </div>
      </div>
    </div>-->
  </div>
</div>
<!-- end MAKE --> 
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
