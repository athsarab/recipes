

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
      <a href="homepage.php"><img style="float: left;" src=Logo.png></a>
      <a href="account.php"><button class = "RegisterButton" style="float: right">Register</button><a/>
  </div>

  <div class="navbar">
    <a href="homepage.php"><button class = "navBarButtons" style="float: left">Home</button></a>
    <a href="menu.php"><button class = "navBarButtons" style="float: left">Menu</button></a>
    <a href="about.php"><button class = "navBarButtons" style="float: left">About</button></a>
  </div>

  <div class="register-box">
    <h1>Log Out</h1>
    <div>
    <h3>Are you sure?</h3>
    </div>
    <button class="button LogOutButton" onclick="window.location.href='homepage.php'">Yes</button>
    <button class="button LogOutButton" onclick="window.location.href='userHomePage.php'">No</button>
  </div>
</body>
