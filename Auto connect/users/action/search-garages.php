<?php
session_start();
include('../../includes/configtwo.php'); // Include your database connection file

// Check if search_text parameter is set
if(isset($_POST['search_text'])) {
    // Sanitize the search query to prevent SQL injection
    $search_text = mysqli_real_escape_string($dbhh, $_POST['search_text']);

    // SQL query to select garages based on search text
    $sql = "SELECT g.*, l.location_name, ROUND(AVG(gr.ratingNumber), 1) AS avg_rating
            FROM garageowner AS g
            JOIN garage_rating AS gr ON g.garage_id = gr.garageId
            JOIN location AS l ON g.location = l.id
            WHERE g.address LIKE '%$search_text%' OR g.years_of_experience LIKE '%$search_text%'
            GROUP BY g.garage_id
            ORDER BY avg_rating DESC";

    $result = $dbhh->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Output HTML for each garage (similar to what you did in your HTML part)
            echo '<div class="col-list-3">
                    <div class="recent-car-list">
                        <div class="car-info-box">
                            <a href="garage_profile.php?garage_id='.htmlentities($row['garage_id']).'">
                                <img src="garage/image/'.htmlentities($row['Image']).'"  class="img-responsive" alt="Garage Image">
                            </a>
                            <ul>
                                <li><i class="fa fa-map-marker" aria-hidden="true"></i>'.htmlentities($row['address']).'</li>
                                <li><i class="fa fa-star" aria-hidden="true"></i>'.htmlentities($row['avg_rating']).'/5</li>
                                <li><i class="fa fa-calendar" aria-hidden="true"></i>'.htmlentities($row['years_of_experience']).' Years of Experience</li>
                            </ul>
                        </div>
                    </div>
                </div>';
        }
    } else {
        // No garages found
        echo '<div class="not-found">';
        echo '<h3>No result found agains your search found</h3>';
        echo '</div>';
    }
    // Close database connection
    $dbhh->close();
}
?>
