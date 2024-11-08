<?php
include('../../includes/configtwo.php');
// Handle the POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the vehicle ID and new status from the POST data
    $vehicleId = $_POST['vehicle_id'];
    $newStatus = $_POST['new_status'];
    $sql = "UPDATE tblvehicles SET post_status = '$newStatus' WHERE id = '$vehicleId'";
   $result=$dbhh->query($sql);
   if($result){
    echo "OK";
   }
}












?>