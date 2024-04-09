<?php
$recipeid = $_COOKIE['_id'];
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
  <script src="deletecookies.js"></script>
  <script>
    function validateForm() {
      var rating = document.forms["reviewForm"]["rating"].value;
      var review = document.forms["reviewForm"]["reviewtarea"].value;

      if (rating == "" || isNaN(parseFloat(rating)) || parseFloat(rating) < 0 || parseFloat(rating) > 10) {
        alert("Please enter a valid rating between 0 and 10.");
        return false;
      }

      if (review.trim() == "") {
        alert("Review cannot be empty.");
        return false;
      }

      return true;
    }
  </script>
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
    <a href="viewrecipe.php"><button class = "navBarButtons" style="float: right;">view Recipes</button></a>
	<a href="favourites.php"><button class = "navBarButtons" style="float: right;">My Favourites</button></a>
  </div>

  <div class="form-align">
    <div class="grid-container">
    <form name="reviewForm" action="writereview.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
        <label for="rating">Rating</label>
        <input type="number" steps="any" min="0" max="10" name="rating"><br><br>
        <label for="reviewtarea">Review</label>
        <textarea id="reviewtarea" rows="4" cols="50" name="reviewtarea">

        </textarea><br><br>
        <select id="Recipe_Type" name="g_or_b">
          <option value="good">good comment</option>
          <option value="bad">bad comment</option>
          </select><br><br>
        <label for="submita">Submit:</label>
        <button type="submit" name="submita">Add Review</button>
      </form>
    </div>
  </div>
  
<?php
    include_once 'webpages/dbinfo.php';

    if (isset($_POST['submita']))
    {
	  $rating = $_POST['rating'];
      $review = $_POST['reviewtarea'];
      $g_or_b = $_POST['g_or_b'];
      $username = $_COOKIE['username'];
	  
	  
      $query = "insert into Recipe_Review(Recipe_ID, Review_Poster, Recipe_Comment, Recipe_Rating, g_or_b)
		Values(?,?,?,?,?)";
		$statement = $conn->prepare($query);
		$statement->bind_param('issds', $recipeid, $username, $review, $rating, $g_or_b);
		$result = $statement->execute();
		if ($result == FALSE)
		{
			echo 'Error inserting record.'; //if false bool is returned, there was an error inserting the record
		}
		else
		{
			header("Location: viewrecipe.php");
        exit();//record went in to the database fine
		}
		$statement->close();
		//uncomment next line if not closing the connection elsewhere
		$conn->close();
    }
 ?>
</body>