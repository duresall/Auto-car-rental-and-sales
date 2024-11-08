<?php

require "../vendor/autoload.php";
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;

session_start(); // Start the session
include('includes/configtwo.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);
file_put_contents('debug.log', print_r($_POST, true));
$msg = ""; 
$error = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extract the form data
    $seller_id=$_POST['userid'];
    $vehicletitle = $_POST['vehicletitle'];
    $brandname = $_POST['brandname'];
    $location = $_POST['location'];
    $vehicle_for=$_POST['vehicle_for'];
    $vehicleoverview=$_POST['vehicleoverview'];
    //extracting the youtube id from the url
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
    // File paths
    $vimage1 = "../admin/img/vehicleimages/" . $_FILES["img1"]["name"];
    $vimage2 = "../admin/img/vehicleimages/" . $_FILES["img2"]["name"];
    $vimage3 = "../admin/img/vehicleimages/" . $_FILES["img3"]["name"];
    $vimage4 = "../admin/img/vehicleimages/" . $_FILES["img4"]["name"];
    $vimage5 = "../admin/img/vehicleimages/" . $_FILES["img5"]["name"];

    // Move uploaded files to the upload directory
    move_uploaded_file($_FILES["img1"]["tmp_name"], $vimage1);
    move_uploaded_file($_FILES["img2"]["tmp_name"], $vimage2);
    move_uploaded_file($_FILES["img3"]["tmp_name"], $vimage3);
    move_uploaded_file($_FILES["img4"]["tmp_name"], $vimage4);
    move_uploaded_file($_FILES["img5"]["tmp_name"], $vimage5);
//my bro know you gotta fetech the contact details of the seller form the tbluser table so you can add it in the post
    $sql1="SELECT ContactNo FROM tblusers WHERE id='$seller_id'";
    $answer=$dbhh->query($sql1);
    if($answer->num_rows>0){
        $row=$answer->fetch_assoc();
        $contact=$row['ContactNo'];
   
    $sql = "INSERT INTO `tblvehicles`( `VehiclesTitle`, `VehiclesBrand`, `VehiclesOverview`, `PricePerDay`, `FuelType`, `ModelYear`, `SeatingCapacity`, `userid`, `url`,
     `Vimage1`, `Vimage2`, `Vimage3`, `Vimage4`, `Vimage5` ) VALUES ('$vehicletitle','$brandname','$vehicleoverview','$price','$FuelType','$modelyear','$seatingcapacity','$seller_id','$url',
     '$vimage1','$vimage2','$vimage3','$vimage4','$vimage5')";
    if ($dbhh->query($sql) === TRUE) {
        $msg = "Vehicle posted successfully its will be listed shortly";
        $_SESSION['msg'] = $msg;
         $sqlPreference = "SELECT email, phone FROM pereference WHERE Brand = '$brandname'";
         $resultPreference = $dbhh->query($sqlPreference);
         if ($resultPreference->num_rows > 0) {
             while ($rowPreference = $resultPreference->fetch_assoc()) {
                 $email = $rowPreference['email'];
                 $phone = $rowPreference['phone'];
while ($rowPreference = $resultPreference->fetch_assoc()) {
    $email = $rowPreference['email'];
    $name = 'duresa'; 
    $mail = new PHPMailer(true);

    try {

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; 
        $mail->SMTPAuth = true;
        $mail->Username = 'autoconnectcar@gmail.com';
        $mail->Password = 'kdccfswebrxzinnz';
        $mail->SMTPSecure = 'tls'; 
        $mail->Port = 587;
        $mail->setFrom('autoconnectcar@gmail.com', 'Auto car rental and sales');
        $mail->addAddress($email, $name);

        $mail->isHTML(true); 
        $mail->Subject = 'You have a matching preference';
        $htmlContent = '<html><head>';
        $htmlContent .= '<style>';
        $htmlContent .= 'body { font-family: Arial, sans-serif; }';
        $htmlContent .= '.container { max-width: 600px; margin: 0 auto; padding: 20px; }';
        $htmlContent .= '.header { background-color: #f2f2f2; padding: 20px; text-align: center; }';
        $htmlContent .= '.title { font-size: 24px; color: #333; }';
        $htmlContent .= '.details { margin-top: 20px; }';
        $htmlContent .= '.detail-item { margin-bottom: 10px; }';
        $htmlContent .= '.detail-label { font-weight: bold; }';
        $htmlContent .= '.detail-value { margin-left: 10px; }';
        $htmlContent .= '</style>';
        $htmlContent .= '</head><body>';
        $htmlContent .= '<div class="container">';
        $htmlContent .= '<div class="header">';
        $htmlContent .= '<h1 class="title">Hello!</h1>';
        $htmlContent .= '<p>dear .. we have a matching for your preference.</p>';
        $htmlContent .= '</div>';
        $htmlContent .= '<div class="details">';
        $htmlContent .= '<div class="detail-item"><span class="detail-label">Model:</span><span class="detail-value">' . $vehicletitle . '</span></div>';
        $htmlContent .= '<div class="detail-item"><span class="detail-label">Brand:</span><span class="detail-value">' . $brandname . '</span></div>';
        $htmlContent .= '<div class="detail-item"><span class="detail-label">Location:</span><span class="detail-value">' . $location . '</span></div>';
        $htmlContent .= '<div class="detail-item"><span class="detail-label">Vehicle for:</span><span class="detail-value">' . $vehicle_for . '</span></div>';
        $htmlContent .= '<div class="detail-item"><span class="detail-label">Fuel Type:</span><span class="detail-value">' . $FuelType . '</span></div>';
        $htmlContent .= '<div class="detail-item"><span class="detail-label">Price:</span><span class="detail-value">' . $price . '</span></div>';
        $htmlContent .= '<div class="detail-item"><span class="detail-label">Model Year:</span><span class="detail-value">' . $modelyear . '</span></div>';
        $htmlContent .= '<div class="detail-item"><span class="detail-label">Seating Capacity:</span><span class="detail-value">' . $seatingcapacity . '</span></div>';
        $htmlContent .= '</div>';
        $htmlContent .= '</div>'; 
        $htmlContent .= '</body></html>';
        $mail->Body = $htmlContent;
        $mail->send();
        echo "Email notification sent successfully to $email";
    } catch (Exception $e) {
        echo "Failed to send email notification to $email". $mail->ErrorInfo;;
    }
}
             }
         }

    } else {
        $error = "Something went wrong. Please try again";
        $_SESSION['error'] = $error; // Set error message in session
    }
} else {
    $errors = "Error: Form submission method not allowed.";
    $_SESSION['error'] = $errors; 
}
}












