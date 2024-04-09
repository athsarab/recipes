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

      <input type="text" name="search" class="searchbox" >
      <button type="submit" name="submit">Search</button>
    </form>
  </div>

  <div class="background">

    <div class="grid-container">
      <div><img src=Burger.webp></div>

      <div class="container">
      <h2>UniFoodie</h2>
      <h3>Recipes for students</h3>
      </div>

    </div>

  </div>
</body>
