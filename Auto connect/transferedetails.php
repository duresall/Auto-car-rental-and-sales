<?php 
session_start();
include('includes/config.php');
include('includes/configtwo.php');
error_reporting(0);
require "../vendor/autoload.php";
use Infobip\Configuration;
use Infobip\Api\SmsApi;
use Infobip\Model\SmsDestination;
use Infobip\Model\SmsTextualMessage;
use Infobip\Model\SmsAdvancedTextualRequest;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
$msg = ""; 
$error = ""; 
if(isset($_POST['request'])) {
$vid = $_POST['vhid'];
$plate_number = $_POST['plate_number'];
$id=$_SESSION['id'];

$sql5 = "SELECT seller_id FROM ownership_transfere WHERE buyer_id='$id' AND plate_number ='$plate_number' AND status = 0 LIMIT 1";
$result1 = $dbhh->query($sql5);

if($result1->num_rows > 0){

$row = $result1->fetch_assoc();
$seller_id = $row['seller_id'];
//lets send an email  message to this user and send sms to this user
$sql2="SELECT * FROM tblusers WHERE id = '$seller_id'";
$result2 = $dbhh->query($sql2);
if($result2->num_rows > 0){
$row2 = $result2->fetch_assoc();
$seller_email = $row2['EmailId'];
$seller_phone = "251".$row2['ContactNo'];



 // try {
// $message = "your varification token is $verificationToken";
//     $base_url = "w1k9gq.api.infobip.com";
//     $api_key = "d50f9e4a564c85a83d45bb66741d8416-4f089a2e-5873-4239-b106-bea4a32a1674";
//     $configuration = new Configuration(host: $base_url, apiKey: $api_key);
//     $api = new SmsApi(config: $configuration);
//     $destination = new SmsDestination(to: $phone);
//     $message = new SmsTextualMessage(destinations: [$destination], text: $message, from: "duresa");
//     $request = new SmsAdvancedTextualRequest(messages: [$message]);
//     $response = $api->sendSmsMessage($request);
//     echo "SMS notification sent successfully to $phone";
// } catch (Exception $e) {
//     echo "Failed to send SMS notification to $phone. Error: " . $e->getMessage();
// }
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
$mail->addAddress($seller_email, 'Recipient Name');
$mail->isHTML(true);                                  
$mail->Subject = 'Ownership Transfer approved by the buyer';
$mail->Body    = 'the ownership transfer for the vehicle has been approved <br>';
$mail->send();


$query="UPDATE ownership_transfere SET status = 1, approved_date = NOW() WHERE plate_number = '$plate_number' AND buyer_id='$id' AND status = 0";
$result = $dbhh->query($query);
if($result){
    $sql = "UPDATE tblvehicles SET userid = '$id', Post_status = 0 WHERE Plate_number = '$plate_number' AND id = '$vid'";
    echo "Debugging - SQL: $sql<br>";
    $result1 = $dbhh->query($sql);
    if($result1){
       $msg = "the transfere is completed sucessfully";
       $_SESSION['msg'] = $msg;
        echo "<script type='text/javascript'> document.location = 'my-posts.php'; </script>";
      
           }

}else{
    $error = "Failed to transfer";
    $_SESSION['error'] = $error;
}


} catch (Exception $e) {     
$error = "Ownership transfer initiated but failed to send verification email. Please try again later.";
}

}

}else{
    $error = "Failed to transfer";
    $_SESSION['error'] = $error;
    echo "Debugging - Error: $error<br>";
}
}



?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<title>Auto car rental and sales | Vehicle Details</title>
<!--Bootstrap -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
<!--Custome Style -->
<link rel="stylesheet" href="assets/css/style.css" type="text/css">
<!--OWL Carousel slider-->
<link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
<link rel="stylesheet" href="assets/css/owl.transitions.css" type="text/css">
<!--slick-slider -->
<link href="assets/css/slick.css" rel="stylesheet">
<!--bootstrap-slider -->
<link href="assets/css/bootstrap-slider.min.css" rel="stylesheet">
<!--FontAwesome Font Style -->
<link href="assets/css/font-awesome.min.css" rel="stylesheet">

<!-- SWITCHER -->
		<link rel="stylesheet" id="switcher-css" type="text/css" href="assets/switcher/css/switcher.css" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/red.css" title="red" media="all" data-default-color="true" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/orange.css" title="orange" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/blue.css" title="blue" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/pink.css" title="pink" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/green.css" title="green" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/purple.css" title="purple" media="all" />
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/images/favicon-icon/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/images/favicon-icon/apple-touch-icon-114-precomposed.html">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/images/favicon-icon/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="assets/images/favicon-icon/apple-touch-icon-57-precomposed.png">
<link rel="shortcut icon" href="assets/images/favicon-icon/auto.png">
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
<style>
    .error {
        color: red;
    }
    .errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
  /* Responsive PDF container */
