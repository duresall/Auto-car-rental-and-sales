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
    if(isset($_GET['garage_id'])) {
        $id = $_GET['garage_id'];
        $sql2 = "SELECT status FROM garageowner WHERE garage_id='$id'";
        $result2 = $dbhh->query($sql2);
        if($result2) {
            while($row = $result2->fetch_assoc()) {
                if($row['status'] == 0) {
                    $status = 1;
                } else {
                    $status = 0;
                }
                // Update the status
                $update_sql = "UPDATE garageowner SET status = '$status' WHERE garage_id = '$id'";
                if ($dbhh->query($update_sql) === TRUE) {
                    $msg="Status updated successfully";
                } else {
                    echo "Error updating status: " . $dbhh->error;
                }
            }
        } else {
            echo "Error: " . $dbhh->error;
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
	
	<title>Car Rental Portal |Admin Manage Brands   </title>

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

						<h2 class="page-title">Manage Brands</h2>

						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-heading">Garage owners</div>
							<div class="panel-body">
							<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				             else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
										<th>#</th>
											<th>Garage Name</th>
											<th>Garage Address</th>
											<th>Phone Number</th>
											<th> Experience</th>
											<th>Rating</th>
                                            <th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
										<th>#</th>
											<th>Garage Name</th>
											<th>Garage Address</th>
											<th>Phone Number</th>
											<th> Experience</th>
											<th>Rating</th>
                                            <th>Status</th>
											<th>Action</th>
										</tr>
										</tr>
									</tfoot>
									<tbody>

									<?php $sql1 = "SELECT 
            g.name AS GarageName, 
            g.phone AS GaragePhone, 
            g.address AS GarageAddress, 
            g.years_of_experience AS YearsOfExperience,
            g.status AS Status,
            g.garage_id AS GarageId, 
            ROUND(AVG(r.ratingNumber), 1) AS AverageRating
         FROM 
            garageowner g
         LEFT JOIN 
            garage_rating r ON g.garage_id = r.garageId
         GROUP BY 
            g.garage_id, 
            g.name, 
            g.phone, 
            g.address, 
            g.years_of_experience,
            g.status";                                      
	
													   $result = $dbhh->query($sql1);
													   
													   // Check if query was successful
													   if ($result) {
														   $cnt = 1;
														   // Fetch data and display
														   while ($row = $result->fetch_assoc()) {
                                                            if($row['Status'] == 0){
                                                                $status = "Activated";
                                                            }else {
                                                                $status= "Deactivated";
                                                            }                  
															   ?>
                                                            
															   <tr>
																   <td><?php echo htmlentities($cnt); ?></td>
																   <td><?php echo htmlentities($row['GarageName']); ?></td>
																   <td><?php echo htmlentities($row['GarageAddress']); ?></td>
																   <td><?php echo htmlentities($row['GaragePhone']); ?></td>
																   <td><?php echo htmlentities($row['YearsOfExperience']); ?></td>
																   <td><?php echo htmlentities($row['AverageRating']); ?></td>
                                                                   <td><?php echo htmlentities($status); ?></td>
																   <td>
																	   <a href="view-garage.php?id=<?php echo $row['GarageId']; ?>"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
																	   <a href="manage-garage.php?garage_id=<?php echo $row['GarageId']; ?>" onclick="return confirm('Do you want to change the status?');"><i class="fa fa-close"></i></a>
																   </td>
															   </tr>
															   <?php
															   $cnt++;
														   }
													   } else {
														   // Handle error
														   echo "Error: " . $dbhh->error;
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
</body>
</html>
<?php 
} ?>
