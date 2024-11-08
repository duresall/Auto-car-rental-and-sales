<?php
require "../../vendor/autoload.php";
use Infobip\Configuration;
use Infobip\Api\SmsApi;
use Infobip\Model\SmsDestination;
use Infobip\Model\SmsTextualMessage;
use Infobip\Model\SmsAdvancedTextualRequest;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
session_start();
include('includes/configtwo.php');
error_reporting(E_ALL);
if(strlen($_SESSION['alogin'])==0) {	
    header('location:../index.php');
} else {
$msg="";
$error="";
if(isset($_POST['submit'])) {
        $date_and_time=$_POST['appointment_date'];
        $respons=$_POST['response_message'];
        $userid=$_POST['userid'];
        $vid=$_POST['vid'];

        $query = "UPDATE schedule 
          SET appointment_date = '$date_and_time', 
              response_message = '$respons', 
              status = 1 
          WHERE userid = '$userid' 
          AND vid = '$vid'
          AND status = 0";
        $result=$dbhh->query($query);
        if($result) {
            $msg = "Response sent successfully ".$userid;
            // lets send an email and sms
           $sql ="SELECT * FROM tblusers WHERE id='$userid'";
           $result=$dbhh->query($sql);
           $row=$result->fetch_assoc();
           $email=$row['EmailId'];
           $username=$row['FullName'];
           $phone=$row['ContactNo'];
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
                $mail->addAddress($email, $username);
                $mail->isHTML(true);
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
                $htmlContent .= '<p>dear '.$username.' your request has been accepted by the garage for your vehicle contact the garage for more information  </p>';
                $htmlContent .= '</div>';
                $htmlContent .= '<div class="details">';
                $htmlContent .= '</div>'; 
                $htmlContent .= '</body></html>';
                $mail->Body = $htmlContent;
                $mail->send();
                echo "Email notification sent successfully to $email";
            } catch (Exception $e) {
                echo "Failed to send email notification to $email. Error: " . $mail->ErrorInfo;
            }
            try {
                $message = "your request for inspection have been accepted.";
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
    }else {
            $error = "Something went wrong. Please try again: " . mysqli_error($dbhh);
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
    <title>Garage Inspection Form</title>
    <!-- Font awesome -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- Sandstone Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Admin Stye -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Bootstrap Datetimepicker CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">

    <style>
        .errorWrap {
            padding: 10px;
            margin: 0 0 20px 0;
            background: #fff;
            border-left: 4px solid #dd3d36;
            -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
            box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
        }
        .succWrap {
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
                        <h2 class="page-title">Garage response Form</h2>
                        <div class="row">
                            <div class="col-md-10">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Response Form</div>
                                    <div class="panel-body">          
                                    <form  method="post" name="appointment_response_form" class="form-horizontal">
    <?php if($error){ ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
    else if($msg){ ?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>

    <!-- Hidden field to store appointment ID -->
    <?php
                 $userid=$_GET['id'];
                 $vid=$_GET['vid'];
?>
 <input type="hidden" name="userid" value="<?php echo $userid; ?>">
 <input type="hidden" name="vid" value="<?php echo $vid;?>">
    <div class="form-group">
        <label class="col-sm-4 control-label">Appointment Date & Time</label>
        <div class="col-sm-8">
            <input type="date" class="form-control" name="appointment_date" >
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-4 control-label">Response Message</label>
        <div class="col-sm-8">
            <textarea class="form-control" rows="5" name="response_message" required></textarea>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-8 col-sm-offset-4">
            <button class="btn btn-primary" name="submit" type="submit">Submit Response</button>
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
    <!-- Loading Scripts -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Bootstrap Datetimepicker JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>

</body>
</html>
<?php  ?>
