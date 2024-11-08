<?php
require "../../vendor/autoload.php";
require "../../vendor/vendor/autoload.php";

use Infobip\Configuration;
use Infobip\Api\SmsApi;
use Infobip\Model\SmsDestination;
use Infobip\Model\SmsTextualMessage;
use Infobip\Model\SmsAdvancedTextualRequest;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use Twilio\Rest\Client;
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('includes/config.php');
include('includes/configtwo.php');
$error = '';
$msg = '';
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:../index.php');
}
else{
        if(isset($_POST['id']) && isset($_POST['status'])) {
   
            $vehicleId = $_POST['id'];
            $status = $_POST['status'];
            $sql = "UPDATE tblvehicles SET status = '$status' WHERE id = '$vehicleId'";
             $result=$dbhh->query($sql);
             if($result){
            $msg= "Status updated successfully for vehicle ID: " . $vehicleId;
            if($_POST['status'] == 2){
                header("Location: reason.php?id=".$vehicleId);
                exit();
            }        
           $query = "SELECT v.*, u.FullName, u.EmailId, u.ContactNo FROM tblvehicles v INNER JOIN tblusers u ON v.userid = u.id WHERE v.id = '$vehicleId'";
           $result1=$dbhh->query($query);
           $row=$result1->fetch_assoc();
           $brandname=$row['VehiclesBrand'];
           $vehicle_for=$row['vehicle_for'];
           $userName=$row['FullName'];
           $useremail=$row['EmailId'];
           $userPhone=$row['ContactNo'];
             // Section for sending preference email and sms
        if($row['status'] == 1) {
    $sqlPreference = "SELECT p.email, p.phone, v.* FROM pereference p INNER JOIN tblvehicles v ON p.Brand = v.VehiclesBrand WHERE p.Brand = '$brandname' AND v.id = '$vehicleId'";
    $resultPreference = $dbhh->query($sqlPreference);
    if ($resultPreference->num_rows > 0) {
        while ($rowPreference = $resultPreference->fetch_assoc()) {
            $email = $rowPreference['email'];
            $phone = "+251" . $rowPreference['phone']; 
            $price=$rowPreference['Price'];   
            $mileage=$rowPreference['mileage'];
            $vehicletitle=$rowPreference['VehicleTitle'];   
            $location=$rowPreference['location']; 
            $modelyear=$rowPreference['ModelYear'];
            $FuelType=$rowPreference['FuelType'];
            $seatingcapacity=$rowPreference['SeatingCapacity'];
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
                $htmlContent .= '<p>dear .. we have a matching for your preference....</p>';
                $htmlContent .= '</div>';
                $htmlContent .= '<div class="details">';
                $htmlContent .= '<div class="detail-item"><span class="detail-label">Fuel Type:</span><span class="detail-value">' . $FuelType . '</span></div>';
                $htmlContent .= '<div class="detail-item"><span class="detail-label">Price:</span><span class="detail-value">' . $price . '</span></div>';
                $htmlContent .= '<div class="detail-item"><span class="detail-label">Model Year:</span><span class="detail-value">' . $modelyear . '</span></div>';
                $htmlContent .= '<div class="detail-item"><span class="detail-label">Seating Capacity:</span><span class="detail-value">' . $seatingcapacity . '</span></div>';
                $htmlContent .= '</div>';
                $htmlContent .= '<div class="detail-item"><span class="detail-label" class="text-center">Contact information</span></div>';
                $htmlContent .= '<div class="detail-item"><span class="detail-label">Email:</span><span class="detail-value">' . $useremail . '</span></div>';
                $htmlContent .= '<div class="detail-item"><span class="detail-label">Contact Name:</span><span class="detail-value">' . $userName . '</span></div>';
                $htmlContent .= '<div class="detail-item"><span class="detail-label">Contacts Phone number:</span><span class="detail-value">' . $userPhone . '</span></div>';
                $htmlContent .= '</div>'; 
                $htmlContent .= '</body></html>';
                $mail->Body = $htmlContent;
                $mail->send();
                echo "Email notification sent successfully to $email";
            } catch (Exception $e) {
                echo "Failed to send email notification to $email. Error: " . $mail->ErrorInfo;
            }
            try {
                $message = "preferace.";
                $base_url = "1vyy39.api.infobip.com";
                $api_key = "d01356e4ee79c1a2e41ef854d8d5452a-02a45fb1-47ce-4ceb-b233-6b238a7dfd1b";
                $configuration = new Configuration(host: $base_url, apiKey: $api_key);
                $api = new SmsApi(config: $configuration);
                $destination = new SmsDestination(to: $phone);
                $message = new SmsTextualMessage(destinations: [$destination], text: $message, from: "duresa");
                $request = new SmsAdvancedTextualRequest(messages: [$message]);
                $response = $api->sendSmsMessage($request);
                echo "SMS notification sent successfully to $phone";
                $msg = "The Approval was Successfully ";
                
            } catch (Exception $e) {
                echo "Failed to send SMS notification to $phone. Error: " . $e->getMessage() . PHP_EOL;
            }
        }
    }
}

// cancel letederegebet mkniyate 


    



        } else {
            $error= "Failed to update status for vehicle ID: " . $vehicleId;
         
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
	
	<title>Auto car rental and sales |Admin Manage Vehicles   </title>
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

						<h2 class="page-title">Pending Vehicles</h2>

						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-heading">Vehicle Details</div>
							<div class="panel-body">
                            <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>

								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
										<th>#</th>
											<th>Vehicle Title</th>
											<th>Brand </th>
											<th>Price </th>
											<th>Fuel Type</th>
											<th>Model Year</th>
											<th>Owner</th>
                                            <th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
										<th>#</th>
										<th>Vehicle Title</th>
											<th>Brand </th>
											<th>Price </th>
											<th>Fuel Type</th>
											<th>Model Year</th>
											<th>Owner</th>
                                            <th>Status</th>
											<th>Action</th>
										</tr>
										</tr>
									</tfoot>
									<tbody>
	<?php 
 
$sql = "SELECT tblvehicles.VehiclesTitle, tblvehicles.userid, tblvehicles.status, tblbrands.BrandName, 
        tblvehicles.Price, tblvehicles.FuelType,
        tblvehicles.ModelYear, tblvehicles.id, tblusers.FullName
        FROM tblvehicles
        JOIN tblbrands ON tblbrands.id = tblvehicles.VehiclesBrand
        JOIN tblusers ON tblusers.id = tblvehicles.userid";

$result = $dbhh->query($sql);
$cnt = 1;
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
        if ($row['status'] == 0) { 
?>
<div id="confirmModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Confirm Action</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                to approve the vehicle click on confirm else click on cancel?
            </div>
            <div class="modal-footer">
                <button type="button" id="confirmButton" class="btn btn-primary" data-dismiss="modal" data-id="<?php echo $row['id']; ?>">Approve</button>  
                <button type="button" id="cancelButton" class="btn btn-secondary" data-dismiss="modal" data-id="<?php echo $row['id']; ?>">Cancel Post</button>
            </div>
        </div>
    </div>
</div>
            <tr>
                <td><?php echo htmlentities($cnt);?></td>
                <td><?php echo htmlentities($row['VehiclesTitle']);?></td>
                <td><?php echo htmlentities($row['BrandName']);?></td>
                <td><?php echo htmlentities($row['Price']);?></td>
                <td><?php echo htmlentities($row['FuelType']);?></td>
                <td><?php echo htmlentities($row['ModelYear']);?></td>
                <td><?php echo htmlentities($row['FullName']);?></td>
                <td><?php echo "pending";?></td>
                <td>
                    <a href="view-vehicles.php?id=<?php echo $row['id'];?>"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                    <a href="#" class="change-status" data-id="<?php echo $row['id'];?>" data-toggle="modal" data-target="#confirmModal"><i class="fa fa-exchange"></i></a>
                </td>
            </tr>
<?php 
            $cnt++;
        }
    }
}
?>
									</tbody>
								</table>
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
  $(document).ready(function(){
      $('.change-status').click(function(){
          var vehicleId = $(this).data('id');
          $('#confirmButton').attr('href', 'pending-vehicles.php?pending=' + vehicleId);

      });
  });

    $(document).ready(function(){
        $('#confirmButton').click(function(){
            var vehicleId = $(this).attr('data-id'); 
            updateStatus(vehicleId, 1); 
        });

        $('#cancelButton').click(function(){
            var vehicleId = $(this).attr('data-id'); 
            updateStatus(vehicleId, 2); 
        });

        function updateStatus(vehicleId, status) {
            $.ajax({
                url: 'pending-vehicles.php',
                type: 'POST',
                data: { id: vehicleId, status: status },
                success: function(response) {
                    console.log('Status updated successfully');
                    window.location.reload();
                    
                },
                error: function(xhr, status, error) {
                    console.error('Error updating status:', error);
                }
            });
        }
    });
</script>

</body>
</html>
<?php } ?>
