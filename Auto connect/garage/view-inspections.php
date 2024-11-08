<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
file_put_contents('debug.log', print_r($_POST, true));
include('includes/configtwo.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:../index.php');
}
else{ 

    $error="";
$msg="";
if(isset($_POST['submits'])) {
    var_dump($_POST);
    $vehicleOverview = "";
    if(isset($_FILES['vehicle_orc_view_pdf']) && !empty($_FILES['vehicle_orc_view_pdf']['tmp_name'])) {
        $file_name = $_FILES['vehicle_orc_view_pdf']['name'];
        $file_tmp = $_FILES['vehicle_orc_view_pdf']['tmp_name'];
        move_uploaded_file($file_tmp, "./image/" . $file_name);
        $vehicleOverview = "'" . $file_name . "'"; // Wrap file name in single quotes for SQL
    } 
    // Check if the vehicle overview is text
    elseif(isset($_POST['vehicle_orc_view']) && !empty($_POST['vehicle_orc_view'])) {

        $vehicleOverview = "'" . $_POST['vehicle_orc_view'] . "'"; 
    }
   // Sample code for handling checkboxes
$airconditioner = isset($_POST['airconditioner']) ? $_POST['airconditioner'] : 0;
$powerdoorlocks = isset($_POST['powerdoorlocks']) ? $_POST['powerdoorlocks'] : 0;
$antilockbrakingsys = isset($_POST['antilockbrakingsys']) ? $_POST['antilockbrakingsys'] : 0;
$brakeassist = isset($_POST['brakeassist']) ? $_POST['brakeassist'] : 0;
$powersteering = isset($_POST['powersteering']) ? $_POST['powersteering'] : 0;
$driverairbag = isset($_POST['driverairbag']) ? $_POST['driverairbag'] : 0;
$passengerairbag = isset($_POST['passengerairbag']) ? $_POST['passengerairbag'] : 0;
$powerwindow = isset($_POST['powerwindow']) ? $_POST['powerwindow'] : 0;
$cdplayer = isset($_POST['cdplayer']) ? $_POST['cdplayer'] : 0;
$centrallocking = isset($_POST['centrallocking']) ? $_POST['centrallocking'] : 0;
$crashcensor = isset($_POST['crashcensor']) ? $_POST['crashcensor'] : 0;
$leatherseats = isset($_POST['leatherseats']) ? $_POST['leatherseats'] : 0;
$platenumber=$_POST['platenumber'];




$garage=$_SESSION['alogin'];

$getId="SELECT garage_id FROM garageowner WHERE email = '$garage'";
$getanswer=$dbhh->query($getId);
$getrow=$getanswer->fetch_assoc();
$garage_id=$getrow['garage_id'];
$mileage=$_POST['mileage'];
$odometer=$_POST['odometer'];
$exhustion=$_POST['exhaust_system'];
$engine_condition=$_POST['engine_condition'];
$transmition=$_POST['transmission_performance'];
$indicator=$_POST['light'];
$tireCondition=$_POST['tire_condition'];
$body=$_POST['bodywork'];
// Now you can use these variables in your SQL query
var_dump($platenumber);

//FIST GET THE LOGGED IN GARAGE ID AND THE PLATE NUMBER ASWELL AS THE USERS ID 
$userid=$_POST['userid'];
$sq2="SELECT * FROM tblvehicles WHERE plate_number = '$platenumber' OR plate_number REGEXP '^[0-9]+$'";
$result2 = $dbhh->query($sq2);
if($result2->num_rows > 0) {
$row2=$result2->fetch_assoc();
$owner=$row2['userid'];
$vehicle_id=$row2['id'];



if($owner!=$userid){
    $requester_type = 'buyer';

    $sql1 = "INSERT INTO vehicle_inspections (
        vehicle_id,vehicleOverview, odometer, milage, transmition, exhustion,
        indicator, tireCondition, enginCondition, body, AirConditioner, PowerDoorLocks,
        AntiLockBrakingSystem, BrakeAssist, PowerSteering, DriverAirbag, PassengerAirbag,
        PowerWindows, CDPlayer, CentralLocking, CrashSensor, LeatherSeats, garage_id, requester_type,userid, inspection_date
    ) VALUES (
        (SELECT id FROM tblvehicles WHERE plate_number = '$platenumber'),$vehicleOverview,
        '$odometer', '$mileage', '$transmition', '$exhustion', '$indicator',
        '$tireCondition', '$engine_condition', '$body', '$airconditioner', '$powerdoorlocks',
        '$antilockbrakingsys', '$brakeassist', '$powersteering', '$driverairbag', '$passengerairbag',
        '$powerwindow', '$cdplayer', '$centrallocking', '$crashcensor', '$leatherseats',
        '$garage_id', '$requester_type','$userid', CURDATE()
    )";  
}else{
    $requester_type = 'seller';
    $sql1 = "INSERT INTO vehicle_inspections (
        vehicle_id,vehicleOverview, odometer, milage, transmition, exhustion,
        indicator, tireCondition, enginCondition, body, AirConditioner, PowerDoorLocks,
        AntiLockBrakingSystem, BrakeAssist, PowerSteering, DriverAirbag, PassengerAirbag,
        PowerWindows, CDPlayer, CentralLocking, CrashSensor, LeatherSeats, garage_id, requester_type,userid, inspection_date
    ) VALUES (
        (SELECT id FROM tblvehicles WHERE plate_number = '$platenumber'),$vehicleOverview,
        '$odometer', '$mileage', '$transmition', '$exhustion', '$indicator',
        '$tireCondition', '$engine_condition', '$body', '$airconditioner', '$powerdoorlocks',
        '$antilockbrakingsys', '$brakeassist', '$powersteering', '$driverairbag', '$passengerairbag',
        '$powerwindow', '$cdplayer', '$centrallocking', '$crashcensor', '$leatherseats',
        '$garage_id', '$requester_type','$userid', CURDATE()
    )";
}
$answer=$dbhh->query($sql1);
$letes_inserted_id = $dbhh->insert_id;
if($answer){

// update the schedule to addressed 
    $query2="UPDATE schedule SET status = 1 WHERE vid = '$platenumber'";
    $answerupdate=$dbhh->query($query2);
    if($answerupdate){  
//set the the inspection and the status 1 in the tblvehciles if they are not already
$query_status="UPDATE tblvehicles SET inspection = 1, status = 1, Post_status=0 WHERE plate_number = '$platenumber'";
$status_result=$dbhh->query($query_status);
    }
    $sq3 = "SELECT * FROM vehicle_inspections 
    WHERE vehicle_id = (SELECT id FROM tblvehicles WHERE plate_number = '$platenumber')
    AND garage_id != '$garage_id'
    ORDER BY inspection_id DESC LIMIT 1";
    $result3 = $dbhh->query($sq3);
    if($result3->num_rows > 0) {
        $row3 = $result3->fetch_assoc();
        
            $airconditioner_diff = ($row3['AirConditioner'] == $airconditioner) ? 1 : 0;
            $powerdoorlocks_diff = ($row3['PowerDoorLocks'] == $powerdoorlocks) ? 1 : 0;
            $antilockbrakingsys_diff = ($row3['AntiLockBrakingSystem'] == $antilockbrakingsys) ? 1 : 0;
            $brakeassist_diff = ($row3['BrakeAssist'] == $brakeassist) ? 1 : 0;
            $powersteering_diff = ($row3['PowerSteering'] == $powersteering) ? 1 : 0;
            $driverairbag_diff = ($row3['DriverAirbag'] == $driverairbag) ? 1 : 0;
            $passengerairbag_diff = ($row3['PassengerAirbag'] == $passengerairbag) ? 1 : 0;
            $powerwindow_diff = ($row3['PowerWindows'] == $powerwindow) ? 1 : 0;
            $cdplayer_diff = ($row3['CDPlayer'] == $cdplayer) ? 1 : 0;
            $centrallocking_diff = ($row3['CentralLocking'] == $centrallocking) ? 1 : 0;
            $crashcensor_diff = ($row3['CrashSensor'] == $crashcensor) ? 1 : 0;
            $leatherseats_diff = ($row3['LeatherSeats'] == $leatherseats) ? 1 : 0;
            $last_inspectionid = $row3['inspection_id'];
    
    
    
    // lets store them in the flag table 
    $sq4 = "INSERT INTO vehicle_inspections_flag (
            vehicle_id, AirConditioner, PowerDoorLocks, AntiLockBrakingSystem, BrakeAssist, PowerSteering,
            DriverAirbag, PassengerAirbag, PowerWindows, CDPlayer, CentralLocking, CrashSensor, LeatherSeats,sellerinspection_id, buyerinspection_id
        ) VALUES (
            '$vehicle_id', '$airconditioner_diff', '$powerdoorlocks_diff', '$antilockbrakingsys_diff', '$brakeassist_diff',' $powersteering_diff',
            '$driverairbag_diff', '$passengerairbag_diff', '$powerwindow_diff', '$cdplayer_diff', '$centrallocking_diff', '$crashcensor_diff', '$leatherseats_diff','$last_inspectionid','$letes_inserted_id'
        )";
      $result4=$dbhh->query($sq4); 
      if($result4){  
    $query2="UPDATE schedule SET status = 1 WHERE vid = '$platenumber'";

    $answer=$dbhh->query($query2);

    if($answer){  
    $msg = "Inspection result submitted successfully";
    }else{
        $error = "Something went wrong. Please try again: " . mysqli_error($dbhh);
    } 
}
}
}else{
    $error = "Something went wrong. Please try again: " . mysqli_error($dbhh);
}


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
	
	<title>Auto car rental and sales | Garage inspect Vehicle</title>

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
.profile-pic {
            display: flex;
            justify-content: center; /* Center horizontally */
            align-items: center; /* Center vertically */
            margin-bottom: 20px; /* Add some space below the image */
        }

        /* Profile picture style */
        .profile-pic img {
            border: 5px solid #fff;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
            border-radius: 50%; /* Makes the image circular */
            max-width: 100%;
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
					
						<h2 class="page-title">Inspect  Vehicle</h2>

						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Owner and Vehicle information</div>
               <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error);
			   ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
