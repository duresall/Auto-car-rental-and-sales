<?php
require "../../vendor/autoload.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('includes/config.php');
include('includes/configtwo.php');
$error="";
$msg="";
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:../index.php');
}
else{

if(isset($_POST['submit'])){
//first step  emailun be meyaze garage_registration milew table lay kene token  masgebate

$email=$_POST['email'];
function generateToken() {
 
    $token = bin2hex(random_bytes(16)); 
    return $token;
}

function sendRegistrationEmail($email, $token) {
    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);
    // SMTP configuration
	$mail = new PHPMailer(true);
	$mail->isSMTP();
	$mail->Host = 'smtp.gmail.com'; 
	$mail->SMTPAuth = true;
	$mail->Username = 'add email';
	$mail->Password = 'kdccfswebrxzinnz';
	$mail->SMTPSecure = 'tls'; 
	$mail->Port = 587;
	$mail->setFrom('add email', 'Auto car rental and sales');
	$mail->addAddress($email, 'Recipient Name');
	$mail->isHTML(true);
    $mail->Subject = 'Registration Link for Garage System';
    $mail->Body = "Dear Garage Owner,<br><br>"
                . "Please click on the following link to register with our system:<br>"
                . "<a href='http://172.20.10.3/emu/Auto%20connect/garage/registration.php?token=$token'>Register Now</a>";
    // Send email
    if(!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    }
}

//hased token ensera 
$token = generateToken();
$sql = "INSERT INTO garage_registration (email, token) VALUES ('$email', '$token')";

$result=$dbhh->query($sql);
if($result){
	$_SESSION['msg']  = "Registration initiated successfully. An email will be sent to $email shortly.";
	sendRegistrationEmail($email, $token);
}else{
	$_SESSION['error']  = "Something went wrong. Please try again.";
}

}
?>
<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
	
	<title>Car Rental Portal | Admin Create Brand</title>

	<!-- Font awesome -->
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<!-- Sandstone Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Bootstrap Datatables -->
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<!-- Bootstrap social button library -->
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<!-- Bootstrap select -->
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<!-- Bootstrap file input -->
	<link rel="stylesheet" href="css/fileinput.min.css">
	<!-- Awesome Bootstrap checkbox -->
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<!-- Admin Stye -->
	<link rel="stylesheet" href="css/style.css">
  <style>
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
		</style>


</head>

<body>
	<?php include('includes/header.php');?>
	<div class="ts-main-content">
	<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">
					
						<h2 class="page-title">Create Account</h2>
						<div class="row">
							<div class="col-md-10">
								<div class="panel panel-default">
									<div class="panel-heading">Create Account</div>
									<div class="panel-body">
										<form method="post" name="chngpwd" class="form-horizontal" onSubmit="return valid();">
										<?php 
                                          if(isset($_SESSION['error'])) {
                                              echo '<div class="errorWrap"><strong>ERROR</strong>: ' . htmlentities($_SESSION['error']) . '</div>';
                                              unset($_SESSION['error']);
                                          } elseif(isset($_SESSION['msg'])) {
                                              echo '<div class="succWrap"><strong>SUCCESS</strong>: ' . htmlentities($_SESSION['msg']) . '</div>';
                                              unset($_SESSION['msg']);
                                          }
                                          ?>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Email</label>
                                    <div class="col-sm-8">
                                        <input type="email" class="form-control" name="email" id="email" onBlur="checkAvailability()" required>
									 <span id="garage-email-availability-status" style="font-size:16px;"></span>
                                    </div>
                                </div>
						<div class="form-group">
							<div class="col-sm-8 col-sm-offset-4">
								<button class="btn btn-primary" name="submit" type="submit" id="submit">Create account</button>
							</div>
						</div>

					</form>
					</div>
					</div>
							</div>
							
						</div>
						
					

					</div>
				</div>
				
			
			</div>
		</div>
	</div>
	<script>
          function checkAvailability() {
          $("#loaderIcon").show();
          jQuery.ajax({
          url: "check_availability.php",
          data:'email='+$("#email").val(),
          type: "POST",
          success:function(data){
          $("#garage-email-availability-status").html(data);
          $("#loaderIcon").hide();
          },
          error:function (){}
          });
          }
</script>
	<!-- Loading Scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>
</body>

</html>
<?php } ?>