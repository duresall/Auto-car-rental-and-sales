<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('../includes/configtwo.php');
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reviewsFetched'])) {
    // Retrieve the number of reviews fetched so far
    $reviewsFetched = $_POST['reviewsFetched'];
    $email=$_SESSION['alogin'];
    $sql1="SELECT garage_id FROM garageowner WHERE email='$email'";
    $result1 = mysqli_query($dbhh, $sql1);
    $row1 = mysqli_fetch_array($result1);
    $garage_id = $row1['garage_id'];
    $query = "SELECT 
        gr.ratingId, 
        gr.ratingNumber, 
        gr.userId, 
        gr.garageId, 
        gr.created, 
        gr.comments, 
        gr.title, 
        u.FullName,
        u.photo
    FROM 
        garage_rating gr
    INNER JOIN 
        tblusers u ON gr.userId = u.id
    WHERE 
        gr.garageId = $garage_id
    ORDER BY gr.created DESC
    LIMIT $reviewsFetched, 4"; // Fetch 4 more reviews

    // Execute the query
    if ($result = mysqli_query($dbhh, $query)) {

    // Check if there are additional reviews fetched
    if ($result && mysqli_num_rows($result) > 0) {
        function displayRatingStars($rating) {
            $stars = '';
            // Loop through 5 stars
            for ($i = 1; $i <= 5; $i++) {
                // Check if the current star should be filled or empty
                if ($i <= $rating) {
                    // Filled star
                    $stars .= '<span class="glyphicon glyphicon-star"></span>';
                } else {
                    // Empty star
                    $stars .= '<span class="glyphicon glyphicon-star-empty"></span>';
                }
            }
            return $stars;
        }
        
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="row">';
            echo '<div class="col-sm-3">';
            $photo = !empty($row['photo']) ? $row['photo'] : 'profile.png';
            echo "<img src='../$photo' class='img-rounded user-pic'>";
            echo '<div class="review-block-name">By <a href="#">' . htmlspecialchars($row['FullName']) . '</a></div>';
            echo '<div class="review-block-date">' . $row['created'] . '</div>';
            echo '</div>';
            echo '<div class="col-sm-9">';
            echo '<div class="review-block-rate">';
            // Display rating stars function goes here
            echo '</div>';
            echo '<div class="review-block-title">' . htmlspecialchars($row['title']) . '</div>';
            echo '<div class="review-block-description">' . htmlspecialchars($row['comments']) . '</div>';
            echo '</div>';
            echo '</div>';
            echo '<hr/>';
        }
    } else {
        // If no additional reviews are found
        echo '<p>No more reviews available.</p>';
    }
    }
}
?>
