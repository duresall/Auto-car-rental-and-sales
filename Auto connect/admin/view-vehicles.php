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
	
	<title>Car Rental Portal | Admin Vehicle Info</title>

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
.video-container {
            position: relative;
            padding-bottom: 56.25%; /* 16:9 aspect ratio */
            padding-top: 25px;
            height: 0;
            margin-left: 80px;
        }
        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 75%;
            height: 75%;
            padding-left: 50px;
            
        }
        .garage-carousel {
    display: flex;
    overflow-x: auto;
    white-space: nowrap;
    scrollbar-width: none; /* For Firefox */
    -ms-overflow-style: none; /* For Internet Explorer and Edge */
}

.garage-carousel::-webkit-scrollbar {
    display: none; /* For Chrome, Safari, and Opera */
}

.garage {
    flex: 0 0 auto;
    margin-right: 20px;
    width: 300px;
    border: 1px solid #ccc;
    padding: 10px;
}

.garage img {
    width: 100%;
    height: auto;
    margin-bottom: 10px;
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
					
						<h2 class="page-title">Vehicle Info</h2>
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Basic Info</div>
									<div class="panel-body">
               
               <?php 
             $id=$_GET['id'];
             $sql ="SELECT tblvehicles.*, tblbrands.BrandName, tblbrands.id AS bid, COALESCE(l.location_name, '') AS location_name
             FROM tblvehicles
             JOIN tblbrands ON tblbrands.id = tblvehicles.VehiclesBrand
             LEFT JOIN location AS l ON tblvehicles.location = l.id
             WHERE tblvehicles.id = '$id'
             ";
             
            
             $result=$dbhh->query($sql);

             $cnt=1;
             if($result->num_rows> 0)
             {
             while($row=$result->fetch_assoc())
             {	
                $_SESSION['location'] = $row['location'];
                
                ?>

<form method="post" class="form-horizontal" enctype="multipart/form-data">
<div class="form-group">
        <label class="col-sm-2 control-label">Vehicle plate number<span style="color:red">*</span></label>
             <div class="col-sm-4">
                 <input type="text" name="vehicletitle" class="form-control" value="<?php echo htmlentities($row['plate_number'])?>" readonly>
                    </div>

                      <label class="col-sm-2 control-label">Location<span style="color:red">*</span></label>
                         <div class="col-sm-4">
                         <?php 
                         if(is_numeric($row['location'])){
                             ?>
                             <input type="text" name="Location" class="form-control" value="<?php echo htmlentities($row['location_name'])?>" readonly>
                             <?php
                         }else{
                             ?>
                             <input type="text" name="Location" class="form-control" value="<?php echo htmlentities($row['location'])?>" readonly>
                             <?php
                         }
                         ?>
</div> 
</div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Vehicle Title<span style="color:red">*</span></label>
             <div class="col-sm-4">
                 <input type="text" name="vehicletitle" class="form-control" value="<?php echo htmlentities($row['VehiclesTitle'])?>" readonly>
                    </div>
                    <label  class="col-sm-2 control-label">Vehicle Brand <span style="color:red">*</span></label>
<div class="col-sm-4">
<input type="text" class="form-control" value="<?php echo htmlentities($row['BrandName']);?>" readonly>
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">price<span style="color:red">*</span></label>
<div class="col-sm-4">
 <input type="text" name="priceperday" class="form-control" value="<?php echo number_format(($row['Price']));?>"  readonly>
</div>

<label  class="col-sm-2 control-label">FuleType <span style="color:red">*</span></label>
<div class="col-sm-4">
<input type="text" class="form-control" value="<?php echo htmlentities($row['FuelType']);?>" readonly>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">Model Year<span style="color:red">*</span></label>
<div class="col-sm-4">
<input type="text" name="modelyear" class="form-control" value="<?php echo htmlentities($row['ModelYear']);?>" readonly>
</div>

<!-- in here the vichle for -->
<label  class="col-sm-2 control-label">Vehicle for <span style="color:red">*</span></label>
<div class="col-sm-4">
<input type="text" class="form-control" value="<?php echo htmlentities($row['Vehicle_for']);?>" readonly>
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Seating Capacity<span style="color:red">*</span></label>
<div class="col-sm-4">
<input type="text" name="seatingcapacity" class="form-control" value="<?php echo htmlentities($row['SeatingCapacity']);?>" readonly>
</div>

<div class="hr-dashed"></div>								
<div class="form-group">
<div class="col-sm-12">
<h4><b>Vehicle Images</b></h4>
</div>
</div>
<div class="form-group">
<div class="col-sm-4">
Image 1 <img src="img/vehicleimages/<?php echo htmlentities($row['Vimage1']);?>" width="300" height="200" style="border:solid 1px #000">
</div>
<div class="col-sm-4">
Image 2<img src="img/vehicleimages/<?php echo htmlentities($row['Vimage2']);?>" width="300" height="200" style="border:solid 1px #000">
</div>
<div class="col-sm-4">
Image 3<img src="img/vehicleimages/<?php echo htmlentities($row['Vimage3']);?>" width="300" height="200" style="border:solid 1px #000">
</div>
</div>
<div class="form-group">
<div class="col-sm-4">
Image 4<img src="img/vehicleimages/<?php echo htmlentities($row['Vimage4']);?>" width="300" height="200" style="border:solid 1px #000">

</div>
<div class="col-sm-4">
Image 5
<?php if($row['Vimage5']=="")
{
echo htmlentities("File not available");
} else {?>
<img src="img/vehicleimages/<?php echo htmlentities($row['Vimage5']);?>" width="300" height="200" style="border:solid 1px #000">
<?php } ?>
</div>

</div>
<div class="hr-dashed"></div>									
</div>
</div>
</div>
</div>
      <div class="panel panel-default">
      <div class="panel-heading">video display</div>
      <div class="panel-body">
     <?php 
      $data = $row['url'];
      $final = str_replace('watch?v=', 'embed/', $data);
      if ($data == '') {
          echo "
              <div class='text-center'>
                  <p>A video hasn't been uploaded for this car</p>
              </div>
          ";
      } else {
          echo '
          <div class="center-text">
              <div class="video-container">
                  <iframe src="' . $final . '" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
              </div>
              </div>
          ';
      }  
            ?>       
			</div>
		</div> 
        <!-- available garages for inspecting the vehicle -->
<!-- available garages for inspecting the vehicle -->
<div class="panel panel-default">
    <div class="panel-heading">Available Garages for Inspecting the Vehicle</div>
    <div class="panel-body">
        <div class="garage-carousel">

            <?php 
            // the php code to fetch garages withing that are in the same location as that of the vehicle
            $location=$_SESSION['location'];
            if(is_numeric($location)){
                $query="SELECT g.*, l.location_name, ROUND(AVG(gr.ratingNumber), 1) AS avg_rating
                FROM garageowner AS g
                JOIN garage_rating AS gr ON g.garage_id = gr.garageId
                JOIN location AS l ON g.location = l.id
                WHERE l.id = $location
                GROUP BY g.garage_id
                ORDER BY avg_rating DESC"
                ;
            }
            else{
                $query="SELECT g.*, l.location_name, ROUND(AVG(gr.ratingNumber), 1) AS avg_rating
                FROM garageowner AS g
                JOIN garage_rating AS gr ON g.garage_id = gr.garageId
                JOIN location AS l ON g.location = l.id
                WHERE l.location_name = '$location'
                GROUP BY g.garage_id
                ORDER BY avg_rating DESC"
                ;
            }
      $answer=$dbhh->query($query);
      if($answer->num_rows>0){
        while($row1=$answer->fetch_assoc()){
           
                echo "<div class='garage'>";
                echo "<img src='../garage/image/" . htmlentities($row1['Image']) . "' alt='Garage Image'>";
                echo "<p>Garage Name: " . htmlentities($row1['name']) . "</p>";
                echo "<p>Address: " . htmlentities($row1['location_name']) . "</p>";
                echo "<p>Contact: " . htmlentities($row1['phone']) . "</p>";
                echo "<p>Rating: " . htmlentities($row1['avg_rating']) . "</p>";
                echo "</div>";
            }
        }else{echo "
            <div class='text-center'>
                <p>There are no garages available to inspect the vehicle with the given location</p>
            </div>
        ";
        }
            ?>
        </div>
        <br>
    <!-- <div class="form-group">    
		  <div class="col-sm-8 col-sm-offset-5">
		 	<button class="btn btn-primary" name="submit" onclick="performAction()">recomand garages</button>
		 </div> 
    </div> -->
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
<?php }
}
} ?>