///////////////////////


require "../vendor/autoload.php";

use Infobip\Configuration;
use Infobip\Api\SmsApi;
use Infobip\Model\SmsDestination;
use Infobip\Model\SmsTextualMessage;
use Infobip\Model\SmsAdvancedTextualRequest;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

session_start(); // Start the session
include('includes/configtwo.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);
file_put_contents('debug.log', print_r($_POST, true));
$msg = ""; 
$error = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extract the form data
    $seller_id=$_POST['userid'];
    $vehicletitle = $_POST['vehicletitle'];
    $brandname = $_POST['brandname'];
    $location = $_POST['location'];
    $vehicle_for=$_POST['vehicle_for'];
    $vehicleoverview=$_POST['vehicleoverview'];
    //extracting the youtube id from the url
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
    // File paths
    $vimage1 = "../admin/img/vehicleimages/" . $_FILES["img1"]["name"];
    $vimage2 = "../admin/img/vehicleimages/" . $_FILES["img2"]["name"];
    $vimage3 = "../admin/img/vehicleimages/" . $_FILES["img3"]["name"];
    $vimage4 = "../admin/img/vehicleimages/" . $_FILES["img4"]["name"];
    $vimage5 = "../admin/img/vehicleimages/" . $_FILES["img5"]["name"];

    // Move uploaded files to the upload directory
    move_uploaded_file($_FILES["img1"]["tmp_name"], $vimage1);
    move_uploaded_file($_FILES["img2"]["tmp_name"], $vimage2);
    move_uploaded_file($_FILES["img3"]["tmp_name"], $vimage3);
    move_uploaded_file($_FILES["img4"]["tmp_name"], $vimage4);
    move_uploaded_file($_FILES["img5"]["tmp_name"], $vimage5);
//my bro know you gotta fetech the contact details of the seller form the tbluser table so you can add it in the post
    $sql1="SELECT ContactNo FROM tblusers WHERE id='$seller_id'";
    $answer=$dbhh->query($sql1);
    if($answer->num_rows>0){
        $row=$answer->fetch_assoc();
        $contact=$row['ContactNo'];
   
    $sql = "INSERT INTO `tblvehicles`( `VehiclesTitle`, `VehiclesBrand`, `VehiclesOverview`, `PricePerDay`, `FuelType`, `ModelYear`, `SeatingCapacity`, `userid`, `url`,
     `Vimage1`, `Vimage2`, `Vimage3`, `Vimage4`, `Vimage5` ) VALUES ('$vehicletitle','$brandname','$vehicleoverview','$price','$FuelType','$modelyear','$seatingcapacity','$seller_id','$url',
     '$vimage1','$vimage2','$vimage3','$vimage4','$vimage5')";
    if ($dbhh->query($sql) === TRUE) {
        $msg = "Vehicle posted successfully. It will be listed shortly.";
        $_SESSION['msg'] = $msg;
        // Section for sending preference email and sms
        $sqlPreference = "SELECT email, phone FROM pereference WHERE Brand = '$brandname'";
        $resultPreference = $dbhh->query($sqlPreference);
        if ($resultPreference->num_rows > 0) {
            while ($rowPreference = $resultPreference->fetch_assoc()) {
                $email = $rowPreference['email'];
                $phone = "251" . $rowPreference['phone'];    
                // Send email
                try {
                    $mail = new PHPMailer(true);
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com'; 
                    $mail->SMTPAuth = true;
                    $mail->Username = 'autoconnectcar@gmail.com';
                    $mail->Password = 'kdccfswebrxzinnz';
                    $mail->SMTPSecure = 'tls'; 
                    $mail->Port = 587;
                    $mail->setFrom('autoconnectcar@gmail.com', 'Auto car rental and sales');
                    $mail->addAddress($email, 'Recipient Name');
                    $mail->isHTML(true);
                    $mail->Subject = 'the transfere has been sucessful completed';
                    $mail->Body = 'Thank god its working';
                    $mail->send();
                    echo "Email notification sent successfully to $email";
                } catch (Exception $e) {
                    echo "Failed to send email notification to $email. Error: " . $mail->ErrorInfo;
                }
    
                // Send SMS
                try {
                    $message = "Notification message for SMS.";
                    $base_url = "w1k9gq.api.infobip.com";
                    $api_key = "d50f9e4a564c85a83d45bb66741d8416-4f089a2e-5873-4239-b106-bea4a32a1674";
                    $configuration = new Configuration(host: $base_url, apiKey: $api_key);
                    $api = new SmsApi(config: $configuration);
                    $destination = new SmsDestination(to: $phone);
                    $message = new SmsTextualMessage(destinations: [$destination], text: $message, from: "duresa");
                    $request = new SmsAdvancedTextualRequest(messages: [$message]);
                    $response = $api->sendSmsMessage($request);
                    echo "SMS notification sent successfully to $phone";
                } catch (Exception $e) {
                    echo "Failed to send SMS notification to $phone. Error: " . $e->getMessage();
                }
            }
        }
    } else {
        $error = "Something went wrong while posting the vehicle. Please try again.";
        $_SESSION['error'] = $error;
    }
    
} else {
    $errors = "Error: Form submission method not allowed.";
    $_SESSION['error'] = $errors; 
}
}


