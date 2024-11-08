<?php 
require_once("../includes/configtwo.php");
session_start();
if(!empty($_POST["email"])) {
    $email = $_POST["email"];

    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        echo "<span style='color:red'>You did not enter a valid email address.</span>";
        echo "<script>$('#send').prop('disabled', true);</script>";
    } else {
        // Prepare SQL query
        $sql = "SELECT EmailId FROM tblusers WHERE EmailId='$email'";
        $results = $dbhh->query($sql);
        if ($results->num_rows > 0) {
            echo "<span style='color:green'>Email is a valid email to reset.</span>";
            echo "<script>$('#send').prop('disabled', false);</script>"; 
        } else {
            echo "<span style='color:red'>please enter the email you used within the system</span>";
            echo "<script>$('#send').prop('disabled', true);</script>";
        }
    }
}

?>