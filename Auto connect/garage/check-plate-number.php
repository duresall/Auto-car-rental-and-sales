<?php 
require_once("includes/configtwo.php");
// code plate number avaliablity availablity
if(!empty($_POST["platenumber"])) {
    $platenumber = $_POST["platenumber"];
    
        $sql = "SELECT plate_number FROM tblvehicles WHERE plate_number='$platenumber'";
        $query = mysqli_query($dbhh, $sql);
        $result = mysqli_fetch_array($query,MYSQLI_ASSOC);
        $count = mysqli_num_rows($query);
        if($count == 0) {
            echo "<span style='color:red'> the the provided plate numbr doesnt exist not exist .</span>";
            echo "<script>$('#submit').prop('disabled',true);</script>";
        } else {
            echo "<span style='color:green'> there is a match for the given plate number .</span>";
            echo "<script>$('#submit').prop('disabled',false);</script>";
        } 
}
?>

