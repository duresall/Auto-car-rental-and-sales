<?php
session_start();
error_reporting(E_ALL);
include('includes/config.php');
include('includes/configtwo.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:../index.php');
}
else{ 

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
	
	<title>Auto car rental and sales | Admin Vehicle Info</title>

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
					
						<h2 class="page-title">Vehicle Inspection Results</h2>
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">previous inspector garage</div>
									<div class="panel-body">
               




                                    <!-- use a get method to get the id of the transfere id   -->
                                    <?php
                                    $inspection_id=$_GET['id'];

                                    $query="SELECT sellerinspection_id FROM vehicle_inspections_flag WHERE flag_id=$inspection_id";
                                    $result=$dbhh->query($query);
                                    $row=$result->fetch_assoc();
                                    $sellerinspection_id=$row['sellerinspection_id'];



                                    $query3="SELECT vi.*, g.* FROM vehicle_inspections vi
											INNER JOIN garageowner g ON vi.garage_id = g.garage_id
											WHERE vi.inspection_id = $row[sellerinspection_id]";
											$result3=$dbhh->query($query3);
                                            if($result3){
                                                while($row1 = $result3->fetch_assoc()){
                                       ?>
              									<!-- THIS ARE INFORMATION ABOUT THE SELLER -->
                                                  <div class="profile-info">
                                          <div class="row">
                                            <div class="col-md-4">
                                                    <div class="profile-pic">
                                                        
                                                        <?php
                                                        if($row1['Image']==''){
                                                            ?>
                                                            <img src="../profile.png" alt="Profile Picture" class="img-circle" width="150">
                                                       <?php }else{
                                                            ?>
                                                            <img src="../garage/image/<?php echo htmlentities($row1['Image']); ?>" alt="Profile Picture" class="img-circle" width="150">
                                                            <?php
                                                       }

                                                        ?>
                                                        
                                                    </div>
                                            </div>
                                             <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="fullName">Full Name </label>
                                                    <input type="text" class="form-control" id="fullName" value="<?php echo htmlentities($row1['name']); ?>" readonly>
                                                </div>   
                                                <div class="form-group">
                                                    <label for="Location">Phone number </label>
                                                    <input type="text" class="form-control" id="Location" value="<?php echo htmlentities($row1['phone']); ?>" readonly>
                                                </div>  
                                               
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="Email">Email </label>
                                                    <input type="text" class="form-control" id="Email" value="<?php echo htmlentities($row1['email']); ?>" readonly>
                                                </div>   
                                            </div>
                                            
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="Email">Registered Since </label>
                                                    <input type="text" class="form-control" id="Rating" value="<?php echo htmlentities($row1['inspection_date']); ?>" readonly>
                                                </div>   
                                            </div>

                                          <hr>

                                        </div>

                                        
                                    </div>
                                                <!-- END OF THE INFORMATON -->
                                    </div>
                               </div>
                            </div>
                        </div>
      <div class="panel panel-default">
      <div class="panel-heading">latest inspectior garage</div>
      <div class="panel-body">
           
                        <!-- THIS ARE INFORMATION ABOUT THE SELLER -->
                        <?php
                             $inspection_id=$_GET['id'];

                             $query5="SELECT buyerinspection_id FROM vehicle_inspections_flag WHERE flag_id=$inspection_id";
                             $result5=$dbhh->query($query5);
                             $row5=$result5->fetch_assoc();
                             $buyerinspection_id=$row5['buyerinspection_id'];



                             $query6="SELECT vi.*, g.* FROM vehicle_inspections vi
                                     INNER JOIN garageowner g ON vi.garage_id = g.garage_id
                                     WHERE vi.inspection_id = $row5[buyerinspection_id]";
                                     $result6=$dbhh->query($query6);
                                     if($result6){
                                         while($row6 = $result6->fetch_assoc()){
                                      
                                       ?>
              									<!-- THIS ARE INFORMATION ABOUT THE SELLER -->
                                                  <div class="profile-info">
                                          <div class="row">
                                            <div class="col-md-4">
                                                    <div class="profile-pic">
                                                        
                                                        <?php
                                                        if($row1['Image']==''){
                                                            ?>
                                                            <img src="../profile.png" alt="Profile Picture" class="img-circle" width="150">
                                                       <?php }else{
                                                            ?>
                                                            <img src="../garage/image/<?php echo htmlentities($row6['Image']); ?>" alt="Profile Picture" class="img-circle" width="150">
                                                            <?php
                                                       }

                                                        ?>
                                                        
                                                    </div>
                                            </div>
                                             <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="fullName">Full Name </label>
                                                    <input type="text" class="form-control" id="fullName" value="<?php echo htmlentities($row6['name']); ?>" readonly>
                                                </div>   
                                                <div class="form-group">
                                                    <label for="Location">Phone number </label>
                                                    <input type="text" class="form-control" id="Location" value="<?php echo htmlentities($row6['phone']); ?>" readonly>
                                                </div>  
                                               
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="Email">Email </label>
                                                    <input type="text" class="form-control" id="Email" value="<?php echo htmlentities($row6['email']); ?>" readonly>
                                                </div>   
                                            </div>
                                            
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="Email">Registered Since </label>
                                                    <input type="text" class="form-control" id="Rating" value="<?php echo htmlentities($row6['inspection_date']); ?>" readonly>
                                                </div>   
                                            </div>

                                          <hr>
                                        </div>

                                        
                                    </div>
                                    <?php

                                                    }
                                                }
                                                    ?>
                                                <!-- END OF THE INFORMATON -->
			</div>
		</div> 

<div class="panel panel-default">
    <div class="panel-heading">Inspection Results</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th colspan="2" class="text-center">Previous Inspection</th>
                            </tr>
                            <tr>
                                <th>Inspection</th>
                                <th>Result</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php

$inspection_id=$_GET['id'];
  $sql2="SELECT sellerinspection_id,buyerinspection_id FROM vehicle_inspections_flag WHERE flag_id='$inspection_id'";
  $answer = $dbhh->query($sql2);
  $rows=$answer->fetch_assoc();
  $sellerinspection_id_inspection=$rows['sellerinspection_id'];
  $buyerinspection_id_inspection=$rows['buyerinspection_id'];
  $sql3="SELECT * FROM vehicle_inspections WHERE inspection_id='$sellerinspection_id_inspection'";
  $answer3=$dbhh->query($sql3);
  $rows3=$answer3->fetch_assoc();
?>
                            <tr>
                                <td>AirConditioner</td>
                                <?php if($rows3['AirConditioner'] == 1){ ?>
                                <td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>
                                <?php } else { ?>
                                <td><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></td>
                                <?php } ?>
                            </tr>
                            <tr>
                                <td>PowerDoorLocks</td>
                                <?php if($rows3['PowerDoorLocks'] == 1){ ?>
                                <td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>
                                <?php } else { ?>
                                <td><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></td>
                                <?php } ?>
                            </tr>
                            <tr>
                                <td>AntiLockBrakingSystem</td>
                                <?php if($rows3['AntiLockBrakingSystem'] == 1){ ?>
                                <td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>
                                <?php } else { ?>
                                <td><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></td>
                                <?php } ?>
                            </tr>
                            <tr>
                                <td>BrakeAssist</td>
                                <?php if($rows3['BrakeAssist'] == 1){ ?>
                                <td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>
                                <?php } else { ?>
                                <td><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></td>
                                <?php } ?>
                            </tr>
                            <tr>
                                <td>PowerSteering</td>
                                <?php if($rows3['PowerSteering'] == 1){ ?>
                                <td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>
                                <?php } else { ?>
                                <td><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></td>
                                <?php } ?>
                            </tr>
                            <tr>
                                <td>DriverAirbag</td>
                                <?php if($rows3['DriverAirbag'] == 1){ ?>
                                <td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>
                                <?php } else { ?>
                                <td><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></td>
                                <?php } ?>
                            </tr>
                            <tr>
                                <td>PassengerAirbag</td>
                                <?php if($rows3['PassengerAirbag'] == 1){ ?>
                                <td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>
                                <?php } else { ?>
                                <td><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></td>
                                <?php } ?>
                            </tr>
                            <tr>
                                <td>PowerWindows</td>
                                <?php if($rows3['PowerWindows'] == 1){ ?>
                                <td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>
                                <?php } else { ?>
                                <td><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></td>
                                <?php } ?>
                            </tr>
                            <tr>
                                <td>CDPlayer</td>
                                <?php if($rows3['CDPlayer'] == 1){ ?>
                                <td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>
                                <?php } else { ?>
                                <td><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></td>
                                <?php } ?>
                            </tr>
                            <tr>
                                <td>CentralLocking</td>
                                <?php if($rows3['CentralLocking'] == 1){ ?>
                                <td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>
                                <?php } else { ?>
                                <td><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></td>
                                <?php } ?>
                            </tr>
                            <tr>
                                <td>CrashSensor</td>
                                <?php if($rows3['CrashSensor'] == 1){ ?>
                                <td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>
                                <?php } else { ?>
                                <td><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></td>
                                <?php } ?>
                            </tr>
                            <tr>
                                <td>LeatherSeats</td>
                                <?php if($rows3['LeatherSeats'] == 1){ ?>
                                <td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>
                                <?php } else { ?>
                                <td><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></td>
                                <?php } ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-6">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th colspan="2" class="text-center">Latest Inspection</th>
                            </tr>
                            <tr>
                                <th>Inspection</th>
                                <th>Result</th>
                            </tr>
                        </thead>
                        <tbody>

<?php
                               $sql2="SELECT * FROM vehicle_inspections WHERE inspection_id='$buyerinspection_id_inspection'";
                               $answer2=$dbhh->query($sql2);
                               $rows2=$answer2->fetch_assoc();


?>
                        <tr>
                                <td>AirConditioner</td>
                                <?php if($rows2['AirConditioner'] == 1){ ?>
                                <td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>
                                <?php } else { ?>
                                <td><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></td>
                                <?php } ?>
                            </tr>
                            <tr>
                                <td>PowerDoorLocks</td>
                                <?php if($rows2['PowerDoorLocks'] == 1){ ?>
                                <td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>
                                <?php } else { ?>
                                <td><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></td>
                                <?php } ?>
                            </tr>
                            <tr>
                                <td>AntiLockBrakingSystem</td>
                                <?php if($rows2['AntiLockBrakingSystem'] == 1){ ?>
                                <td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>
                                <?php } else { ?>
                                <td><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></td>
                                <?php } ?>
                            </tr>
                            <tr>
                                <td>BrakeAssist</td>
                                <?php if($rows2['BrakeAssist'] == 1){ ?>
                                <td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>
                                <?php } else { ?>
                                <td><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></td>
                                <?php } ?>
                            </tr>
                            <tr>
                                <td>PowerSteering</td>
                                <?php if($rows2['PowerSteering'] == 1){ ?>
                                <td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>
                                <?php } else { ?>
                                <td><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></td>
                                <?php } ?>
                            </tr>
                            <tr>
                                <td>DriverAirbag</td>
                                <?php if($rows2['DriverAirbag'] == 1){ ?>
                                <td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>
                                <?php } else { ?>
                                <td><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></td>
                                <?php } ?>
                            </tr>
                            <tr>
                                <td>PassengerAirbag</td>
                                <?php if($rows2['PassengerAirbag'] == 1){ ?>
                                <td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>
                                <?php } else { ?>
                                <td><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></td>
                                <?php } ?>
                            </tr>
                            <tr>
                                <td>PowerWindows</td>
                                <?php if($rows2['PowerWindows'] == 1){ ?>
                                <td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>
                                <?php } else { ?>
                                <td><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></td>
                                <?php } ?>
                            </tr>
                            <tr>
                                <td>CDPlayer</td>
                                <?php if($rows2['CDPlayer'] == 1){ ?>
                                <td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>
                                <?php } else { ?>
                                <td><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></td>
                                <?php } ?>
                            </tr>
                            <tr>
                                <td>CentralLocking</td>
                                <?php if($rows2['CentralLocking'] == 1){ ?>
                                <td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>
                                <?php } else { ?>
                                <td><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></td>
                                <?php } ?>
                            </tr>
                            <tr>
                                <td>CrashSensor</td>
                                <?php if($rows2['CrashSensor'] == 1){ ?>
                                <td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>
                                <?php } else { ?>
                                <td><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></td>
                                <?php } ?>
                            </tr>
                            <tr>
                                <td>LeatherSeats</td>
                                <?php if($rows2['LeatherSeats'] == 1){ ?>
                                <td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>
                                <?php } else { ?>
                                <td><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></td>
                                <?php } ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="clearfix"></div>
    </div>
</div>
</div>

<?php
                                    }
                                }
                                ?>
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
<?php }

 ?>