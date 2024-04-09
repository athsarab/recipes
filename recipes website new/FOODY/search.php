<?php
  include_once 'webpages/dbinfo.php';
  $username = $_COOKIE['username'];
 ?>

<!DOCTYPE HTML>
<head>
  <script src="deletecookies.js"></script>
  <link rel="stylesheet" href="./CSS/Header.css">
  <link rel="stylesheet" href="./CSS/Navbar.css">
  <link rel="stylesheet" href="./CSS/Background.css">
  <link rel="stylesheet" href="./CSS/Menu.css">
  <link rel="stylesheet" href="./CSS/register.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@200&display=swap" rel="stylesheet">
</head>

<body>
  <div class="header">
      <h1>UniFoodie</h1>
      <a href="homepage.php"><img style="float: left;" src=Logo.png></a>
      <a href="index.php"><button class = "LogOutButton" style="float: right;" onclick="deleteAllCookies()">Log Out</button><a/>
	  <button class = "LogOutButton" style="float: right; width: 100px;"><?php echo "Welcome " . $username . "!";?></button>
  </div>

  <div class="navbar">
      <a href="homepage.php"><button class = "navBarButtons" style="float: left;">Home</button></a>
      <a href="menu.php"><button class = "navBarButtons" style="float: left;">Menu</button></a>
      <a href="about.php"><button class = "navBarButtons" style="float: left;">About</button></a>
      <a href="myrecipes.php"><button class = "navBarButtons" style="float: right;">My Recipes</button></a>
	  <a href="favourites.php"><button class = "navBarButtons" style="float: right;">My Favourites</button></a>

    <form class="searchform" action="search.php" method="POST">
      <input type="text" name="search" class="searchbox">
      <button type="submit" name="submit">Search</button>
    </form>
  </div>




<div class="grid-container">

<?php
  include_once 'webpages/dbinfo.php';
 ?>

<?php
  if (isset($_POST['submit'])) {
    $search = mysqli_real_escape_string($conn, $_POST['search']);      //prevents SQL injection
    $sql = "SELECT * FROM recipe WHERE Recipe_Name LIKE '%$search%' OR  Recipe_Poster LIKE '%$search%'";
    $result = mysqli_query($conn, $sql);
    $queryResult = mysqli_num_rows($result);

    if ($queryResult > 0) {
        while ($row = mysqli_fetch_assoc($result)) {

          echo '<div class="grid-item"><div class="grid-text"><br>';
          echo '<a href = "viewrecipe.php"><img src=uploads/' . $row['Image_Link'] . '></a><br>';
          echo $row['Recipe_Name'];
          echo '</div></div>';
        }
    } else {
      echo '<span style="color:white">There are no results matching your search</span>';
    }

  }

 ?>

  </div>

</body>
