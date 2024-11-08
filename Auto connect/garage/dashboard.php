<?php
session_start();
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
	
	<title>Auto car rental and sales | Garage Dashboard</title>

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
</head>

<body>
<?php include('includes/header.php');?>

	<div class="ts-main-content">
<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">

						<h2 class="page-title">Dashboard</h2>
						
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-3">
										<div class="panel panel-default">
											<div class="panel-body bk-primary text-light">
												<div class="stat-panel text-center">
                <?php 
//garage rating counts


$email=$_SESSION['alogin'];
$sql1="SELECT garage_id FROM garageowner WHERE email='$email'";
    $result1 = $dbhh->query($sql1);
	$row1 = $result1->fetch_assoc();
    $garage_id = $row1['garage_id'];
	

$query = "SELECT * FROM garage_rating WHERE garageId = $garage_id";
$result = $dbhh->query($query);
$totalReview = mysqli_num_rows($result);
?>
													<div class="stat-panel-number h1 "><?php echo ($totalReview);?></div>
													<div class="stat-panel-title text-uppercase">
														Rating and reviews
													</div>
												</div>
											</div>
											<a href="rating_review.php" class="block-anchor panel-footer">Full Detail <i class="fa fa-arrow-right"></i></a>
										</div>





									</div>
									<div class="col-md-3">
										<div class="panel panel-default">
											<div class="panel-body bk-success text-light">
												<div class="stat-panel text-center">
												<?php 


										  $query1="SELECT * from schedule where status=0 and garageid=$garage_id";
										  $answer=$dbhh->query($query1);
										  $totalvehicle = mysqli_num_rows($answer);
?>
													<div class="stat-panel-number h1 "><?php echo ($totalvehicle);?></div>
													<div class="stat-panel-title text-uppercase">new appointment requests</div>
												</div>
											</div>
											<a href="new-appointment.php" class="block-anchor panel-footer text-center">Full Detail &nbsp; <i class="fa fa-arrow-right"></i></a>
										</div>
									</div>
									<div class="col-md-3">
										<div class="panel panel-default">
											<div class="panel-body bk-info text-light">
												<div class="stat-panel text-center">
<?php 
 $query2="SELECT * from schedule where status=1 and garageid=$garage_id";
 $answer2=$dbhh->query($query2);
 $totalAppointments = mysqli_num_rows($answer2);
?>

													<div class="stat-panel-number h1 "><?php echo $totalAppointments;?></div>
													<div class="stat-panel-title text-uppercase">Addressed appointments</div>
												</div>
											</div>
											<a href="addressed_appointments.php" class="block-anchor panel-footer text-center">Full Detail &nbsp; <i class="fa fa-arrow-right"></i></a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>



<div class="row">
					<div class="col-md-12">

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
		
	window.onload = function(){
    
		// Line chart from swirlData for dashReport
		var ctx = document.getElementById("dashReport").getContext("2d");
		window.myLine = new Chart(ctx).Line(swirlData, {
			responsive: true,
			scaleShowVerticalLines: false,
			scaleBeginAtZero : true,
			multiTooltipTemplate: "<%if (label){%><%=label%>: <%}%><%= value %>",
		}); 
		
		// Pie Chart from doughutData
		var doctx = document.getElementById("chart-area3").getContext("2d");
		window.myDoughnut = new Chart(doctx).Pie(doughnutData, {responsive : true});

		// Dougnut Chart from doughnutData
		var doctx = document.getElementById("chart-area4").getContext("2d");
		window.myDoughnut = new Chart(doctx).Doughnut(doughnutData, {responsive : true});

	}
	</script>
</body>
</html>
<?php } ?>