<?php
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
</div>


  <!--<h1 class="Menu">Menu</h1>
  <h3>Served daily from 12.00 to 17.00</h3>-->


    <h1 class="Menu">
      <span style="border-bottom: 1px solid white;"> My Favourite Recipes </span>
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

      $username =  $_COOKIE['username'];

      $sql = "SELECT recipe.Recipe_ID, recipe.Recipe_Poster, recipe.Recipe_Name,
	  recipe.Description, recipe.Ingredients, recipe.Method, recipe.Dietary_Info,
	  recipe.Post_Date, recipe.Image_Link FROM recipe, user_favourites
	  WHERE user_favourites.username = '$username' and user_favourites.Recipe_ID=recipe.Recipe_ID";
	  $result = $conn->query($sql);
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
	  else {
        echo "No Recipes Yet";
      }
      $conn->close();

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
