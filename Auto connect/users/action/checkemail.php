<?php 
require_once("../../includes/configtwo.php");
session_start();
if(!empty($_POST["emailid"])) {
    $email = $_POST["emailid"];
    $loggedUsereamil=$_SESSION['login'];

    if($loggedUsereamil==$email){
        echo "<span style='color:red'>You can not transfer ownership to yourself.</span>";
        echo "<script>$('#submit').prop('disabled', true);</script>";
    }else{
    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        echo "<span style='color:red'>You did not enter a valid email address.</span>";
        echo "<script>$('#submit').prop('disabled', true);</script>";
    } else {
        // Prepare SQL query
        $sql = "SELECT EmailId FROM tblusers WHERE EmailId='$email'";
        $results = $dbhh->query($sql);
        if ($results->num_rows > 0) {
            echo "<span style='color:green'>Email is available for transfer.</span>";
            echo "<script>$('#submit').prop('disabled', false);</script>"; 
        } else {
            echo "<span style='color:red'>Email is not available for transfer.</span>";
            echo "<script>$('#submit').prop('disabled', true);</script>";
        }
    }
}
}
?>