<?php
           $platenumber=$_GET['vp'];
           $userid=$_GET['id'];

           echo $platenumber;
           echo $userid;

             $sql ="SELECT tblvehicles.*,tblbrands.BrandName,tblbrands.id as bid,tblusers.FullName,tblusers.EmailId,tblusers.photo from 
             tblvehicles join tblbrands on tblbrands.id=tblvehicles.VehiclesBrand join tblusers on 
             tblusers.id=tblvehicles.userid where tblvehicles.plate_number='$platenumber'";
             $result=$dbhh->query($sql);

             if($result->num_rows> 0)
             {
             while($row=$result->fetch_assoc())
             {	?>
             

									<div class="panel-body">
                                        
                                           <form method="post"  class="form-horizontal" enctype="multipart/form-data">
                                           <div class="col-md-12">
                                                                                             <!-- Profile picture -->
                                                    <div class="profile-pic">
                                                        <img src="../<?php echo htmlentities($row['photo']); ?>" alt="Profile Picture" class="img-circle" width="150">
                                                    </div>
                                   </div>
<div class="form-group">
 <label class="col-sm-2 control-label">Name<span style="color:red">*</span></label>
  <div class="col-sm-3">
  <input type="text" name="Ownername" class="form-control" value="<?php echo htmlentities($row['FullName']); ?>" readonly>
</div>
<label class="col-sm-2 control-label">Email<span style="color:red">*</span></label>
<div class="col-sm-3">
<input type="text" name="Owneremail" class="form-control" value="<?php echo htmlentities($row['EmailId']); ?>" readonly>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">vehicle Model Year<span style="color:red">*</span></label>
<div class="col-sm-3">
<input type="text" name="modelyear" class="form-control" value="<?php echo htmlentities($row['ModelYear']); ?>" readonly>
</div>
<label class="col-sm-2 control-label">Seating Capacity<span style="color:red">*</span></label>
<div class="col-sm-3">
<input type="text" name="seatingcapacity" class="form-control" value="<?php echo htmlentities($row['SeatingCapacity']); ?>" readonly>
</div>
</div>

<div class="hr-dashed"></div>
<div class="form-group">
<div class="col-sm-12">
<h4><b>The vehicle Images</b></h4>
</div>
</div>

<div class="form-group">
<div class="col-sm-4">
Image 1 <img src="../admin/img/vehicleimages/<?php echo htmlentities($row['Vimage1']);?>" width="300" height="200" style="border:solid 1px #000">
</div>
<div class="col-sm-4">
Image 2<img src="../admin/img/vehicleimages/<?php echo htmlentities($row['Vimage2']);?>" width="300" height="200" style="border:solid 1px #000">
</div>
<div class="col-sm-4">
Image 3<img src="../admin/img/vehicleimages/<?php echo htmlentities($row['Vimage3']);?>" width="300" height="200" style="border:solid 1px #000">
</div>
</div>

<!-- added for comparesion to other garages -->
<div class="form-group" class="text-center">
<div class="col-sm-12">
<h4><b>Interior</b></h4>
</div>
</div>

<div class="form-group">
<div class="form-group">
<label class="col-sm-2 control-label">odometer<span style="color:red">*</span></label>
<div class="col-sm-3">
<input type="text" name="odometer" class="form-control" required>
</div>
<label class="col-sm-2 control-label">Mileage<span style="color:red">*</span></label>
<div class="col-sm-3">
<input type="text" name="mileage" class="form-control" required>
<input type="hidden" name="platenumber" value="<?php echo $platenumber ?>" required>
<input type="hidden" name="userid" value="<?php echo $userid ?>" required>
</div>
</div>
    <label class="col-sm-2 control-label">Transmission performance<span style="color:red">*</span></label>
    <div class="col-sm-3">
    <select class="selectpicker" id="transmission_performance" name="transmission_performance" required>
        <option value="">Select</option>
        <option value="5">Excellent</option>
        <option value="4">Good</option>
        <option value="3">Fair</option>
        <option value="2">Poor</option>
        <option value="1">Very Poor</option>
    </select>
    </div>
    <label class="col-sm-2 control-label">Exhaust System Condition<span style="color:red">*</span></label>
    <div class="col-sm-3">
    <select class="selectpicker" id="exhaust_system" name="exhaust_system" required>
        <option value="">Select</option>
        <option value="5">No Issues</option>
        <option value="4">Minor Rust</option>
        <option value="3">Moderate Rust</option>
        <option value="2">Severe Rust</option>
        <option value="1"> out of service</option>
    </select>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">Lights and Indicators<span style="color:red">*</span></label>
    <div class="col-sm-3">
    <select class="selectpicker" id="light" name="light" required>
        <option value="">Select</option>
        <option value="5">Excellent</option>
        <option value="4">Good</option>
        <option value="3">Fair</option>
        <option value="2">Poor</option>
        <option value="1">Very Poor</option>
    </select>
    </div>
    <label class="col-sm-2 control-label">Tire Condition and Tread Depth<span style="color:red">*</span></label>
    <div class="col-sm-3">
    <select class="selectpicker" id="tire_condition" name="tire_condition" required>
        <option value="">Select</option>
        <option value="5">Excellent</option>
        <option value="4">Good</option>
        <option value="3">Fair</option>
        <option value="2">Poor</option>
        <option value="1">Very Poor</option>
    </select>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">Bodywork (Dents, Scratches)<span style="color:red">*</span></label>
    <div class="col-sm-3">
    <select class="selectpicker" id="bodywork" name="bodywork" required>
        <option value="">Select</option>
        <option value="5">No Issues</option>
        <option value="4">Minor Dents/Scratches</option>
        <option value="3">Moderate Dents/Scratches</option>
        <option value="2">Severe Dents/Scratches</option>
        <option value="1">need a change</option>
    </select>
    </div>
    <label class="col-sm-2 control-label">Engine Condition<span style="color:red">*</span></label>
    <div class="col-sm-3">
    <select class="selectpicker" id="engine_condition" name="engine_condition" required>
        <option value="">Select</option>
        <option value="5">Excellent</option>
        <option value="4">Good</option>
        <option value="3">Fair</option>
        <option value="2">Poor</option>
        <option value="1">Very Poor</option>
    </select>
    </div>
</div>
<!-- /end of the things added  -->


<div class="hr-dashed"></div>
<div class="form-group">
    <label class="col-sm-2 control-label">Vehicle Overview <span style="color:red">*</span></label>
    <div class="col-sm-10">
        <textarea class="form-control" id="vehicleTextarea" name="vehicle_orc_view" rows="3"  required></textarea>
        <p>or</p>
        <div id="dropZone" style="border: 2px dashed #ccc; padding: 20px; cursor: pointer;">
            Drag & Drop PDF or Image Here
        </div>
        <input type="file" id="fileInput" name="vehicle_orc_view_pdf" accept=".pdf, image/*" style="display: none;">
    </div>
</div>									
</div>
</div>
</div>
</div>
							<!-- the section where the garage will fill information -->
                            <div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">Accessories</div>
            <div class="panel-body">
                <form method="post" class="form-horizontal" enctype="multipart/form-data">
                    
                    <!-- Air Conditioner -->
                    <div class="form-group">
                        <div class="col-sm-3">
                            <div class="checkbox checkbox-inline">
                                <input type="checkbox" id="inlineCheckbox1" name="airconditioner" value="1">
                                <label for="inlineCheckbox1"> Air Conditioner </label>
                            </div>
                        </div>
                        <!-- next chekbox -->
                        <div class="col-sm-3">
                            <div class="checkbox checkbox-inline">
                                <input type="checkbox" id="inlineCheckbox1" name="powerdoorlocks" value="1">
                                <label for="inlineCheckbox1"> Power Door Locks  </label>
                            </div>
                        </div>
                        <!-- next chekbox -->
                        <div class="col-sm-3">
                            <div class="checkbox checkbox-inline">
                                <input type="checkbox" id="inlineCheckbox1" name="antilockbrakingsys" value="1">
                                <label for="inlineCheckbox1"> AntiLock Braking System </label>
                            </div>
                        </div>
                        <!-- next chekbox -->
                        <div class="col-sm-3">
                            <div class="checkbox checkbox-inline">
                                <input type="checkbox" id="inlineCheckbox1" name="brakeassist" value="1">
                                <label for="inlineCheckbox1"> Brake Assist</label>
                            </div>
                        </div>
                        <!-- next chekbox -->
                        <!-- Repeat the same structure for other checkboxes -->
                    
                    </div>

                    <!-- Power Door Locks -->
                    <div class="form-group">
                        <div class="col-sm-3">
                            <div class="checkbox checkbox-inline">
                                <input type="checkbox" id="inlineCheckbox2" name="powersteering" value="1">
                                <label for="inlineCheckbox2"> Power Steering </label>
                            </div>
                        </div>
                         <!-- next chekbox -->
                         <div class="form-group">
                        <div class="col-sm-3">
                            <div class="checkbox checkbox-inline">
                                <input type="checkbox" id="inlineCheckbox2" name="driverairbag" value="1">
                                <label for="inlineCheckbox2"> Driver Airbag</label>
                            </div>
                        </div>
                         <!-- next chekbox -->
                         <div class="form-group">
                        <div class="col-sm-3">
                            <div class="checkbox checkbox-inline">
                                <input type="checkbox" id="inlineCheckbox2" name="passengerairbag" value="1">
                                <label for="inlineCheckbox2"> Passenger Airbag </label>
                            </div>
                        </div>
                         <!-- next chekbox -->
                         <div class="form-group">
                        <div class="col-sm-3">
                            <div class="checkbox checkbox-inline">
                                <input type="checkbox" id="inlineCheckbox2" name="powerwindows" value="1">
                                <label for="inlineCheckbox2"> Power Windows </label>
                            </div>
                        </div>
                         <!-- next chekbox -->
                        
                        <!-- Repeat the same structure for other checkboxes -->
                    
                    </div>
                         <!-- next chekbox -->
                         <div class="form-group">
                        <div class="col-sm-3">
                            <div class="checkbox checkbox-inline">
                                <input type="checkbox" id="inlineCheckbox2" name="cdplayer" value="1">
                                <label for="inlineCheckbox2"> CD Player </label>
                            </div>
                        </div>
                         <!-- next chekbox -->
                         <div class="col-sm-3">
                            <div class="checkbox checkbox-inline">
                                <input type="checkbox" id="inlineCheckbox2" name="centrallocking" value="1">
                                <label for="inlineCheckbox2"> Central Locking </label>
                            </div>
                        </div>
                         <!-- next chekbox -->
                         <div class="col-sm-3">
                            <div class="checkbox checkbox-inline">
                                <input type="checkbox" id="inlineCheckbox2" name="crashcensor" value="1">
                                <label for="inlineCheckbox2"> Crash Sensor </label>
                            </div>
                        </div>
                         <!-- next chekbox -->
                         <div class="col-sm-3">
                            <div class="checkbox checkbox-inline">
                                <input type="checkbox" id="inlineCheckbox2" name="leatherseats" value="1">
                                <label for="inlineCheckbox2"> Leather Seats </label>
                            </div>
                        </div>
                         <!-- next chekbox -->
                        
                        <!-- Repeat the same structure for other checkboxes -->
                    
                    </div>
                    <!-- Repeat the same structure for other accessories -->

                    <div class="form-group">
                        <div class="col-sm-8 col-sm-offset-4">
                            <button class="btn btn-primary" name="submits" type="submits" style="margin-top:4%">Save changes</button>
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
    // Get references to HTML elements
    const dropZone = document.getElementById('dropZone');
    const fileInput = document.getElementById('fileInput');
    const vehicleTextarea = document.getElementById('vehicleTextarea');

    // Prevent default behavior when files are dragged over the drop zone
    dropZone.addEventListener('dragover', (event) => {
        event.preventDefault();
        dropZone.style.backgroundColor = '#f0f0f0'; // Change background color to indicate drop is possible
    });

    // Reset drop zone's background color when files are not over it
    dropZone.addEventListener('dragleave', () => {
        dropZone.style.backgroundColor = '';
    });

    // Handle file drop event
    dropZone.addEventListener('drop', (event) => {
        event.preventDefault();
        const files = event.dataTransfer.files; // Get the dropped files

        // Update the file input field with the dropped files
        fileInput.files = files;

        // Update drop zone text
        if (files.length > 0) {
            dropZone.innerHTML = 'Files Selected: ' + files[0].name;
            vehicleTextarea.disabled = true; // Disable textarea if file is dropped
        } else {
            dropZone.innerHTML = 'Drag & Drop PDF or Image Here';
            vehicleTextarea.disabled = false; // Enable textarea if no file is dropped
        }

        dropZone.style.backgroundColor = ''; // Reset background color
    });

    // Trigger file input click when the drop zone is clicked
    dropZone.addEventListener('click', () => {
        fileInput.click();
    });

    // Update drop zone text when files are selected using the file input
    fileInput.addEventListener('change', () => {
        if (fileInput.files.length > 0) {
            dropZone.innerHTML = 'Files Selected: ' + fileInput.files[0].name;
            vehicleTextarea.disabled = true; // Disable textarea if file is selected
        } else {
            dropZone.innerHTML = 'Drag & Drop PDF or Image Here';
            vehicleTextarea.disabled = false; // Enable textarea if no file is selected
        }
    });

    // Update drop zone text when text is entered in the textarea
    vehicleTextarea.addEventListener('input', () => {
        if (vehicleTextarea.value.trim() !== '') {
            dropZone.innerHTML = 'Files Selected: Text Entered';
            fileInput.disabled = true; // Disable file input if text is entered
        } else {
            dropZone.innerHTML = 'Drag & Drop PDF or Image Here';
            fileInput.disabled = false; // Enable file input if no text is entered
        }
    });
</script>
   
</body>
</html>
<?php }
}
}
?>