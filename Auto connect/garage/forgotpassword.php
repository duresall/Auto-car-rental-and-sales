<?php
include('includes/configtwo.php');
require "../../vendor/autoload.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
$error="";
$msg="";

if(isset($_POST['send'])){
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
	$mail->Username = 'autoconnectcar@gmail.com';
	$mail->Password = 'kdccfswebrxzinnz';
	$mail->SMTPSecure = 'tls'; 
	$mail->Port = 587;
	$mail->setFrom('autoconnectcar@gmail.com', 'Auto car rental and sales');
	$mail->addAddress($email, 'Recipient Name');
	$mail->isHTML(true);
    $mail->Subject = 'rest password';
    $mail->Body = "reset your password using this email,<br><br>"
                . "Please click on the following link to restore your password:<br>"
                . "<a href='http://172.20.10.3/emu/Auto%20connect/garage/reset.php?token=$token'>Reset password</a>";
    // Send email
    if(!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    }
}

//hased token ensera 
$token = generateToken();
$sql = "INSERT INTO resetpassword (email, token) VALUES ('$email', '$token')";

$result=$dbhh->query($sql);
if($result){
	$_SESSION['msg']  = "a rest form has been sent to the email $email .";
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

	<title>Auto car rental and sales  | password reset</title>
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<link rel="stylesheet" href="css/fileinput.min.css">
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<link rel="stylesheet" href="css/style.css">
</head>
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
<body>	
	<div class="login-page bk-img" style="background-image: url(img/login-bg.jpg);">
	<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error);
			   ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
		<div class="form-content">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-md-offset-3">
						<h1 class="text-center text-bold mt-4x" style="color:#fff">Garage | Sign in</h1>
						<div class="well row pt-2x pb-3x bk-light">
							<div class="col-md-8 col-md-offset-2">
								<form method="post">
									<label for="" class="text-uppercase text-sm">Email </label>
									<input type="text" placeholder="Email" name="email" id="email" onblur="checkAvailability()" class="form-control mb">
									<span id="user-availability-status" style="font-size:12px;"></span>
									<button class="btn btn-primary btn-block" name="send" id="send" type="submit">SEND</button>
								</form>
							</div>
						</div>	
					</div>
				</div>
			</div>
		</div>
	</div>
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
	<script>
function checkAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "forgot.php",
data:'email='+$("#email").val(),
type: "POST",
success:function(data){
$("#user-availability-status").html(data);
$("#loaderIcon").hide();
},
error:function (){
}
});
}
</script>

</body>

</html>