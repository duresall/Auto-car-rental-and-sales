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
					
						<h2 class="page-title">Vehicle Transfere information</h2>
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Seller information</div>
									<div class="panel-body">
               




                                    <!-- use a get method to get the id of the transfere id   -->
                                    <?php
                                    $transfere_id=$_GET['id'];
                                    $query="SELECT * FROM ownership_transfere WHERE transfere_id=$transfere_id";
                                    $result=$dbhh->query($query);
                                    if($result->num_rows>0){
                                    while($row=$result->fetch_array()){
                                       $seller_id=$row['seller_id'];
                                       $sql1="SELECT * FROM tblusers WHERE id=$seller_id";
                                       $result1=$dbhh->query($sql1);
                                       $row1=$result1->fetch_array();
                                       ?>
              									<!-- THIS ARE INFORMATION ABOUT THE SELLER -->
                                                  <div class="profile-info">
                                          <div class="row">
                                            <div class="col-md-4">
                                                    <div class="profile-pic">
                                                        
                                                        <?php
                                                        if($row1['photo']==''){
                                                            ?>
                                                            <img src="../profile.png" alt="Profile Picture" class="img-circle" width="150">
                                                       <?php }else{
                                                            ?>
                                                            <img src="<?php echo htmlentities($row1['photo']); ?>" alt="Profile Picture" class="img-circle" width="150">
                                                            <?php
                                                       }

                                                        ?>
                                                        
                                                    </div>
                                            </div>
                                             <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="fullName">Full Name </label>
                                                    <input type="text" class="form-control" id="fullName" value="<?php echo htmlentities($row1['FullName']); ?>" readonly>
                                                </div>   
                                                <div class="form-group">
                                                    <label for="Location">Phone number </label>
                                                    <input type="text" class="form-control" id="Location" value="<?php echo htmlentities($row1['ContactNo']); ?>" readonly>
                                                </div>  
                                               
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="Email">Email </label>
                                                    <input type="text" class="form-control" id="Email" value="<?php echo htmlentities($row1['EmailId']); ?>" readonly>
                                                </div>   
                                            </div>
                                            
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="Email">Registered Since </label>
                                                    <input type="text" class="form-control" id="Rating" value="<?php echo htmlentities($row1['RegDate']); ?>" readonly>
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
      <div class="panel-heading">Buyer information</div>
      <div class="panel-body">
           
                        <!-- THIS ARE INFORMATION ABOUT THE SELLER -->
                        <?php
                                    $transfere_id=$_GET['id'];
                                    $query="SELECT * FROM ownership_transfere WHERE transfere_id=$transfere_id";
                                    $result=$dbhh->query($query);
                                    if($result->num_rows>0){
                                    while($row=$result->fetch_array()){
                                       $buyer_id=$row['buyer_id'];
                                       $sql1="SELECT * FROM tblusers WHERE id=$buyer_id";
                                       $result1=$dbhh->query($sql1);
                                       $row1=$result1->fetch_array();
                                      
                                       ?>
              									<!-- THIS ARE INFORMATION ABOUT THE SELLER -->
                                                  <div class="profile-info">
                                          <div class="row">
                                            <div class="col-md-4">
                                                    <div class="profile-pic">
                                                        
                                                        <?php
                                                        if($row1['photo']==''){
                                                            ?>
                                                            <img src="../profile.png" alt="Profile Picture" class="img-circle" width="150">
                                                       <?php }else{
                                                            ?>
                                                            <img src="../<?php echo htmlentities($row1['photo']); ?>" alt="Profile Picture" class="img-circle" width="150">
                                                            <?php
                                                       }

                                                        ?>
                                                        
                                                    </div>
                                            </div>
                                             <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="fullName">Full Name </label>
                                                    <input type="text" class="form-control" id="fullName" value="<?php echo htmlentities($row1['FullName']); ?>" readonly>
                                                </div>   
                                                <div class="form-group">
                                                    <label for="Location">Phone number </label>
                                                    <input type="text" class="form-control" id="Location" value="<?php echo htmlentities($row1['ContactNo']); ?>" readonly>
                                                </div>  
                                               
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="Email">Email </label>
                                                    <input type="text" class="form-control" id="Email" value="<?php echo htmlentities($row1['EmailId']); ?>" readonly>
                                                </div>   
                                            </div>
                                            
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="Email">Registered Since </label>
                                                    <input type="text" class="form-control" id="Rating" value="<?php echo htmlentities($row1['RegDate']); ?>" readonly>
                                                </div>   
                                            </div>

                                          <hr>
                                        </div>

                                        
                                    </div>
                                    <?php

                                                    }}
                                                    ?>
                                                <!-- END OF THE INFORMATON -->
			</div>
		</div> 

<div class="panel panel-default">
    <div class="panel-heading">vehicle information and Transfere related Documents</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <!-- <div class="col-md-4">
                        <div class="thumbnail">
                            <img src="images/certificate.jpg" alt="" class="img-responsive">
                            <div class="caption">
                                <h3>Certificate of Origin</h3>
                                <p><a href="images/certificate.jpg" class="btn btn-primary" role="button" target="_blank">View</a></p>
                            </div>
                        </div>
                    </div> -->


<?php

$transfere_id=$_GET['id'];

$querys1="SELECT documents FROM ownership_transfere WHERE transfere_id=$transfere_id";
$results1=$dbhh->query($querys1);
$rows1=$results1->fetch_assoc();

?>

                    <div class="col-md-4">
                        <div class="thumbnail">
                            <object data="./img/vehicleimages/ <?php echo $rows1['documents']; ?>" type="application/pdf" width="100%" height="300px">
                                <embed src="./img/vehicleimages/<?php echo $rows1['documents']; ?>" type="application/pdf">
                                    <p>This browser does not support PDFs. Please download the PDF to view it: <a href="images/vehicle_documents.pdf">Download PDF</a>.</p>
                            </object>
                            <div class="caption">
                                <h3>Vehicle Documents</h3>
                                <p><a href="./img/vehicleimages/<?php echo $rows1['documents']; ?>" class="btn btn-primary" role="button" target="_blank">View</a></p>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-md-4">
                        <div class="thumbnail">
                            <img src="images/inspection.jpg" alt="" class="img-responsive">
                            <div class="caption">
                                <h3>Inspection Report</h3>
                                <p><a href="images/inspection.jpg" class="btn btn-primary" role="button" target="_blank">View</a></p>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
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