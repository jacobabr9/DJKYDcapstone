<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Basic meta tags and CSS files -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Mind - Career News</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/responsive.css">
  <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">

  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f9fc;
      color: #333;
    }
    h1, h2 {
      color: #1a73e8;
    }
    header {
      background-color: #1a73e8;
      padding: 15px 0;
      color: white;
    }
    .header .logo img {
      width: 150px;
    }
    .search-bar {
      margin-top: 30px;
      margin-bottom: 30px;
      text-align: center;
    }
    .search-bar select, .search-bar input {
      padding: 10px;
      font-size: 16px;
      margin-right: 10px;
    }
    .articles {
      display: flex;
      flex-direction: column;
      gap: 20px;
    }
    .article {
      background-color: #ffffff;
      padding: 15px;
      border-radius: 8px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .article h3 {
      font-size: 22px;
      margin-bottom: 10px;
    }
    .article p {
      font-size: 16px;
    }
    footer {
      background-color: #1a73e8;
      padding: 20px 0;
      color: white;
      text-align: center;
    }
  </style>
</head>

<body>

  <!-- Header Section -->
  <header>
    <div class="container">
      <div class="row">
        <div class="col-12 text-center">
          <div class="logo">
            <a href="index.php"><img src="images/colorized.png" alt="Logo" /></a>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Search Bar Section -->
  <div class="container search-bar">
    <h2>Career News</h2>
    <form method="get" action="">
        <label for="career_path">Choose a Career Path:</label>
        <select name="career_path" id="career_path">
            <option value="all" <?php if ($career_path_id == 'all') echo 'selected'; ?>>All Career Paths</option>
            <?php
            // Display career paths in dropdown
            while ($row = $career_result->fetch_assoc()) {
                echo "<option value='" . $row['CareerID'] . "' " . ($career_path_id == $row['CareerID'] ? 'selected' : '') . ">" . htmlspecialchars($row['CareerPathName']) . "</option>";
            }
            ?>
        </select>
        <input type="submit" value="Search" class="btn btn-primary">
    </form>
  </div>

  <!-- Main Content Section -->
  <div class="container">
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

    <!-- Display Articles -->
    <div class="articles">
      <?php
      // Display the articles based on the selected Career Path
      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              $link = htmlspecialchars($row['Link']);
              $title = htmlspecialchars($row['Title']);
              $careerPath = htmlspecialchars($row['CareerPathName']);
              echo "<article class='article'>";
              echo "<h3><a href='" . ($link ? $link : '#') . "' target='_blank'>" . $title . "</a></h3>";
              echo "<p><strong>Career Path:</strong> " . $careerPath . "</p>";
              echo "</article>";
          }
      } else {
          echo "<p>No articles found for this career path.</p>";
      }
      ?>
    </div>

    <?php
    $mysqli->close();
    ?>
  </div>

  <!-- Footer Section -->
  <footer>
    <p>&copy; 2025 Mind - Career News | All rights reserved.</p>
  </footer>

</body>
</html>