.responsive-pdf-container {
    position: relative;
    width: 100%;
    overflow: hidden;
    padding-top: 56.25%; /* 16:9 aspect ratio for responsive iframe */
    margin-bottom: 20px; /* Add space between elements */
}

.responsive-pdf-container iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}

/* Responsive images */
.img-responsive {
    max-width: 100%;
    height: auto;
}
/*  */
  #listing_img_slider {
    display: flex;
    flex-wrap: nowrap;
    overflow-x: auto;
    margin: 0;
    padding: 0;
    -webkit-overflow-scrolling: touch; /* For smooth scrolling on iOS */
  }
  
  #listing_img_slider > div {
    margin: 0;
    padding: 0;
  }

  .custom-image {
    width: 500px;
    height: 250px;
  }
  .rounded-icon {
        width: 30px;
        height: 30px;
        background-color: #007BFF; /* Change the background color as needed */
        border-radius: 50%;
        display: inline-flex; /* Use inline-flex to make the icon and text inline */
        justify-content: center;
        align-items: center;
        margin-left: 10px; /* Adjust margin as needed */
    }

    .rounded-icon i {
        color: #fff; /* Change the icon color as needed */
        font-size: 16px; /* Adjust the icon size as needed */
    }
.video-container {
            position: relative;
            padding-bottom: 56.25%; /* 16:9 aspect ratio */
            padding-top: 25px;
            height: 0;
        }
        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 80%;
            height: 80%;
        }
</style>
</head>
<body>

<!-- Start Switcher -->
<?php include('includes/colorswitcher.php');?>
<!-- /Switcher -->  

<!--Header-->
<?php include('includes/header.php');?>
<!-- /Header --> 

<!--Listing-Image-Slider-->

<?php 

