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
                      <li class="active"> <a href="#courses">Students</a> </li>
                      <li> <a href="faculty-page.html">Faculty</a> </li>
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


<div id="learn" class="learn">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="titlepage">
        <h2><strong class="yellow">AI Resources for Students</strong></h2><br><br>
          <h2>Getting Started<strong class="yellow"></strong></h2>
          <span><a href="https://www.ibm.com/think/topics/artificial-intelligence"><u>What is artificial intelligence (AI)?</u></a></span><br>
          <span><a href="https://www.ibm.com/think/topics/ai-ethics#:~:text=Examples%20of%20AI%20ethics%20issues,%2C%20trust%2C%20and%20technology%20misuse."><u>What is AI ethics?</u></a></span><br>
          <span><a href="https://hai.stanford.edu/ai-index"><u>Stanford AI Index</u></a></span><br>
          <span><a href="https://www.weforum.org/stories/emerging-technologies/"><u>World Economic Forum: Emerging Technologies</u></a></span><br>
          <span><a href="https://www.cisco.com/c/m/en_us/solutions/ai/readiness-index.html"><u>Cisco 2024 AI Readiness Index</u></a></span><br>
          <span><a href="https://carleton.ca/mpnl/2023/webinar-called-opportunities-challenges-of-artificial-intelligence-for-the-sector/"><u>Opportunities & Challenges of Artificial Intelligence for the Sector (Video)</u></a></span><br>
          <span><a href="https://carleton.ca/sppa/category/research-themes/digital-government-data-ai/"><u>Posts sorted by Digital Government (Data & AI)</u></a></span><br>
          <span><a href="https://ised-isde.canada.ca/site/public-opinion-research/en/views-canadians-artificial-intelligence-final-report"><u>Views of Canadians on Artificial Intelligence: Final Report</u></a></span><br><br><br>
         
          <h2>Govermental Policies<strong class="yellow"></strong></h2>
          <span><a href="https://ised-isde.canada.ca/site/innovation-better-canada/en/artificial-intelligence-and-data-act"><u>Government of Canada Artificial Intelligence and Data Act</u></a></span><br>
          <span><a href="https://uwindsor-law.libguides.com/AI/Regulation"><u>Artificial Intelligence Regulation: Legislation and Bills</u></a></span><br>
          <span><a href="https://www.ontario.ca/page/ontarios-trustworthy-artificial-intelligence-ai-framework"><u>Ontario’s Trustworthy Artificial Intelligence (AI) Framework</u></a></span><br><br><br>
          
          <h2>General Carleton Policies/Guidelines<strong class="yellow"></strong></h2>
          <span><a href="https://library.carleton.ca/about/policies/electronic-resources-acceptable-use-policy"><u>Electronic Resources Acceptable Use Policy</u></a></span><br>
          <span><a href="https://carleton.ca/its/2024/copilot-university-recommended-generative-ai-platform/"><u>Microsoft Copilot is the University’s Recommended Generative AI Platform</u></a></span><br><br><br>
         
          <h2>Coursework Support<strong class="yellow"></strong></h2>
          <span><a href="https://library.carleton.ca/guides/subject/artificial-intelligence-ai-tools"><u>Artificial Intelligence (AI) - Tools</u></a></span><br>
          <span><a href="https://library.carleton.ca/guides/help/brainstorming-ai"><u>Brainstorming with AI</u></a></span><br>
          <span><a href="https://library.carleton.ca/guides/help/generative-ai-chatgpt-and-citations"><u>Generative AI / ChatGPT and Citations</u></a></span><br>
          <span><a href="https://library.carleton.ca/guides/help/interacting-ai-chatbots"><u>Interacting with AI Chatbots</u></a></span><br>
          <span><a href="https://library.carleton.ca/guides/clarifying-concepts-ai"><u>Clarifying Concepts with AI</u></a></span><br>
          <span><a href="https://library.carleton.ca/copyright/generative-ai-tools-copyright-considerations"><u>Generative AI tools and Copyright Considerations</u></a></span><br>
          <span><a href="https://carleton.ca/tim/wp-content/uploads/sites/52/2025/03/Guide-to-Produce-Scoping-Reviews-Using-AI-tools-one-file-March-8.pdf"><u>Guide to Produce Scoping Literature Reviews Using AI Tools</u></a></span><br><br><br>

          <h2>Skills Development<strong class="yellow"></strong></h2>
          <span><a href="https://www.jff.org/idea/skills-and-talent-development-in-the-age-of-ai/"><u>Skills and Talent Development in the Age of AI</u></a></span><br>
          <span><a href="https://carleton.ca/tls/future-learning-lab/fusion/"><u>FUSION Skills Development Program (Including an AI Literacy Module)</u></a></span><br>
          <span><a href="https://carleton.ca/dsaai/"><u>Data Science, Analytics, and Artificial Intelligence Program</u></a></span><br>
          <span><a href="https://admissions.carleton.ca/programs/ai-and-machine-learning/"><u>Artificial Intelligence and Machine Learning Program</u></a></span><br>
          <span><a href="https://fsc-ccf.ca">Funded by the Government of Canada: <u>Future Skills Centre</u></a></span>
          <span><a href="https://fsc-ccf.ca/?s=&tab=All&themes=ai"> and <u>Visit the AI Focus Area</u></a></span><br><br><br>

          <h2>Career Support<strong class="yellow"></strong></h2>
          <span><a href="https://carleton.ca/career/competencies/"><u>Discover Carleton’s Career Competencies</u></a></span><br>
          <span><a href="https://carleton.ca/career/job-search-support/job-postings/"><u>Job Postings and More</u></a></span><br>
          <span><a href="https://carleton.ca/co-op/"><u>Co-operative Education</u></a></span><br>
          <span><a href="https://carleton.ca/innovationhub/"><u>Innovation Hub</u></a></span><br>
          <span><a href="https://www.carletonpathwaysinstem.com"><u>Carleton Pathways In STEM</u></a></span><br>
          <span><a href="https://carleton.ca/career/job-search-support/target-your-job-search/"><u>Using AI for Your Job Search</u></a></span><br>
          <span><a href="https://alumni.carleton.ca/services/career-assistance/"><u>Carleton Alumni Career Assistance</u></a></span><br>
          <span><a href="https://hbr.org/2023/04/5-ways-to-future-proof-your-career-in-the-age-of-ai"><u>Harvard Business Review: 5 Ways to Future-Proof Your Career in the Age of AI</u></a></span><br>
          <span><a href="https://www.mckinsey.com/capabilities/mckinsey-digital/our-insights/superagency-in-the-workplace-empowering-people-to-unlock-ais-full-potential-at-work"><u>2025 Report: Superagency in the workplace: Empowering people to unlock AI’s full potential</u></a></span><br>
          <span><a href="https://intelligence.weforum.org/topics/a1Gb0000000pTDREA2/key-issues/a1Gb00000017LD8EAM"><u>World Economic Forum: AI and Jobs</u></a></span><br>
          <span><a href="https://carleton.ca/panl/2024/navigator-ai-tool-for-the-nonprofit-sector/"><u>Navigator: AI Tool for the Nonprofit Sector</u></a></span><br>
          <span><a href="https://www.canadastop100.com/tcd/"><u>Canada’s Top 100 Employer Career Directory</u></a></span><br><br><br>

          <h2>Learn by Participating in Events and Communities<strong class="yellow"></strong></h2>
          <span><a href="https://carletonai.com"><u>Join the Carleton AI Society</u></a></span><br>
          <span><a href="https://bitsoc.ca"><u>Join the Bachelor of Information Technology Society (BITsoc)</u></a></span><br>
          <span><a href="https://carleton.ca/nmai/"><u>Network Management and Artificial Intelligence Lab</u></a></span><br>
          <span><a href="https://carleton.ca/tim/trustworthy-ai-lab/"><u>Trustworthy AI Lab</u></a></span><br>
          <span><a href="https://library.carleton.ca/library-news/visit-exhibit-ai-imagery-and-global-health-until-april-4"><u>Visit the exhibit on AI, Imagery, and Global Health until April 4</u></a></span><br>
          <span><a href="https://carleton.ca/challengeconference/"><u>The AI Summit – Navigating Disruption and Transformation (May 13th)</u></a></span><br>
          <span><a href="https://tlscarleton.apprendo.io/tls-events/8246#/"><u>HOAI Series: Students' Use of AI – A Student Panel (April 15th)</u></a></span><br><br><br>

          <h2>Reach out for Further Support<strong class="yellow"></strong></h2>
          <span><a href="https://newsroom.carleton.ca/2023/carleton-experts-available-artificial-intelligence/"><u>Carleton Experts Available: Artificial Intelligence</u></a></span><br>
          <span><a href="career@carleton.ca"><u>Career Support: career@carleton.ca</u></a></span><br>
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

