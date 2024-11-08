<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
include('includes/configtwo.php');

// SQL query to fetch garage data
$sql = "SELECT `name`, `address`, `phone`, `description`, `GarageID`, `Image`, `years_of_experience`, `status` FROM `garageowner`";
$result = $dbhh->query($sql);

// Array to store garage data
$garages = array();

// Check if there are any results
if ($result->num_rows > 0) {
    // Fetch data and store in the array
    while($row = $result->fetch_assoc()) {
        $garages[] = $row;
    }
}

// Close the database connection
$dbhh->close();

header('Content-Type: application/json');
echo json_encode($garages);
?>
