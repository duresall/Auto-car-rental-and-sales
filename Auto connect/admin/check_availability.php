<?php 
require_once("includes/configtwo.php");
// code user email availablity
if(!empty($_POST["email"])) {
    $email = $_POST["email"];
    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        echo "error : You did not enter a valid email.";
    }
    else {
        $sql = "SELECT email FROM garageowner WHERE email='$email'";
        $query = mysqli_query($dbhh, $sql);
        $result = mysqli_fetch_array($query,MYSQLI_ASSOC);
        $count = mysqli_num_rows($query);
        if($count > 0) {
            echo "<span style='color:red'> Email already exists .</span>";
            echo "<script>$('#submit').prop('disabled',true);</script>";
        } else {
            echo "<span style='color:green'> Email available for Registration .</span>";
            echo "<script>$('#submit').prop('disabled',false);</script>";
        }
    }
}
?>

