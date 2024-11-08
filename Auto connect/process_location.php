<?php
// Retrieve latitude and longitude sent from client-side JavaScript
if(isset($_POST['latitude']) && isset($_POST['longitude'])) {
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    // Log latitude and longitude to the console
    $log_message = "Latitude: $latitude, Longitude: $longitude";
    error_log($log_message);

    // You can store the user's location in session for future use
    session_start();
    $_SESSION['user_latitude'] = $latitude;
    $_SESSION['user_longitude'] = $longitude;

    // You can also store the location in your database for analytics or other purposes
    // Example:
    // $db->query("INSERT INTO user_location (latitude, longitude) VALUES ($latitude, $longitude)");

    // Respond with a success message (optional)
    echo json_encode(array('status' => 'success'));
} else {
    // Respond with an error message if latitude or longitude is not provided
    echo json_encode(array('status' => 'error', 'message' => 'Latitude or longitude not provided'));
}
?>
