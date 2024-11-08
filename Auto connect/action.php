<?php
session_start();
$id=$_SESSION['id'];
include 'garagerating/class/Rating.php';
$rating = new Rating();
if (!empty($_POST['action']) && $_POST['action'] == 'saveRating' 
    && !empty($_POST['rating']) && !empty($_POST['garageId'])) {
    $userID = !empty($id) ? $id : null;
    if ($userID) {
        $rating->saveRating($_POST, $userID);
        $data = array("success" => 1);
        echo json_encode($data);
    } else {
        $data = array("success" => 0, "message" => "User not authenticated");
        echo json_encode($data);
    }
}

?>
