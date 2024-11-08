<?php

session_start(); 
include('includes/configtwo.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);
file_put_contents('debug.log', print_r($_POST, true));
$msg = ""; 
$error = ""; 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extract the form data
    $seller_id=$_POST['userid'];
    $vehicletitle = $_POST['VehicleTitle'];
    $brandname = $_POST['brandname'];
    $location = $_POST['location'];
    $vehicle_for=$_POST['vehicle_for'];
   
    $url = $_POST['url'];
    $FuelType=$_POST['FuelType'];
    $price=$_POST['price'];
    $modelyear = $_POST['modelyear'];
    $seatingcapacity = $_POST['seatingcapacity'];
    $image1=$_FILES['img1']['name'];
    $image2 = $_FILES["img2"]["name"];
    $image3 = $_FILES["img3"]["name"];
    $image4 = $_FILES["img4"]["name"];
    $image5 = $_FILES["img5"]["name"];
    $vimage1 = "./admin/img/vehicleimages/" . $_FILES["img1"]["name"];
    $vimage2 = "./admin/img/vehicleimages/" . $_FILES["img2"]["name"];
    $vimage3 = "./admin/img/vehicleimages/" . $_FILES["img3"]["name"];
    $vimage4 = "./admin/img/vehicleimages/" . $_FILES["img4"]["name"];
    $vimage5 = "./admin/img/vehicleimages/" . $_FILES["img5"]["name"];
    move_uploaded_file($_FILES["img1"]["tmp_name"], $vimage1);
    move_uploaded_file($_FILES["img2"]["tmp_name"], $vimage2);
    move_uploaded_file($_FILES["img3"]["tmp_name"], $vimage3);
    move_uploaded_file($_FILES["img4"]["tmp_name"], $vimage4);
    move_uploaded_file($_FILES["img5"]["tmp_name"], $vimage5);


    $sql = "INSERT INTO `tblvehicles`( `VehiclesTitle`, `VehiclesBrand` , `Price`, `FuelType`, `ModelYear`, `SeatingCapacity`, `userid`, `url`,
     `Vimage1`, `Vimage2`, `Vimage3`, `Vimage4`, `Vimage5` ) VALUES ('$vehicletitle','$brandname','$price','$FuelType','$modelyear','$seatingcapacity','$seller_id','$url',
     '$image1','$image2','$image3','$image4','$image5')";
    if ($dbhh->query($sql) === TRUE) {
        $msg = "Vehicle posted successfully. It will be listed shortly.";
        $_SESSION['msg'] = $msg;
        // Section for sending preference email and sms

        // yehan bota yetewkew mnalebate submit siderge post medrg alebet beleh kasetb nw
        
    } else {
        $error = "Something went wrong while posting the vehicle. Please try again.";
        $_SESSION['error'] = $error;
    }
 } else {
    $errors = "Error: Form submission method not allowed.";
    $_SESSION['error'] = $errors; 
 }
?>
