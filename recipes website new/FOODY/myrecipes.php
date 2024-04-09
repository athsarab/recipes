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
    <a href="addrecipe.php"><button class = "navBarButtons" style="float: right">+ Add Recipe</button></a>
    <a href="myrecipes.php"><button class = "navBarButtons" style="float: right;">My Recipes</button></a>
	<a href="favourites.php"><button class = "navBarButtons" style="float: right;">My Favourites</button></a>
</div>


    <h1 class="Menu">
      <span style="border-bottom: 1px solid white;"> My Recipes </span>
    </h1>

    <div class="grid-container">

<?php
include_once 'webpages/dbinfo.php';

$username =  $_COOKIE['username'];

$sql = "SELECT * FROM recipe WHERE Recipe_Poster = '$username';";
$result = mysqli_query($conn, $sql);
$verifyResult = mysqli_num_rows($result);
if ($verifyResult > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="grid-item"><div class="grid-text"><br>';
        echo '<a href = "viewrecipe.php" onclick="myFunction(' .$row['Recipe_ID'] . ')"><img src=uploads/' . $row['Image_Link'] . '.jpg' . '></a><br>';
        echo $row['Recipe_Name'];

        // Update Button
        echo '<form action="updaterecipe.php" method="get">
                <input type="hidden" name="recipe_id" value="' . $row['Recipe_ID'] . '">
                <button type="submit" name="update_btn">Update</button>
              </form>';

        // Delete Button
        echo '<form method="post" action="">
                <input type="hidden" name="delete_id" value="' . $row['Recipe_ID'] . '">
                <button type="submit" name="delete_btn">Delete</button>
              </form>';

        echo '</div></div>';
    }
}

// Delete Recipe
if (isset($_POST['delete_btn'])) {
    $delete_id = $_POST['delete_id'];

    // Delete related entries from recipe_review table first
    $delete_reviews_query = "DELETE FROM recipe_review WHERE Recipe_ID = '$delete_id'";
    mysqli_query($conn, $delete_reviews_query);

    // Then delete related entries from user_favourites table
    $delete_favorites_query = "DELETE FROM user_favourites WHERE Recipe_ID = '$delete_id'";
    mysqli_query($conn, $delete_favorites_query);

    // Then delete the recipe
    $delete_query = "DELETE FROM recipe WHERE Recipe_ID = '$delete_id'";
    mysqli_query($conn, $delete_query);

   // header("Location: myrecipes.php"); // Redirect to refresh the page
    exit();
}
?>

  </div>

  <script>
    function myFunction(parameter) {
      setCookie("_id", parameter, 10);
    }

    function setCookie(name, value, days) {
      var d = new Date();
      d.setTime(d.getTime() + (days * 24 * 60 * 60 * 1000));
      var expires = "expires=" + d.toUTCString();
      document.cookie = name + "=" + value + ";" + expires + ";path=/";
    }
  </script>

</body>
