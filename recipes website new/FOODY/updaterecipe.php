<?php
include_once 'webpages/dbinfo.php';

// Initialize variables for form fields
$recipe_data = array('Recipe_Name' => '', 'Ingredients' => '', 'Method' => '', 'Recipe_Type' => 'Food');

// Check if a recipe ID is provided for updating
if(isset($_GET['recipe_id'])) {
    $recipe_id = $_GET['recipe_id'];
    $sql = "SELECT * FROM recipe WHERE Recipe_ID = '$recipe_id'";
    $result = mysqli_query($conn, $sql);
    $recipe_data = mysqli_fetch_assoc($result);
}

// Handle form submission for updating existing recipe
if (isset($_POST['submit']) && isset($_GET['recipe_id'])) {
    $recipe_name = $_POST['recipename'];
    $ingredients = $_POST['ingredients'];
    $method = $_POST['method'];
    $recipe_type = $_POST['recipetype'];
    $update_id = $_GET['recipe_id'];

    // Update the existing recipe
    $update_query = "UPDATE recipe SET Recipe_Name='$recipe_name', Ingredients='$ingredients', Method='$method', Recipe_Type='$recipe_type' WHERE Recipe_ID='$update_id'";
    mysqli_query($conn, $update_query);
    
    // Redirect to recipe list page after updating
    header("Location: myrecipes.php");
    exit();
}
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Recipe</title>
    <!-- Include your CSS and other header elements here -->
</head>

<body>
    <h1>Update Recipe</h1>
    <!-- Your HTML form for updating recipes -->
    <form method="post" enctype="multipart/form-data">
        <label for="recipe_name">Recipe Name:</label><br>
        <input class="recipenamesearch" type="text" size="65" name="recipename" value="<?php echo $recipe_data['Recipe_Name']; ?>"><br><br>
        <label for="Ingredients">Ingredients:</label><br>
        <textarea id="ingredientsTextBox" rows="4" cols="50" name="ingredients"><?php echo $recipe_data['Ingredients']; ?></textarea><br><br>
        <label for="Method">Method:</label><br>
        <textarea id="methodTextBox" rows="4" cols="50" name="method"><?php echo $recipe_data['Method']; ?></textarea><br><br>
        <label for="Recipe_Type">Recipe Type:</label><br>
        <select id="Recipe_Type" name="recipetype">
            <option value="Food" <?php if($recipe_data['Recipe_Type'] == 'Food') echo 'selected'; ?>>Food</option>
            <option value="Drink" <?php if($recipe_data['Recipe_Type'] == 'Drink') echo 'selected'; ?>>Drink</option>
        </select><br><br>
        <input type="submit" name="submit" value="Update Recipe">
    </form>
</body>
</html>
