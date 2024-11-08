
<?php
session_start();
error_reporting();
include('../includes/configtwo.php');
if(strlen($_SESSION['alogin'])==0) {	
    header('location:../index.php');
} else {


$msg="";
$error="";


if(isset($_POST['submit'])) {

    $name = $_POST['fullName'];
    $phone = $_POST['phone'];
    $email = $_POST['Email'];

    $query = "UPDATE garageowner SET name = '$name', phone = '$phone' WHERE email = '$email'";
    $result = mysqli_query($dbhh, $query);

    if($result) {
        $msg = "Profile updated successfully";
    } else {
        $error = "Something went wrong. Please try again: " . mysqli_error($dbhh);
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
	
	<title>Auto car rental and sales | Garage Profile</title>
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


        /* Profile information style */
        .profile-info {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
        }

        .profile-info .form-group {
            margin-bottom: 20px;
        }

        .profile-info label {
            font-weight: bold;
        }

        .profile-info input[type="text"],
        .profile-info input[type="email"],
        .profile-info textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            resize: vertical;
        }

        .profile-info textarea {
            height: 100px;
        }

        .profile-info input[type="text"]:read-only,
        .profile-info input[type="email"]:read-only,
        .profile-info textarea:read-only {
            background-color: #eee;
            border: none;
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
                        <h2 class="page-title">Profile</h2>

                        <div class="row">
                            <div class="col-md-10">
                                <div class="panel panel-default">
                                <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
									else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
                                    <div class="panel-heading">Profile section</div>
                                    <div class="panel-body">
                                        <!-- Profile information -->
                                      
                                        <form action="profile.php" method="post">
                                        <!-- lets get the currently logged in garage id and information form the session  -->
                                        <?php

                                          $garage_id=$_SESSION["garage_id"];
                                          $email=$_SESSION["alogin"];
                                       $sqlid="SELECT garage_id from garageowner where email='$email'";
                                       $resultid=$dbhh->query($sqlid);
                                       $rowid=$resultid->fetch_assoc();
                                       $garage_id=$rowid["garage_id"];
                                       $_SESSION["garage_id"]=$garage_id;

                                          
                                          $query = "SELECT g.*, ROUND(AVG(gr.ratingNumber), 1) AS avg_rating
                      FROM garageowner AS g
                      LEFT JOIN garage_rating AS gr ON g.garage_id = gr.garageId
                      WHERE g.garage_id = $garage_id
                      GROUP BY g.garage_id";
                                           $result=$dbhh->query($query);
                                           if($result->num_rows > 0){
                                               
                                        
                                           $row=$result->fetch_assoc();
                                           
?>
                                        <div class="profile-info">
                                          <div class="row">
                                            <div class="col-md-4">
                                                    <div class="profile-pic">
                                                        <img src="./image/<?php echo $row['Image']?>" alt="Profile Picture" class="img-circle" width="150">
                                                    </div>
                                            </div>
                                             <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="fullName"><?php $row['name'] ?> </label>
                                                    <input type="text" class="form-control" id="fullName" name="fullName" value="<?php echo $row['name'] ?>" >
                                                    <input type="hidden" name="garage_id" value="<?php echo $garage_id; ?>">
                                                </div>   
                                                <div class="form-group">
<?php 
                                                                     $location=$row['Location'];
                                                                     $sql="SELECT location_name from location where id=$location";
                                                                     $result1=$dbhh->query($sql);
                                                                     $row1=$result1->fetch_assoc();
?>
                                                    <label for="Location">Location </label>
                                                    <input type="text" class="form-control" id="Location" name="Location" value="<?php echo $row1['location_name'] ?>" readonly>
                                                </div>  
                                                <div class="form-group">
                                                    <label for="exprance">years of exprance </label>
                                                    <input type="text" class="form-control" id="expricance" name="expricance" value="<?php echo $row['years_of_experience'] ?>" readonly >
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="Email">Email </label>
                                                    <input type="text" class="form-control" id="Email" name="Email" value="<?php echo $row['email'] ?>" readonly>
                                                </div>   
                                            </div>
                                            
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="Email">Rating </label>
                                                    <input type="text" class="form-control" id="Rating" name="Rating" value="<?php echo $row['avg_rating'] ?> " readonly>
                                                </div>   
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="operatingHour">Phone number </label>
                                                    <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $row['phone'] ?>" pattern="[9]{1}[0-9]{8}" required title="Phone number should start with 9 and it should be 9 charchters and they should all be numbers">
                                                </div>   
                                            </div>
                                            <div class="form-group">
											  <div class="text-center">
                                                <button class="btn btn-primary" name="submit" type="submit" id="submit">update profile</button>
											  </div>
										    </div>
                                        </div>
                                   <?php } ?>
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
