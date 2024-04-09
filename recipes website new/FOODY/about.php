<?php
$username = $_COOKIE['username'];
?>
<!DOCTYPE HTML>
<head>
  <link rel="stylesheet" href="./CSS/Header.css">
  <link rel="stylesheet" href="./CSS/Navbar.css">
  <link rel="stylesheet" href="./CSS/Background.css">
  <link rel="stylesheet" href="./CSS/register.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <script src="deletecookies.js"></script>
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
</div>

  <div class="background">
    <div class="description">
      <span style="color:white">UniFoodie is a website for students, made by students that helps tailor food recipes and drinks (alcoholic ones of course) to your personal profile.<br>
      We know how daunting it can be starting to cook by yourself for the first time so we are here to help.<br> All of our recipes are budget-friendly, and
      can be made with any skillset, from the newest to more experienced. <br> We hope you enjoy your stay :)
      </span>

  </div>

</body>
