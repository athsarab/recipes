<?php
// Initialize the session.
// If you are using session_name("something"), don't forget it now!
session_start();

// Unset all of the session variables.
$_SESSION = array();

// If it's desired to kill the session, also delete the session cookie.
// Note: This will destroy the session, and not just the session data!
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finally, destroy the session.
session_destroy();
?>

<!DOCTYPE HTML>
<head>
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
      <a href="index.php"><img style="float: left;" src=Logo.png></a>
      <a href="login.php"><button class = "LogOutButton" style="float: right;">Login</button><a/>
      <a href="account.php"><button class = "RegisterButton" style="float: right;">Register</button><a/>
  </div>

  <div class="navbar">
      <a href="homepage.php"><button class = "navBarButtons" style="float: left;">Home</button></a>
      <a href="menu.php"><button class = "navBarButtons" style="float: left;">Menu</button></a>
      <a href="about.php"><button class = "navBarButtons" style="float: left;">About</button></a>
      <a href="myrecipes.php"><button class = "navBarButtons" style="float: right;">My Recipes</button></a>
	  <a href="favourites.php"><button class = "navBarButtons" style="float: right;">My Favourites</button></a>

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