// PART ONE 


// PART TWO 
?>


<form action="submit_post.php" id="form" name="form" method="post" class="form-horizontal" enctype="multipart/form-data">
                        <div class="panel panel-default">
                            <div class="panel-heading">Basic Info</div>
                            <div class="panel-body">
                        
















<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label class="control-label">Vehicle plate number<span style="color:red">*</span></label>
            <input type="text" name="platenumber" class="form-control" id="platenumber">
            <div class="error"></div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label class="control-label">Select Brand<span style="color:red">*</span></label>
            <select class="selectpicker" name="brandname" id="brandname">
                                <option value=""> Select </option>
                                <?php 
                                    $ret="select id,BrandName from tblbrands";
                                    $query= $dbh -> prepare($ret);
                                    $query-> execute();
                                    $results = $query -> fetchAll(PDO::FETCH_OBJ);
                                    if($query -> rowCount() > 0) {
                                        foreach($results as $result) {
                                ?>
                                <option value="<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->BrandName);?></option>
                                <?php 
                                        } 
                                    } 
                                ?>
                            </select>
            <div class="error"></div>
        </div>
    </div>
</div>

<div class="row ">
    <div class="col-sm-6">
        <div class="form-group">
            <label class="control-label">Vehicle Title<span style="color:red">*</span></label>
            <input type="text" name="VehicleTitle" class="form-control" id="VehicleTitle">
            <div class="error"></div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label class="control-label">Vehicle for<span style="color:red">*</span></label>
            <select class="selectpicker" name="vehicle_for" id="vehicle_for">
                                <option value="">Select</option>
                                <option value="sale ">Sale </option>
                                <option value="rent">Rent</option>
                            </select>
            <div class="error"></div>
        </div>
    </div>