$vhid=intval($_GET['vhid']);
$sql = "SELECT tblvehicles.*,tblbrands.BrandName,tblbrands.id as bid  from tblvehicles join tblbrands on tblbrands.id=tblvehicles.VehiclesBrand where tblvehicles.id='$vhid'";
$result=$dbhh->query($sql);
$cnt=1;
if($result->num_rows > 0)
{
while($row=$result->fetch_assoc())
{ 
$_SESSION['brndid']=$row['bid'];  
?>  
<section id="listing_img_slider">
  <div><img src="admin/img/vehicleimages/<?php echo htmlentities($row['Vimage1']);?>" class="custom-image" alt="image"></div>
  <div><img src="admin/img/vehicleimages/<?php echo htmlentities($row['Vimage2']);?>" class="custom-image" alt="image"></div>
  <div><img src="admin/img/vehicleimages/<?php echo htmlentities($row['Vimage3']);?>" class="custom-image" alt="image"></div>
  <div><img src="admin/img/vehicleimages/<?php echo htmlentities($row['Vimage4']);?>" class="custom-image" alt="image"></div>
  <?php if($row['Vimage5']!="") { ?>
    <div><img src="admin/img/vehicleimages/<?php echo htmlentities($row['Vimage5']);?>" class="custom-image" alt="image"></div>
  <?php } ?>
</section>
<!--/Listing-Image-Slider-->
<!--Listing-detail-->
<section class="listing-detail">
  <div class="container">
    <div class="listing_detail_head row">
      <div class="col-md-9">
        <h2><?php echo htmlentities($row['BrandName']);?> , <?php echo htmlentities($row['VehiclesTitle']);?></h2>
      </div>
      <div class="col-md-3">
        <div class="price_info">
          <p><?php echo number_format(($row['Price']));?> ETB</p> 
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-9">
        <div class="main_features">
          <ul>
            <li> <i class="fa fa-calendar" aria-hidden="true"></i>
              <h5><?php echo htmlentities($row['ModelYear']);?></h5>
              <p>Reg.Year</p>
            </li>
            <li> <i class="fa fa-cogs" aria-hidden="true"></i>
              <h5><?php echo htmlentities($row['FuelType']);?></h5>
              <p>Fuel Type</p>
            </li>
       
            <li> <i class="fa fa-user-plus" aria-hidden="true"></i>
              <h5><?php echo htmlentities($row['SeatingCapacity']);?></h5>
              <p>Seats</p>
            </li>
          <!-- adding for milage -->
          <li> <i class="fa fa-tachometer" aria-hidden="true"></i>
              <h5><?php echo htmlentities($row['mileage']);?></h5>
              <p>Mileage</p>
            </li>
          </ul>
        </div>
<!-- showing message  -->

<?php if(isset($_SESSION['msg'])): ?>
                    <div class="succWrap" id="responseMessage"><strong>SUCCESS</strong>: <?php echo htmlentities($_SESSION['msg']); ?> 
                    <span id="countdown" style="display:none">5</span>
                    <script>
                    setTimeout(function(){
                        document.getElementById("responseMessage").style.display = "none";
                    }, 5000);
                    setTimeout(function(){
                        var i = document.getElementById("countdown");
                        if (parseInt(i.innerHTML) === 0) {
                            i.style.display = "none";
                        } else {
                            i.innerHTML = parseInt(i.innerHTML) - 1;
                        }
                        setTimeout(arguments.callee, 1000);
                    }, 1000);
                    </script>
                    </div>
                    <?php unset($_SESSION['msg']); ?>
                <?php endif; ?>

                <?php if(isset($_SESSION['error'])): ?>
                    <div class="errorWrap" id="responseMessage"><strong>ERROR</strong>: <?php echo htmlentities($_SESSION['error']); ?> </div>
                    <?php unset($_SESSION['error']); ?>
                <?php endif; ?>

<!-- end of showing message -->
        <div class="listing_more_info">
          <div class="listing_detail_wrap"> 
            <!-- Nav tabs -->
            <ul class="nav nav-tabs gray-bg" role="tablist">
            
              <li role="presentation" class="active"><a href="#vehicle-overview" aria-controls="vehicle-overview" role="tab" data-toggle="tab">vehicle documents </a></li>
              <li role="presentation"><a href="#accessories" aria-controls="accessories" role="tab" data-toggle="tab">Seller information</a></li>
              <?php if($_SESSION['login']) { ?>
                     <li role="presentation"><a href="#contact_info" aria-controls="contact_info" role="tab" data-toggle="tab">user contact information</a></li>
                 <?php } else { ?>
                     <li ><a href="#loginform" data-toggle="modal">Login for seller information</a></li>
                 <?php } ?>
            </ul>      
            <div class="tab-content">



 <!-- this is vhicles overview section  -->
 <div role="tabpanel" class="tab-pane active" id="vehicle-overview"><?php
           $vhid = intval($_GET['vhid']);
           $sql = "SELECT v.*, o.*
           FROM tblvehicles v
           INNER JOIN ownership_transfere o ON v.plate_number = o.plate_number
           WHERE v.id=$vhid AND o.status=0" ;

           $query = $dbhh->query($sql);
           if ($query->num_rows > 0) {
               while ($row = $query->fetch_assoc()) {
                   if(!empty($row['documents'])){
                       $documents = $row['documents'];
$filepath = "admin/img/vehicleimages/".$documents;

if(file_exists($filepath)){
    $type = explode('.', $documents);
    $extension = end($type); // Get the extension of the file

    if(in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])){
        echo '<img src="'.$filepath.'" style="width:200px;height:200px;object-fit:cover;margin:10px;">';
    } elseif($extension == 'pdf'){
        echo '<object data="'.$filepath.'" type="application/pdf" style="width:400px;height:400px;margin:10px;">
        <p>This browser does not support PDFs. Please download the PDF to view it: <a href="'.$filepath.'">Download PDF</a>.</p>
        </object>';
    } else{
        echo '<p style="color:red;">Error: File type not supported</p>';
    }
} else{
    echo '<p style="color:red;">Error: File not found</p>';
}



               }

            
$plate_number = $row['plate_number'];

$userid = $_SESSION['id'];


// Check if the logged-in user is the buyer
$sql = "SELECT COUNT(*) AS count FROM ownership_transfere WHERE plate_number='$plate_number' AND buyer_id=$userid AND status=0";
$query = $dbhh->query($sql);
$row = $query->fetch_assoc();

// Check if a pending transfer request exists and if the user is the buyer
if ($row['count'] > 0) {
?>
    <form action="transferedetails.php?vhid=<?php echo htmlentities($vhid);?>" method="post">
        <input type="hidden" name="vhid" value="<?php echo htmlentities($vhid); ?> ">
        <input type="hidden" name="plate_number" value="<?php echo htmlentities($plate_number); ?> ">
        <input type="submit" value="Request Transfer" name="request" class="btn btn-primary" style="margin-top:10px;margin-bottom:10px;">
    </form>
<?php
}
               }
               }

                 ?>
                 <hr>


              

</div>
              <!-- end of vehicle overview section  -->
              
