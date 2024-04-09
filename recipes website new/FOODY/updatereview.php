<?php
// Include the database connection
include_once 'webpages/dbinfo.php';

// Initialize variables to store form fields
$review_data = array('Recipe_Comment' => '', 'Recipe_Rating' => '');

// Check if a review ID is provided for updating
if(isset($_GET['review_id'])) {
    $review_id = $_GET['review_id'];
    $sql = "SELECT * FROM recipe_review WHERE Review_ID = '$review_id'";
    $result = mysqli_query($conn, $sql);
    $review_data = mysqli_fetch_assoc($result);

}

// Handle form submission for updating existing review
if (isset($_POST['submit']) && isset($_GET['review_id'])) {
    $Recipe_Comment = $_POST['new_comment'];
    $Recipe_Rating = $_POST['new_rating'];
    $Review_id = $_GET['review_id'];
   

    // Update the existing review
    $update_query = "UPDATE recipe_review SET Recipe_Comment='$new_comment', Recipe_Rating='$new_rating' WHERE Review_ID='$update_id'";
    $update_result = mysqli_query($conn, $update_query);

    if($update_result) {
        // Redirect to viewrecipe.php or any appropriate page after updating
        header("Location: viewrecipe.php");
        exit();
    } else {
        echo "Error updating review: " . mysqli_error($conn);
        exit();
    }
}
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Review</title>
    <!-- Include your CSS and other header elements here -->
</head>

<body>
    <h1>Update Review</h1>
    <!-- Your HTML form for updating reviews -->
    <form method="post">
        <label for="new_comment">New Comment:</label><br>
        <textarea rows="4" cols="50" name="new_comment"><?php echo $review_data['Recipe_Comment']; ?></textarea><br><br>
        <label for="new_rating">New Rating:</label><br>
        <input type="number" name="new_rating" min="1" max="10" value="<?php echo $review_data['Recipe_Rating']; ?>"><br><br>
        <input type="submit" name="submit" value="Update Review">
    </form>
</body>
</html>
