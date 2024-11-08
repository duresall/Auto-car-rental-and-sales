<?php 
require_once("../../includes/configtwo.php");
session_start();
if(!empty($_POST["platenumber"])) {
    $platenumber = $_POST["platenumber"];
        // Prepare SQL query
        $sql = "SELECT plate_number FROM tblvehicles WHERE plate_number='$platenumber'";
        $results = $dbhh->query($sql);
        if ($results->num_rows == 0) {
            echo "<span style='color:red'>please enter a correct approved vehicle plate number.</span>";
            echo "<script>$('#submit').prop('disabled', true);</script>";
        } else {
            echo "<script>$('#submit').prop('disabled', false);</script>";
        } 
    

}
?>
