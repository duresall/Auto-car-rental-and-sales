<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/configtwo.php');

if (strlen($_SESSION['login']) == 0) { 
    header('location:index.php');
} else {
    $loggedInUserId = $_SESSION['id'];
    $searchTerm = $_POST['searchTerm']; // Get search term from the POST data

    $output = ""; // Initialize output variable

    if (!empty($searchTerm)) {
        // Perform the search query based on the search term
        $searchQuery = "SELECT DISTINCT u.id, u.FullName, u.photo
                        FROM tblusers u
                        JOIN (
                            SELECT incoming_id AS user_id FROM message WHERE outgoing_id = $loggedInUserId
                            UNION
                            SELECT outgoing_id AS user_id FROM message WHERE incoming_id = $loggedInUserId
                        ) AS t
                        ON u.id = t.user_id
                        WHERE u.FullName LIKE '%$searchTerm%'";

        $result = $dbhh->query($searchQuery);

        if ($result->num_rows > 0) {
           include "data.php";
        } else {
            $output .= "No users found"; 
        }
    } 
    echo $output; // Output the search results or message
}
?>
