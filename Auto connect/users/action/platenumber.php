<?php 
require_once("../../includes/configtwo.php");
session_start();
if(!empty($_POST["platenumber"])) {
    $platenumber = $_POST["platenumber"];
    $userid=$_SESSION['id'];
        // Prepare SQL query
        $sql = "SELECT plate_number FROM tblvehicles WHERE plate_number='$platenumber' and userid='$userid' and status=1";
        $results = $dbhh->query($sql);
        if ($results->num_rows > 0) {
            echo "<span style='color:green'>your vehicle is avialable for transfer.</span>";
            echo "<script>$('#submit').prop('disabled', false);</script>"; 
        } else {
            echo "<span style='color:red'>please enter your correct approved vehicle plate number.</span>";
            echo "<script>$('#submit').prop('disabled', true);</script>";
        }
    

}
?>