<div class="make">
  <div class="container">
    <!-- Centered BIT Programs Title with Reduced Space -->
    <div class="row" style="margin-bottom: 0px;">
      <div class="col-md-12">
        <div class="titlepage" style="text-align: center;">
          <h2>BIT Programs</h2>
        </div>
      </div>
    </div>

<!-- the programs -->
<div class="make">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="titlepage">
          <h2> Information Resource Management<strong class="white_colo"> (IRM) </strong></h2>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">  <!-- Full width column -->
        <div class="make_text">
          <h2> 
            <span style="color: white; display: block;">
              IRM offers a dynamic combination of a Bachelor of Information Technology and a Library Technician Diploma, designed to equip students with the skills required for a career in digital information management. Through a unique partnership between Carleton University and Algonquin College, this program blends academic theory with real-world application. You’ll learn to manage digital resources, design data systems, and understand the complexities of e-commerce and web design, all while gaining practical experience through state-of-the-art labs and co-op opportunities. Graduating with both a major and a minor degree, IRM prepares you to work in a range of industries, from government agencies to private tech firms.
            </span>
            <br>
          </h2>
          <!-- Skills Section for IRM -->
          <div class="important_bg" style="margin-top: 0; padding-top: 0;">
            <div class="row">
              <div class="col-12">
                <div class="important_box" style="text-align: left; margin-top: 5px;">
                  <span style="font-size: 22px; color: #f4b328ff; display: inline;">
                    <b> Skills: </b>
                  </span>
                  <span style="font-size: 22px; color: white; display: inline;">
                    Data Management, Programming, Information Systems, Database Development, Information Organization, Web Development, Data Analytics, Information Retrieval, UX Design, Digital Resources.
                  </span>
                </div>
              </div>
            </div>
          </div> 
        </div>
      </div>
    </div> 
    <!-- Now, NET section with the same styling -->
    <div class="row" style="margin-top: 30px;"> 
      <div class="col-md-12">
        <div class="titlepage">
          <h2> Network Technology<strong class="white_colo"> (NET) </strong></h2>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">  <!-- Full width column -->
        <div class="make_text">
          <h2> 
            <span style="color: white; display: block;">
              NET offers a dynamic combination of a Bachelor of Network Technology and a Library Technician Diploma, designed to equip students with the skills required for a career in network management. Through a unique partnership between Carleton University and Algonquin College, this program blends academic theory with real-world application. You’ll learn to manage network systems, design data infrastructure, and understand the complexities of e-commerce and web design, all while gaining practical experience through state-of-the-art labs and co-op opportunities. Graduating with both a major and a minor degree, NET prepares you to work in a range of industries, from government agencies to private tech firms.
            </span>
            <br>
          </h2>
          <div class="important_bg" style="margin-top: 0; padding-top: 0;">
            <div class="row">
              <div class="col-12">
                <div class="important_box" style="text-align: left; margin-top: 5px;"> <!-- Reduced space before 'Skills:' -->
                  <span style="font-size: 22px; color: #f4b328ff; display: inline;">
                    <b> Skills: </b>
                  </span>
                  <span style="font-size: 22px; color: white; display: inline;">
                    Networking, Cyber Security, System Administration, Network Protocols, Routing & Switching, Cloud Computing, IT Infrastructure, Troubleshooting, Communication, Problem-Solving.
                  </span>
                </div>
              </div>
            </div>
          </div> 
        </div>
      </div>
    </div>   
    <!-- Now, IMD section with the same styling -->
    <div class="row">
      <div class="col-md-12">
        <div class="titlepage">
          <h2>Interactive Multimedia and Design<strong class="white_colo"> (IMD)</strong></h2>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">  <!-- Full width column -->
        <div class="make_text">
          <h2> 
            <span style="color: white; display: block;">
              The IMD program offers a unique multidisciplinary education combining creativity, technology, and practical experience. With a Bachelor of Information Technology from Carleton University and an Advanced Diploma of Applied Arts from Algonquin College, you’ll gain the skills to excel in the digital media sector. Specializing in areas like web design, 2D/3D animation, game development, visual effects, and human-computer interaction, this program prepares you for a career in the rapidly growing digital world. The program also offers specialized streams and co-op opportunities for hands-on experience with top tech companies.
            </span>
            <br>
          </h2>
          <div class="important_bg" style="margin-top: 0; padding-top: 0;">
            <div class="row">
              <div class="col-12">
                <div class="important_box" style="text-align: left; margin-top: 5px;"> <!-- Reduced space before 'Skills:' -->
                  <span style="font-size: 22px; color: #f4b328ff; display: inline;">
                    <b> Skills: </b>
                  </span>
                  <span style="font-size: 22px; color: white; display: inline;">
                    Web Design, 3D Animation, Game Development, Visual Effects, Human-Computer Interaction, UI/UX Design, Programming, Virtual Reality, Project Management, Digital Storytelling.
                  </span>
                </div>
              </div>
            </div>
          </div>                         
        </div>
      </div>
    </div>  
    <!-- Now, OSS section with the same styling -->
    <div class="row">
      <div class="col-md-12">
        <div class="titlepage">
          <h2>Optical Systems & Sensors<strong class="white_colo"> (OSS)</strong></h2>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">  <!-- Full width column -->
        <div class="make_text">
          <h2> 
            <span style="color: white; display: block;">
              OSS offers a unique multidisciplinary education that combines the integration of optical systems, signal processing, and sensor technologies. With a Bachelor of Information Technology from Carleton University and an Advanced Photonics Technology Diploma from Algonquin College, you’ll gain specialized skills in optical communication, laser technology, and remote sensing. Specializing in areas like autonomous vehicles, medical imaging, and biophotonics, this program prepares you for a rewarding career in industries such as defense, communications, and healthcare. The program also offers co-op opportunities with leading companies, ensuring you gain hands-on experience and are job-ready upon graduation.
            </span>
            <br>
          </h2>
          <div class="important_bg" style="margin-top: 0; padding-top: 0;">
            <div class="row">
              <div class="col-12">
                <div class="important_box" style="text-align: left; margin-top: 5px;"> <!-- Reduced space before 'Skills:' -->
                  <span style="font-size: 22px; color: #f4b328ff; display: inline;">
                    <b> Skills: </b>
                  </span>
                  <span style="font-size: 22px; color: white; display: inline;">
                    Optical Communications, Computer Vision, LIDAR, Laser Technology, Signal & Image Processing, Optoelectronic Devices, Remote Sensing, Programming, Problem-Solving, Communication.
                  </span>
                </div>
              </div>
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
