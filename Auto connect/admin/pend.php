<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/configtwo.php');
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
	
	<title>Car Rental Portal |Admin Manage Vehicles   </title>
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
											<th>Price Per day</th>
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
											<th>Price Per day</th>
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
        tblvehicles.PricePerDay, tblvehicles.FuelType,
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
                Are you sure you want to change the status of this vehicle?
                <div id="reasonSection" style="display: none;">
                    <label for="reason">Reason for cancellation:</label>
                    <textarea class="form-control" id="reason" name="reason" rows="3"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <!-- Update the Confirm button with data attributes -->
                <button type="button" id="confirmButton" class="btn btn-primary" data-dismiss="modal" data-id="<?php echo $row['id']; ?>">Confirm</button>
                
                <!-- Update the Cancel button with data attributes -->
                <button type="button" id="cancelButton" class="btn btn-secondary" data-dismiss="modal" data-id="<?php echo $row['id']; ?>">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!-- Other HTML content -->
<!doctype html>
<html lang="en" class="no-js">
<head>
    <!-- Head content goes here -->
</head>
<body>
    <!-- Body content goes here -->
</body>
</html>


            <tr>
                <td><?php echo htmlentities($cnt);?></td>
                <td><?php echo htmlentities($row['VehiclesTitle']);?></td>
                <td><?php echo htmlentities($row['BrandName']);?></td>
                <td><?php echo htmlentities($row['PricePerDay']);?></td>
                <td><?php echo htmlentities($row['FuelType']);?></td>
                <td><?php echo htmlentities($row['ModelYear']);?></td>
                <td><?php echo htmlentities($row['FullName']);?></td>
                <td><?php echo "pending";?></td>
                <td>
                    <a href="view-vehicle.php?id=<?php echo $row['id'];?>"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
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
          $('#confirmButton').attr('href', 'pend.php?pending=' + vehicleId);
      });
  });
</script>

<script>
 $(document).ready(function(){
        $('.change-status').click(function(){
            var vehicleId = $(this).data('id');
            $('#confirmButton').attr('data-id', vehicleId); // Set vehicle ID for confirm button
            $('#cancelButton').attr('data-id', vehicleId); // Set vehicle ID for cancel button
        });
        
        $('#confirmButton').click(function(){
            var vehicleId = $(this).attr('data-id');
            var status = 1; // Set status to approved
            updateStatus(vehicleId, status, ''); // No reason needed for approval
        });

        $('#cancelButton').click(function(){
            var vehicleId = $(this).attr('data-id');
            var status = 2; // Set status to canceled
            $('#reasonSection').show(); // Show reason input field
            $('#confirmButton').prop('disabled', true); // Disable confirm button until reason is provided
        });

        // Listen for changes in the reason textarea
        $('#reason').on('input', function() {
            var reason = $(this).val();
            if (reason.trim() !== '') {
                $('#confirmButton').prop('disabled', false); // Enable confirm button if reason is provided
            } else {
                $('#confirmButton').prop('disabled', true); // Disable confirm button if reason is empty
            }
        });

        function updateStatus(vehicleId, status, reason) {
            $.ajax({
                url: 'pend.php',
                type: 'POST',
                data: { id: vehicleId, status: status, reason: reason }, // Pass reason to PHP script
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