<div role="tabpanel" class="tab-pane" id="accessories"> 
             
</div>
              <!--added for the garage integration part-->
              
<div role="tabpanel" class="tab-pane" id="contact_info">
    <div class="text-center">
        <h6> Seller information</h6>
    </div>
    <hr>
    <?php
    $vhid = intval($_GET['vhid']);
    $sql = "SELECT tblusers.FullName,tblusers.EmailId,tblusers.ContactNo,tblusers.photo,tblusers.id as userid,tblvehicles.* from tblvehicles join tblusers on tblusers.id=tblvehicles.userid where tblvehicles.id='$vhid'";
    $query = $dbhh->query($sql);
    if ($query->num_rows > 0) {
        while ($row3 = $query->fetch_assoc()) {
            $fname = $row3['FullName'];
            $email = $row3['EmailId'];
            $mobile = $row3['ContactNo'];
            $address = $row3['Address'];
            $city = $row3['City'];
            $country = $row3['Country'];
            $image = $row3['photo'];
            $id = $row3['userid'];
    ?>
            <?php 
        if(empty($image)) {
    ?>
                <div style="display: flex; flex-direction: column; align-items: center; margin: 20px 0;">
                <img src="profile.png" alt="Seller Image" style="border-radius: 50%; width: 100px; height: 100px; object-fit: cover;">
                <div style="display: flex; justify-content: center; width: 100%;">
    <?php 
        } else {
    ?>
                            <div style="display: flex; flex-direction: column; align-items: center; margin: 20px 0;">
                              <img src="<?php echo $image; ?>" alt="Seller Image" style="border-radius: 50%; width: 200px; height: 200px; object-fit: cover;">
                                <div style="display: flex; justify-content: center; width: 100%;">
    <?php 
        }
    ?>


<div style="text-align: center; margin-top: 20px;">
    <div class="rounded-icon">
        <i class="fa fa-envelope" aria-hidden="true"></i>
    </div>
    <p class="uppercase_text" style="color: #555; display: inline;">Email: <a href="mailto:<?php echo htmlentities($email); ?>" style="color: #007BFF; text-decoration: none;">
            <?php echo htmlentities($email); ?></a> </p>
</div>
<div style="text-align: center; margin-top: 20px;">
    <div class="rounded-icon">
        <i class="fa fa-phone" aria-hidden="true"></i>
    </div>
    <p class="uppercase_text" style="color: #555; display: inline;">Phone number: <a href="tel:<?php echo htmlentities($mobile); ?>" style="color: #007BFF; text-decoration: none;">
            <?php echo htmlentities($mobile); ?></p>

</div>
                </div>
                <?php
                if ($_SESSION['id'] == $id) {
                ?>
                   <a href="#" class="disabled-link" style="text-decoration: none; color: #aaa; background-color: #eee; padding: 8px 16px; border-radius: 4px; margin-top: 20px; cursor: not-allowed;" disabled>
                   <i class="fa fa-comments" aria-hidden="true"></i> You can't chat with yourself
                   </a>

                <?php } else {
                ?>
                    <a href="chat-area.php?user_id=<?php echo $id; ?>" style="text-decoration: none; color: #fff; background-color: #007BFF; padding: 8px 16px; border-radius: 4px; margin-top: 20px;">
                        <i class="fa fa-comments" aria-hidden="true"></i>Start chat
                    </a>
                <?php
                }
                ?>
            </div>
    <?php
        }
    }
}
}
    ?>
</div>

   
      </div>
      
      
    </div>
    
    <div class="space-20"></div>
    <div class="divider"></div>
    

    <!--Similar-Cars-->

    <!--/Similar-Cars--> 
    
  </div>
</section>
<!--/Listing-detail--> 

<!--Footer -->
<?php include('includes/footer.php');?>
<!-- /Footer--> 

<!--Back to top-->
<div id="back-top" class="back-top"> <a href="#top"><i class="fa fa-angle-up" aria-hidden="true"></i> </a> </div>
<!--/Back to top--> 

<!--Login-Form -->
<?php include('includes/login.php');?>
<!--/Login-Form --> 

<!--Register-Form -->
<?php include('includes/registration.php');?>

<!--/Register-Form --> 

<!--Forgot-password-Form -->
<?php include('includes/forgotpassword.php');?>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script> 
<script src="assets/js/interface.js"></script> 
<script src="assets/switcher/js/switcher.js"></script>
<script src="assets/js/bootstrap-slider.min.js"></script> 
<script src="assets/js/slick.min.js"></script> 
<script src="assets/js/owl.carousel.min.js"></script>
</body>
</html>
