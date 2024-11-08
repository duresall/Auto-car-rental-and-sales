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
if(isset($_REQUEST['eid']))
	{
$eid=intval($_GET['eid']);
$status=1;
$sql = "UPDATE tblcontactusquery SET status=:status WHERE  id=:eid";
$query = $dbh->prepare($sql);
$query -> bindParam(':status',$status, PDO::PARAM_STR);
$query-> bindParam(':eid',$eid, PDO::PARAM_STR);
$query -> execute();


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
	
	<title>Car Rental Portal |Admin Manage Queries   </title>

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

						<h2 class="page-title">Manage Contact Us Queries</h2>

						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-heading">User queries</div>
							<div class="panel-body">
					
								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
										<th>#</th>
											<th>Vehicle plate number</th>
											<th>Previous Inspector name</th>
											<th>latest Inspector name</th>
											<th>Action</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
										<th>#</th>
                                        <th>Vehicle plate number</th>
											<th>Previous Inspector name</th>
											<th>latest Inspector name</th>
											<th>Action</th>
										</tr>
										</tr>
									</tfoot>
									<tbody>

<!-- plane first fetech the id of the seller and the buyer form the data base  -->
									<?php 
                                    $query="SELECT * FROM vehicle_inspections_flag AS vi_flag WHERE
                                    (vi_flag.AirConditioner <> 0)
                                    OR (vi_flag.PowerDoorLocks <> 0)
                                    OR (vi_flag.AntiLockBrakingSystem <> 0)
                                    OR (vi_flag.BrakeAssist <> 0)
                                    OR (vi_flag.PowerSteering <> 0)
                                    OR (vi_flag.DriverAirbag <> 0)
                                    OR (vi_flag.PassengerAirbag <> 0)
                                    OR (vi_flag.PowerWindows <> 0)
                                    OR (vi_flag.CDPlayer <> 0)
                                    OR (vi_flag.CentralLocking <> 0)
                                    OR (vi_flag.CrashSensor <> 0)
                                    OR (vi_flag.LeatherSeats <> 0)
                                    ";
                                
                            $result=$dbhh->query($query);
                            
                            $cnt=1;
                            if($result->num_rows > 0){

                              while($row = $result->fetch_assoc()){
                               			?>	
										<tr>
                                            
											<td><?php echo htmlentities($cnt);?></td>


											<?php
											$query1="SELECT plate_number FROM tblvehicles WHERE id = $row[vehicle_id]";
											$result1=$dbhh->query($query1);
											$row1=$result1->fetch_assoc();			
											$plate_number = $row1['plate_number'];
                                            ?>

											<td><?php echo $plate_number;?></td>
											<?php
											$query2="SELECT vi.*, g.name, g.email FROM vehicle_inspections vi
											INNER JOIN garageowner g ON vi.garage_id = g.garage_id
											WHERE vi.inspection_id = $row[sellerinspection_id]";
											$result2=$dbhh->query($query2);
											$row2=$result2->fetch_assoc();
												
                                               ?>
											<td><?php echo htmlentities($row2['name']);?></td>
											
											<?php
											$query3="SELECT vi.*, g.name, g.email FROM vehicle_inspections vi
											INNER JOIN garageowner g ON vi.garage_id = g.garage_id
											WHERE vi.inspection_id = $row[buyerinspection_id]";
											$result3=$dbhh->query($query3);
											$row3=$result3->fetch_assoc();
												
                                               ?>
											<td><?php echo htmlentities($row3['name']);?></td>
											
																
                                        
<td><a href="view_inspection.php?id=<?php echo $row['flag_id'];?>"><i class="fa fa-eye" aria-hidden="true"></i></a>
</td>

										</tr>
										<?php $cnt=$cnt+1; }} ?>
										
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
</body>
</html>
<?php } ?>
