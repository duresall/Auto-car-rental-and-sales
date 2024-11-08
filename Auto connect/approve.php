<?php
session_start();
include('includes/config.php');
include('includes/configtwo.php');
error_reporting(E_ALL);
require "../vendor/autoload.php";
use Infobip\Configuration;
use Infobip\Api\SmsApi;
use Infobip\Model\SmsDestination;
use Infobip\Model\SmsTextualMessage;
use Infobip\Model\SmsAdvancedTextualRequest;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
if(isset($_POST['request'])) {


echo "<pre>";
print_r($_POST);
echo "</pre>";
$vid = $_POST['vhid'];
$plate_number = $_POST['plate_number'];
$id=$_SESSION['id'];

$query="UPDATE ownership_transfere SET status = 1, approved_date = NOW() WHERE plate_number = '$plate_number' AND buyer_id='$id' AND status = 0";
$result = $dbhh->query($query);
if($result){

    $sql = "UPDATE tblvehicles SET userid = '$id', Post_status = 0 WHERE Plate_number = '$plate_number' AND id = '$vid'";
    $result1 = $dbhh->query($sql);
    if($result1){
        $sql_email = "SELECT 
            t.seller_id,
            t.buyer_id,
            u.EmailId AS seller_email,
            u1.EmailId AS buyer_email,
            u.ContactNo AS seller_phone,
            u1.ContactNo AS buyer_phone
        FROM 
            ownership_transfere t
        JOIN 
            tblusers u ON t.seller_id = u.id
        JOIN 
            tblusers u1 ON t.buyer_id = u1.id
        WHERE 
            t.plate_number = '$plate_number' AND t.buyer_id = '$id' AND t.status = 1";
        $result_email = $dbhh->query($sql_email);

        if($result_email->num_rows > 0) {
            $row_email = $result_email->fetch_assoc();
            $seller_email = $row_email['seller_email'];
            $buyer_email = $row_email['buyer_email'];
            $seller_phone = "251".$row_email['seller_phone'];
            $buyer_phone = $row_email['buyer_phone'];
    
    //lets send an email and sms for both buyer and seller
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
        $mail->Subject = 'transfere notification';
        $mail->Body = 'the transfere has been sucessful completed';
        $mail->send();
        echo "Email notification sent successfully to $email";
    } catch (Exception $e) {
        echo "Failed to send email notification to $email. Error: " . $mail->ErrorInfo;
        echo "Error in sending email notification to $email. ". $e->getMessage();
        console_log("Error in sending email notification to $email. ". $e->getMessage());
    }
    // Send SMS
    try {
        $message = "Notification message for SMS.";
        $base_url = "w1k9gq.api.infobip.com";
        $api_key = "d50f9e4a564c85a83d45bb66741d8416-4f089a2e-5873-4239-b106-bea4a32a1674";
        $configuration = new Configuration(host: $base_url, apiKey: $api_key);
        $api = new SmsApi(config: $configuration);
        $destination = new SmsDestination(to: $seller_phone);
        $message = new SmsTextualMessage(destinations: [$destination], text: $message, from: "duresa");
        $request = new SmsAdvancedTextualRequest(messages: [$message]);
        $response = $api->sendSmsMessage($request);
        echo "SMS notification sent successfully to $seller_phone";
    } catch (Exception $e) {
        echo "Failed to send SMS notification to $seller_phone. Error: " . $e->getMessage();
        console_log("Error in sending SMS notification to $seller_phone. ". $e->getMessage());
    }
        echo "<script>alert('Transfere Sucessful')</script>";
        echo "<script type='text/javascript'> document.location = 'my-posts.php'; </script>";
        }
       
    }

}


}

