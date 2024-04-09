<?php
session_start();

require 'loginconfirm.php';
$logincon = new loginconfirm();

if($_POST && !empty($_POST['UserID']) && !empty($_POST['Password'])) {
    $response = $logincon->validate_user($_POST['UserID'], $_POST['Password']);
    $username = $_POST['UserID'];
    setCookie("username",$username, time()+3600);
}
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
      <a href="account.php"><button class = "RegisterButton" style="float: right;">Register</button><a/>
  </div>

  <div class="navbar">
    <a href="index.php"><button class = "navBarButtons" style="float: left;">Home</button></a>
    <a href="aboutloggedout.php"><button class = "navBarButtons" style="float: left;">About</button></a>
  </div>

  <div class="register-box">
  <h1>Login</h1>
  <form action="" method="POST">
    <div class="textbox">
    <input type = "text" name = "UserID" placeholder="Username">
    </div>
	  <div class = "textbox">
    <input type = "password" name = "Password" placeholder="Password">
    </div>
	  <input class="button ForgottenPasswordButton" type ="submit" name="submit" value ="Forgotten Password">
	  <input class = "button LogOutButton" type = "submit" name =  "submit" value = "Login" >
  </form>
  <?php if(isset($response)) { echo "<h4>" . $response . "</h4>"; } ?>

  </div>


    <script>



    function setCookie(name, value, days) {
    var d = new Date();
    d.setTime(d.getTime() + (days*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = name + "=" + value + ";" + expires + ";path=/";
  }

    </script>



</body>
