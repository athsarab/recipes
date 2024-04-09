<!DOCTYPE HTML>
<head>
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
    <a href="login.php"><button class = "LogOutButton" style="float: right">Login</button><a/>
    <a href="account.php"><button class = "RegisterButton" style="float: right">Register</button><a/>
  </div>

  <div class="navbar">
    <a href="homepage.php"><button class = "navBarButtons" style="float: left">Home</button></a>
    <a href="menu.php"><button class = "navBarButtons" style="float: left">Menu</button></a>
    <a href="about.php"><button class = "navBarButtons" style="float: left">About</button></a>
    <a href="myrecipes.php"><button class = "navBarButtons" style="float: right">My Recipes</button></a>
</div>


  <!--<h1 class="Menu">Menu</h1>
  <h3>Served daily from 12.00 to 17.00</h3>-->


    <h1 class="Menu">
      <span style="border-bottom: 1px solid white;"> Menu </span>
    </h1>

    <div class="grid-container">
  <!--
      <form action="menu.php" method="POST" enctype="multipart/form-data">
        <label>ID:</label>
        <input type="text" name="recipe_id">
        <input type="file" name="image">
        <input type="submit" name="submit">                   //HTML CODE TO UPLOADE IMAGES TO DATABASE
      </form>
-->

<?php
      include_once 'webpages/dbinfo.php';

      if (isset($_POST['submit']))
      {
        $file = $_FILES['image']['name'];
        $id = $_POST['recipe_id'];

        $query = "UPDATE recipe
                  SET Image_Link='$file'
                  WHERE Recipe_ID='$id';";

        $res = mysqli_query($conn,$query);

        if ($res) {
          move_uploaded_file($_FILES['image']['tmp_name'], "uploads/$file");
        }
      }


      $sql = "SELECT * FROM recipe;";
      $result = mysqli_query($conn, $sql);
      $verifyResult = mysqli_num_rows($result);
      if ($verifyResult > 0) {
          while ($row = mysqli_fetch_assoc($result)) {

            echo '<div class="grid-item"><div class="grid-text"><br>';
            echo '<a href = "viewrecipe.php" onclick="myFunction(' .$row['Recipe_ID'] . ')"><img src=uploads/' . $row['Image_Link'] . '.jpg' . '></a><br>';
            echo $row['Recipe_Name'];
            echo '<br><br>' . 'Recipe by ' . $row['Recipe_Poster'];
            echo '</div></div>';
          }
      }


 ?>

  </div>

  <script>

  function myFunction(parameter) {
    setCookie("_id",parameter,10);
  }

  function setCookie(name, value, days) {
  var d = new Date();
  d.setTime(d.getTime() + (days*24*60*60*1000));
  var expires = "expires="+ d.toUTCString();
  document.cookie = name + "=" + value + ";" + expires + ";path=/";
}

  </script>



</body>