</div>

<!-- next -->
<div class="row ">
<div class="col-sm-6">
        <div class="form-group">
           <label class="control-label">Seating Capacity<span style="color:red">*</span></label>
            <input type="number" name="seatingcapacity" class="form-control" id="seatingcapacity">
            <div class="error"></div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
        <label  class="control-label"> Model Year<span style="color:red">*</span></label>
        <select class="selectpicker" name="modelyear" id="modelyear">
            <option value="">Select</option>
            <?php
            for($i=2000; $i<=2024; $i++){
            ?>
            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
            <?php
            }
            ?>
        </select>
       <div class="error"></div>
        </div>
    </div>
</div>
<!-- next -->
<div class="row ">
<div class="col-sm-6">
        <div class="form-group">
           <label class="control-label">Youtube link<span style="color:red">*</span></label>
            <input type="text" name="url" class="form-control" placeholder="optional">
            <div class="error"></div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
        <label class="control-label">Fule Type<span style="color:red">*</span></label>
            <select class="selectpicker" name="FuelType" id="FuelType">
                                <option value="">Select</option>
                                <option value="Pertrol ">petrol </option>
                                <option value="Deiesel">desile</option>
                            </select>
                            <div class="error"></div>
        </div>
    </div>
</div>
<!-- NEXT -->
<div class="row ">
    <div class="col-sm-6">
        <div class="form-group">
        <label  class="control-label"> Location<span style="color:red">*</span></label>
        <input type="text" name="location" class="form-control" id="location" list="locationList">
       <datalist id="locationList"></datalist>
       <div class="error"></div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
           <label class="control-label">price<span style="color:red">*</span></label>
            <input type="number" name="price" class="form-control" id="price">
            <div class="error"></div>
        </div>
    </div>
</div>
                           
<!-- Continue adding pairs of form groups in the same pattern -->


                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <h4><b>Upload Images</b></h4>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-4">
                                        Image 1 <span style="color:red">*</span><input type="file" name="img1" id="img1">
                                        <div class="error"></div>
                                    </div>
                                    <div class="col-sm-4">
                                        Image 2 <span style="color:red">*</span><input type="file" name="img2" id="img2">
                                        <div class="error"></div>
                                    </div>
                                    <div class="col-sm-4">
                                        Image 3 <span style="color:red">*</span><input type="file" name="img3" id="img3">
                                        <div class="error"></div>
                                    </div>
                                    <div class="col-sm-4">
                                        Image 4 <span style="color:red">*</span><input type="file" name="img4" id="img4">
                                        <div class="error"></div>
                                    </div>
                                    <div class="col-sm-4">
                                        Image 5 <input type="file" name="img5">
                                    </div>
                                </div>

                                <?php if(isset($_SESSION['id'])) { 
                                    $seller_id = $_SESSION['id'];
                                ?>
                                <input type="hidden" name="userid" value="<?= $seller_id ?>">
                                <?php } ?>

                                <div class="hr-dashed"></div>

                                <div class="form-group">
                                    <div class="col-sm-6 col-sm-offset-4">
                                        <?php if($_SESSION['login']) { ?>
                                            <button id="saveChangesBtn" class="btn btn-primary" name="submit" type="submit">Post</button>
                                        <?php } else { ?>
                                            <a href="#loginform" class="btn btn-xs uppercase" data-toggle="modal" data-dismiss="modal">Login to submit</a> 
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>



             




