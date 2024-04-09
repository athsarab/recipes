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

  <script>
    function validateForm() {
      var recipename = document.forms["recipeForm"]["recipename"].value;
      var ingredients = document.forms["recipeForm"]["ingredients"].value;
      var method = document.forms["recipeForm"]["method"].value;
      var image = document.forms["recipeForm"]["image"].value;

      if (recipename == "") {
        alert("Recipe Name must be filled out");
        return false;
      }
      if (ingredients == "") {
        alert("Ingredients must be filled out");
        return false;
      }
      if (method == "") {
        alert("Method must be filled out");
        return false;
      }
      if (image == "") {
        alert("Image must be selected");
        return false;
      }
    }
  </script>
</head>


<body>
  <div class="header">
      <h1>UniFoodie</h1>
      <a href="homepage.php"><img style="float: left;" src=Logo.png></a>
      <a href="index.php"><button class = "LogOutButton" style="float: right;" onclick="deleteAllCookies()">Log Out</button><a/>
	  <button class = "LogOutButton" style="float: right; width: 100px;" ><?php echo "Welcome " . $username . "!";?></button>
  </div>

  <div class="navbar">
    <a href="homepage.php"><button class = "navBarButtons" style="float: left;">Home</button></a>
    <a href="menu.php"><button class = "navBarButtons" style="float: left;">Menu</button></a>
    <a href="about.php"><button class = "navBarButtons" style="float: left;">About</button></a>
    <a href="myrecipes.php"><button class = "navBarButtons" style="float: right;">My Recipes</button></a>
	<a href="favourites.php"><button class = "navBarButtons" style="float: right;">My Favourites</button></a>
  <a href="userprofile.php"><button class = "navBarButtons" style="float: right;">profile</button></a>

</div>


  <!--<h1 class="Menu">Menu</h1>
  <h3>Served daily from 12.00 to 17.00</h3>-->
  <div class="form-align">
    <div class="grid-container">
    <form name="recipeForm" action= "addrecipe.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
        <label for="recipe_name">Recipe Name:</label>
        <input class="recipenamesearch" type="text" size="65" name="recipename"><br><br>
        <label for="Ingredients">Ingredients:</label>
        <textarea id="ingredientsTextBox" rows="4" cols="50" name="ingredients">
        </textarea><br><br>
        <label for="Ingredients">Method:</label>
        <textarea id="ingredientsTextBox" rows="4" cols="50" name="method">
        </textarea><br><br>
        <select id="Recipe_Type" name="recipetype">
          <option value="Food">Food</option>
          <option value="Drink">Drink</option>
        </select><br><br>
        <label>Picture:</label>
        <input type="file" name="image"><br><br>

        <button type="submit" name="submit">Add Recipe</button>
      </form>
    </div>
  </div>

<?php
    include_once 'webpages/dbinfo.php';

    if (isset($_POST['submit']))
    {
      $file = $_FILES['image']['name'];
      $date = date("Y-m-d");
      $username = $_COOKIE['username'];
      $sql = "INSERT INTO recipe(Recipe_Poster, Recipe_Name,
              Ingredients, Method, Image_Link, Post_Date, Recipe_Type)
              VALUES ('$username','$_POST[recipename]','$_POST[ingredients]','$_POST[method]', '$file', '$date','$_POST[recipetype]');";
      $res = mysqli_query($conn, $sql);
      if ($res)
      {
        move_uploaded_file($_FILES['image']['tmp_name'], "uploads/$file");
        echo "Recipe Successfully Added!";
        header("Location: myrecipes.php");
      }
    }

 ?>


</body>
