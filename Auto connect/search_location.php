<?php
// Include your database connection configuration
include('includes/configtwo.php');
if(isset($_POST['query'])) {
    $query = $_POST['query'];
    $query = mysqli_real_escape_string($dbhh, $query);
    $sql = "SELECT location_name FROM Location WHERE location_name LIKE '$query%'";
    $result = mysqli_query($dbhh, $sql);
    $suggestions = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $location = $row['location_name'];
        if (strtolower(substr($location, 0, 1)) === strtolower(substr($query, 0, 1))) {
            $suggestions[] = $location;
        }
    }
    foreach ($suggestions as $location) {
        echo '<option value="' . htmlentities($location) . '">';
    }

    mysqli_free_result($result);
}
?>
