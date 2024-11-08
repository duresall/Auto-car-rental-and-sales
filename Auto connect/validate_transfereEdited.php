<?php
require "../vendor/autoload.php";
use Infobip\Configuration;
use Infobip\Api\SmsApi;
use Infobip\Model\SmsDestination;
use Infobip\Model\SmsTextualMessage;
use Infobip\Model\SmsAdvancedTextualRequest;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
session_start(0);
include('includes/config.php');
include('includes/configtwo.php');
if(strlen($_SESSION['login'])==0)
  { 
header('location:index.php');
}else{
  if(isset($_POST['confirm'])) {
    if(isset($_POST['token'])) {
      $token = $_POST['token'];
      $sql = "SELECT * FROM ownership_transfere WHERE BINARY token = BINARY '$token' and token_used=0";
    $result = $dbhh->query($sql);
    echo "<pre>";
      print_r($_POST);
    echo "</pre>";
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $transfere_id = $row['transfere_id'];
        $seller_id = $row['seller_id'];
        $buyer_id = $row['buyer_id'];
        $plate_number = $row['plate_number'];
        $updateSql = "UPDATE ownership_transfere SET token_used = 1 WHERE token = '$token'";
        $updateResult = $dbhh->query($updateSql);
      if($updateResult){

  //if authenticated send an email to the buyer 


          //lets get the email fo the the buyer using the id of the buyer

          $query1="SELECT * FROM tblusers WHERE id=$buyer_id";
          $result1 = $dbhh->query($query1);
          if($result1->num_rows > 0) {
              $row1 = $result1->fetch_assoc();
              $buyer_email = $row1['EmailId'];
              $phone = $row1['ContactNo'];
//sendemail
   
          // send text message using infobid provider  
      // try {
// $message = "your varification token is $verificationToken";
//     $base_url = "add url base here ";
//     $api_key = "add api key her";
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
// sending notification with email using smtp                            
try {
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com'; 
$mail->SMTPAuth = true;
$mail->Username = '//add the email here ';
$mail->Password = 'kdccfswebrxzinnz';
$mail->SMTPSecure = 'tls'; 
$mail->Port = 587;
$mail->setFrom('add the email that is going to be sent from here simmilar to username', 'Auto car rental and sales');
$mail->addAddress($buyer_email, '');
$mail->isHTML(true);                                  
$mail->Subject = 'Ownership Transfer Verification';
$mail->Body    = 'this message is to notifiy you for ownership transfer aproval process<br><br>';
$mail->Body   .= 'A vehicle transfer request is currently pending your approval in your Auto Connect account. To ensure the smooth processing of this transfer, we kindly ask you to verify the details and authorize the transaction.

Please log in to your Auto Connect account to review and approve the transfer. If you were not anticipating this request or if it seems unfamiliar, you can simply ignore this message. ';
$mail->send();
header("Location: validate_transfere.php?email_sent=true");
exit();
} catch (Exception $e) {     
$msg = "Ownership transfer initiated but failed to send verification email. Please try again later.";
}

          }

        $query1 = "UPDATE tblvehicles SET userid = '$buyer_id', Post_status = 0 WHERE Plate_number = '$plate_number'";
        $result1 = $dbhh->query($query1);
        if($result1) {
                      //SENING SMS AND EMAIL FOR THE GEZI
            $msg = "Your ownership transfer has been sucessful.";

            
        } else {
            $msg = "Error while transfere. Please try again.";
        }
    } else {
        $error = "Invalid verification token. Please try again.";
    }
  } else {
      // Handle the case where the token is not set
      $error = "invalid token.";
  }
} else {
  $error="something went wrong with the update";
}
}

?>
  <!DOCTYPE HTML>
<html lang="en">
<head>

<title>Auto car rental and sales | Transfere Owneship</title>
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
  .upload_user_logo {
  float: left;
  position: relative;
  width: 20%;
  padding: auto;
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
.user_profile_info {
    border: 1px solid #ccc;
    border-radius: 8px;
    padding: 20px;
    display: flex;
    align-items: center;
}

.upload_user_logo img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    margin-right: 20px;
    object-fit: cover;
}
.col-md-8 {
    width: calc(100% - 120px); 
}
.dealer_info {
    padding: 10px;
}
.uppercase {
    text-transform: uppercase;
}
.underline {
    text-decoration: underline;
}

.user-details {
    display: flex;
    flex-direction: column;
}

.user-detail {
    margin-bottom: 10px;
}

.detail-label {
    font-weight: bold;
    margin-right: 5px;
}

.detail-value {
    color: #333;
    font-weight: bold;
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
<!--Page Header-->
<section class="page-header profile_page">
  <div class="container">
    <div class="page-header_wrap">
      <div class="page-heading">
        <h1>Your Profile</h1>
      </div>
      <ul class="coustom-breadcrumb">
        <li><a href="#">Home</a></li>
        <li>Profile</li>
      </ul>
    </div>
  </div>
  <!-- Dark Overlay-->
  <div class="dark-overlay"></div>
</section>
<!-- /Page Header--> 

<?php 
$useremail=$_SESSION['login'];
$sql = "SELECT * from tblusers where EmailId=:useremail";
$query = $dbh -> prepare($sql);
$query -> bindParam(':useremail',$useremail, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{ ?>
<section class="user_profile inner_pages">
  <div class="container">
  <div class="user_profile_info gray-bg padding_4x4_40">
  <div class="upload_user_logo">
    <?php 
        if(empty($result->photo)) {
    ?>
            <img src="profile.png" alt="Default Profile Image">
    <?php 
        } else {
    ?>
            <img src="<?php echo htmlentities($result->photo); ?>" alt="User Profile Image">
    <?php 
        }
    ?>
</div>

    <div class="col-md-8">
        <div class="dealer_info">
            <h6 class="uppercase underline">User Information</h6>
            <div class="user-details">
                <div class="user-detail">
                    <span class="detail-label">Full Name:</span>
                    <span class="detail-value"><?php echo htmlentities($result->FullName);?></span>
                </div>
                <div class="user-detail">
                    <span class="detail-label">Address:</span>
                    <span class="detail-value"><?php echo htmlentities($result->Address);?></span>
                </div>
                <div class="user-detail">
                    <span class="detail-label">City:</span>
                    <span class="detail-value"><?php echo htmlentities($result->City);?></span>
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="row">
      <div class="col-md-3 col-sm-3">
        <?php include('includes/sidebar.php');?>
      <div class="col-md-6 col-sm-8">
        <div class="profile_wrap">
          <h5 class="uppercase underline">Transfer Ownership</h5>
          <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
                 else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
          <form   method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label class="control-label">Enter the varification code</label>
              <input class="form-control white_bg" name="token"  id="token" type="text" required>
            </div>
            <!-- the end for the transfere of ownership form -->
            <?php }} ?>
            <div class="form-group">
              <button type="submit" name="confirm" id="submit" class="btn">confirm<span class="angle_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<!--/Profile-setting--> 

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
<!--/Forgot-password-Form --> 
<!-- Scripts --> 
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script> 
<script src="assets/js/interface.js"></script> 
<!--Switcher-->
<script src="assets/switcher/js/switcher.js"></script>
<!--bootstrap-slider-JS--> 
<script src="assets/js/bootstrap-slider.min.js"></script> 
<!--Slider-JS--> 
<script src="assets/js/slick.min.js"></script> 
<script src="assets/js/owl.carousel.min.js"></script>

</body>
</html>
<?php } ?>