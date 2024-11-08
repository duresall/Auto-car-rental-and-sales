<?php
require "../vendor/autoload.php";
use Infobip\Configuration;
use Infobip\Api\SmsApi;
use Infobip\Model\SmsDestination;
use Infobip\Model\SmsTextualMessage;
use Infobip\Model\SmsAdvancedTextualRequest;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/configtwo.php');
if(strlen($_SESSION['login'])==0)
  { 
header('location:index.php');
}
else{
  if(strlen($_SESSION['login']) == 0) { 
    header('location:index.php');
} else {

  
    if(isset($_POST['transfere'])) {
        $seller_email=$_SESSION['login'];
        $sellerId = $_SESSION['id']; 
        $buyerEmail = $_POST['emailid'];
        $password=md5($_POST['Password']);
        $query="SELECT * FROM tblusers WHERE EmailId='$seller_email' AND Password='$password'";
        $result=$dbhh->query($query);
        $count=$result->num_rows;
        if($count==0)
        {
            $error="Incorrect Details !";
        }
        else
        {
        $plateNumber = $_POST['platenumber'];
        $query1="SELECT id FROM tblusers WHERE EmailId='$buyerEmail'";
        $result1=$dbhh->query($query1);
        $row1=$result1->fetch_assoc();
        $buyerId=$row1['id'];
        $sellerId=$_SESSION['id'];
        $verificationToken = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 5); 
        $sql = "INSERT INTO ownership_transfere (seller_id,plate_number, buyer_id, token) VALUES ('$sellerId','$plateNumber', '$buyerId', '$verificationToken')";
        $stmt = $dbhh->query($sql);
        if ($stmt) {
          $query="SELECT * FROM tblusers WHERE EmailId='$buyerEmail'";
          $result=$dbhh->query($query);
          $row=$result->fetch_assoc();
          $phone=$row['ContactNo'];
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
              $mail->addAddress($seller_email, '');
                $mail->isHTML(true);                                  
                $mail->Subject = 'Ownership Transfer Verification';
                $mail->Body    = 'Your verification token for ownership transfer is: ' . $verificationToken . '<br><br>';
                $mail->Body   .= 'Please enter this token on the verification page to complete the ownership transfer.';
                $mail->send();
                header("Location: validate_transfereEdited.php?email_sent=true");
                exit();
            } catch (Exception $e) {     
                $msg = "Ownership transfer initiated but failed to send verification email. Please try again later.";
            }
        } else {
            $error = "Error: Failed to initiate ownership transfer. Please try again later.";
        }
    }
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
              <label class="control-label">Enter Buyers Email</label>
              <input class="form-control white_bg" name="emailid" onBlur="checkAvailability()" id="emailid" type="emailid"required>
              <span id="user-availability-status" style="font-size:12px;"></span> 
            </div>
            <div class="form-group">
              <label class="control-label">Enter The Vehicle plate number</label>
              <input class="form-control white_bg" name="platenumber" onBlur="platenumbers()" id="platenumber" type="platenumber" required>
                   <span id="plate-number-validation" style="font-size:12px;"></span> 
            </div>
            <div class="form-group">
              <label class="control-label">Enter your Password</label>
              <input class="form-control white_bg" name="Password"  id="Password" type="Password" required>
            </div>
            <!-- the end for the transfere of ownership form -->
            <?php }} ?>
            <div class="form-group">
              <button type="submit" name="transfere" id="submit" class="btn">Transfere Ownership <span class="angle_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></button>
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
<script>
function checkAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "./users/action/checkemail.php",
data:'emailid='+$("#emailid").val(),
type: "POST",
success:function(data){
$("#user-availability-status").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>

<script>
function platenumbers() {
    $("#loaderIcon").show();
    jQuery.ajax({
        url: "./users/action/platenumber.php",
        data:'platenumber='+$("#platenumber").val(),
        type: "POST",
        success:function(data){
            $("#plate-number-validation").html(data);
            $("#loaderIcon").hide();
        },
        error:function (){}
    });
}
</script>

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