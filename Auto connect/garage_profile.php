<?php 
session_start();
include('includes/config.php');
include('includes/configtwo.php');
$sql = "SELECT * FROM garageowner";
  $Garages = $dbhh->query($sql);
error_reporting(0);

if(isset($_POST['submit'])) {
  $vehicle_number = $_POST['plate_number'];
  $message = $_POST['message'];
  $garageId = $_POST['garage_id'];
  $userid = $_SESSION['id'];


  $query = "INSERT INTO `schedule` (`userid`, `vid`, `message`, `garageid`) VALUES (?, ?, ?, ?)";
  $stmt = $dbhh->prepare($query);
  $stmt->bind_param("isss", $userid, $vehicle_number, $message, $garageId);
  $result = $stmt->execute();

  if($result) {
      echo "<script>alert('appointment send successful.');</script>";
      echo "<script type='text/javascript'> document.location = 'my-schedule.php'; </script>";
  } else {
      // Handle insertion failure
      echo "<script>alert('Something went wrong. Please try again.');</script>";
      echo "<script type='text/javascript'> document.location = 'garage_profile.php'; </script>";
  } 
}

?>
<!DOCTYPE HTML>
<html lang="en">
<head>

<title>Auto car rental and sales | Garage details</title>
<!--Bootstrap -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
<!--Custome Style -->
<link rel="stylesheet" href="assets/css/style.css" type="text/css">
<link rel="stylesheet" href="style.css" type="text/css">

<!--OWL Carousel slider-->
<link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
<link rel="stylesheet" href="assets/css/owl.transitions.css" type="text/css">
<!--slick-slider -->
<link href="assets/css/slick.css" rel="stylesheet">
<!--bootstrap-slider -->
<link href="assets/css/bootstrap-slider.min.css" rel="stylesheet">
<!--FontAwesome Font Style -->
<link href="assets/css/font-awesome.min.css" rel="stylesheet">
<!--garage css-->
<style>
    .row {
    margin-bottom: 20px;
}
.card {
    border: none;
    border-radius: 10px;
    box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.card:hover {
    box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.2);
    transform: translateY(-5px);
}

.card-header {
    background-color: #f8f9fa;
    border-bottom: 1px solid #ddd;
    padding: 15px 20px;
}

.card-body {
    padding: 20px;
}

.img-fluid {
    max-width: 100%;
    height: auto;
    border-radius: 10px;
}

#garageImage {
    border-radius: 65%;
    border: 4px solid #fff; 
    width: 160px; 
    height: 160px;
    object-fit: cover; 
}

.garage_detail_wrap {
border: #dcd9d9 solid 1px;
width: 800px;
}
@media (max-width: 768px) {
    .garage_detail_wrap {
        width: 100%; 
border: #dcd9d9 solid 1px;
    }
}
.garage_detail_wrap .nav-tabs > li a {
  font-size: 18px;
  font-weight: 400;
  line-height: 66px;
  padding: 0 30px;
  background: none;
  color: #555;
}
.garage_detail_wrap .nav-tabs > li.active a,
.garage_detail_wrap .nav-tabs > li:hover a {
  color: #fff;
  background: #fa2837;
}
.garage_detail_wrap .tab-content {
  padding: 35px;
}
.tab-content{
  margin-top: 20px;
}
.garage_detail_wrap .tab-content h1,
.garage_detail_wrap .tab-content h2,
.garage_detail_wrap .tab-content h3,
.garage_detail_wrap .tab-content h4,
.garage_detail_wrap .tab-content h5,
.garage_detail_wrap .tab-content h6 {
  margin-top: 40px;
}
.garage_more_info table td,
.garage_more_info table th {
  font-size: 16px;
}
.garage_more_info table tr td:first-child {
  color: #111;
}
.btn-grey {
  background-color: #d8d8d8;
  color: #fff;
}
.rating-block {
  background-color: #fafafa;
  border: 1px solid #efefef;
  padding: 15px 15px 20px 15px;
  border-radius: 3px;
}
.bold {
  font-weight: 700;
}
.padding-bottom-7 {
  padding-bottom: 7px;
}

.review-block {
  background-color: #fafafa;
  border: 1px solid #efefef;
  padding: 15px;
  border-radius: 3px;
  margin-bottom: 15px;
}
.review-block-name {
  font-size: 12px;
  margin: 10px 0;
}
.review-block-date {
  font-size: 12px;
}
.review-block-rate {
  font-size: 13px;
  margin-bottom: 15px;
}
.review-block-title {
  font-size: 15px;
  font-weight: 700;
  margin-bottom: 10px;
}
.review-block-description {
  font-size: 13px;
}
.average {
  background-color: #388e3c;
  line-height: normal;
  display: inline-block;
  color: #fff;
  padding: 2px 4px 2px 6px;
  border-radius: 3px;
  font-weight: 500;
  font-size: 12px;
  vertical-align: middle;
}
.rating-reviews {
  padding-left: 8px;
  font-weight: 500;
  color: #878787;
}

.custom-button {
    padding: 10px 20px;
    background-color: #555;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    text-align: center;
    margin-bottom: 10px;
    margin-left: 10px;
    padding-left: 10px;
}

.custom-button:hover {
    background-color: #333;
    
}
.custom-form-group {
    
    width: 800px; 
    margin-bottom: 20px; 
}

@media (max-width: 768px) {
    .custom-form-group {
        width: 100%; 
    }
}
.contact-info-item {
    margin-bottom: 15px;
}

.contact-info-row {
    display: flex;
    align-items: center;
}

.contact-info-label {
    font-weight: bold;
    margin-right: 10px;
}

.contact-info-value {
    /* You can adjust the styles for value if needed */
}
.certificates {
  padding: 20px;
}

.certificate-list {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 20px;
}

.certificate-item {
  background-color: #f9f9f9;
  padding: 10px;
  border-radius: 5px;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
  text-align: center;
}

.certificate-item img {
  max-width: 100%;
  height: auto;
  border-radius: 5px;
}

.certificate-item h3 {
  margin-top: 10px;
  font-size: 18px;
}

.certificate-item p {
  margin: 5px 0;
  font-size: 14px;
}
.spacer-double{
  height: 50px;
}
.contact-info {
    background-color: #f5f5f5;
    padding: 15px;
    border-radius: 5px;
}

.contact-info-item {
    margin-bottom: 15px;
}

.contact-info-row {
    display: flex;
    align-items: center;
}

.contact-info-label {
    flex: 1;
    font-weight: bold;
    margin-right: 10px;
}

.contact-info-value {
    flex: 3;
}
.garage-info {
    background-color: #f5f5f5;
    padding: 15px;
    border-radius: 5px;
}

.garage_name {
    font-size: 18px;
    font-weight: bold;
    color: #333;
}

.garage_location {
    font-size: 16px;
    color: #666;
}

</style>
<!-- SWITCHER -->
		<link rel="stylesheet" id="switcher-css" type="text/css" href="assets/switcher/css/switcher.css" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/red.css" title="red" media="all" data-default-color="true" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/orange.css" title="orange" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/blue.css" title="blue" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/pink.css" title="pink" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/green.css" title="green" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/purple.css" title="purple" media="all" />  
<!-- Fav and touch icons -->
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/images/favicon-icon/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/images/favicon-icon/apple-touch-icon-114-precomposed.html">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/images/favicon-icon/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="assets/images/favicon-icon/apple-touch-icon-57-precomposed.png">
<link rel="shortcut icon" href="assets/images/favicon-icon/auto.png">
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
<link rel="stylesheet" href="garagerating/css/style.css">

</head>
<body>

<!-- Start Switcher -->
<?php include('includes/colorswitcher.php');?>
<!-- /Switcher -->  

<!--Header--> 
<?php include('includes/header.php');?>
<!-- /Header --> 
<?php
include 'garagerating/class/Rating.php';

$rating = new Rating();

// Ensure that $_GET['garage_id'] is set and is not empty
if(isset($_GET['garage_id']) && !empty($_GET['garage_id'])) {
    $garageId = $_GET['garage_id'];

    // Get the average rating for the specified garage ID
    $averageRating = $rating->getRatingAverage($garageId);

} else {
    echo "Garage ID is not provided or is empty.";
}
?>
<!--Page Header-->
<section class="page-header listing_page">
  <div class="container">
    <div class="page-header_wrap">
      <div class="page-heading">
        <h1>Garage details</h1>
      </div>
      <ul class="coustom-breadcrumb">
        <li><a href="#">Home</a></li>
        <li>garage details</li>
      </ul>
    </div>
  </div>
  <!-- Dark Overlay-->
  <div class="dark-overlay"></div>
</section>
<!-- /Page Header--> 
<div class="spacer-double"></div>
<?php
//ye garague infomation lemaskemete nw
$id=$_GET['garage_id'];
$query="SELECT * FROM garageowner WHERE garage_id=$id";
$result=$dbhh->query($query);
$row=$result->fetch_assoc();
	?>

<div class="container">
<div class="row justify-content-center align-items-center my-4">
    <div class="col-md-4 text-center">
        <img class="img-fluid rounded-circle" src="./garage/image/<?php echo $row['Image']?>" alt="Garage image" id="garageImage">
    </div>

    <div class="col-md-6">
    <div class="garage-info">
        <h3 class="garage_name mb-3">Owner Name: <?php echo $row['name']?></h3>
        <h4 class="garage_location">Location: <?php echo $row['location']?></h4>
    </div>
</div>

</div>
  <!--panel list -->       
  <div class="garage_more_info">
          <div class="garage_detail_wrap"> 
            <!-- Nav tabs -->
            <ul class="nav nav-tabs gray-bg" role="tablist">
              <li role="presentation" class="active"><a href="#contactInfo " aria-controls="contactInfo" role="tab" data-toggle="tab">contact information</a></li>
              <li role="presentation"><a href="#Rating" aria-controls="Rating" role="tab" data-toggle="tab">Rating and reviews</a></li>
              <!-- <li role="presentation" ><a href="#Certificates" aria-controls="Certificates" role="tab" data-toggle="tab">Certificates</a></li> -->
              <li role="presentation" ><a href="#message" aria-controls="message" role="tab" data-toggle="tab">Send a message</a></li>
            </ul>     
        </div>
        <div class="tab-content"> 
		<div role="tabpanel" class="tab-pane active" id="contactInfo">
    <aside class="col-md-6 offset-md-3">
    <div class="sidebar_widget text-center">
        <div class="widget_heading">
            <h5><i class="fa fa-info-circle" aria-hidden="true"></i> Contact Information</h5>
        </div>
        <?php

        $garageinfo="SELECT * FROM garageowner where garage_id=$garageId";
        $result3=$dbhh->query($garageinfo);
        if($result3){
               $row2=$result3->fetch_assoc();
       

        ?>
        <div class="contact-info">
            <div class="contact-info-item">
                <div class="contact-info-row">
                    <div class="contact-info-label"><i class="fa fa-phone"></i> Phone Number:</div>
                    <div class="contact-info-value"><?php echo $row2['phone'] ?></div>
                </div>
            </div>
            <div class="contact-info-item">
                <div class="contact-info-row">
                    <div class="contact-info-label"><i class="fa fa-envelope"></i> Email Address:</div>
                    <div class="contact-info-value"><?php echo $row2['email'] ?></div>
                </div>
            </div>
            <div class="contact-info-item">
                <div class="contact-info-row">
                <?php
                $location=$row2['Location'];
                $sql4="SELECT location_name from location where id=$location";
                $result4=$dbhh->query($sql4);
                $row4=$result4->fetch_assoc();

?>
                    <div class="contact-info-label"><i class="fa fa-map-marker"></i> Address:</div>
                    <div class="contact-info-value"><?php echo $row4['location_name'] ?></div>
                </div>
            </div>
        </div>
      <?php  }?>
    </div>
</aside>

    <!-- <div class="contact-info-item">
        <h4><i class="fa fa-map"></i> Location</h4>
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d61727.47422199987!2d36.8200868!3d7.6662108!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xd1fe34ecd89e0696!2sAbba%20Jifar%20Airport!5e0!3m2!1sen!2sus!4v1647942904392!5m2!1sen!2sus" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>

    </div> -->
</div>
      
              <div role="tabpanel" class="tab-pane" id="Rating">
              <?php	
	       $garageRating = $rating->getGarageRating($_GET['garage_id']);	
	       $ratingNumber = 0;
	       $count = 0;
	       $fiveStarRating = 0;
	       $fourStarRating = 0;
	       $threeStarRating = 0;
	       $twoStarRating = 0;
	       $oneStarRating = 0;	
	   foreach($garageRating as $rate){
	   	$ratingNumber+= $rate['ratingNumber'];
	   	$count += 1;
	   	if($rate['ratingNumber'] == 5) {
	   		$fiveStarRating +=1;
	   	} else if($rate['ratingNumber'] == 4) {
	   		$fourStarRating +=1;
		} else if($rate['ratingNumber'] == 3) {
			$threeStarRating +=1;
		} else if($rate['ratingNumber'] == 2) {
			$twoStarRating +=1;
		} else if($rate['ratingNumber'] == 1) {
			$oneStarRating +=1;
		}
	}
	$average = 0;
	if($ratingNumber && $count) {
		$average = $ratingNumber/$count;
	}	
	?>	     
  <div id="ratingDetails"> 		
    <div class="row">			
      <div class="col-sm-3">	
        <div class="center-text"> <h4>Rating and Reviews</h4></div>			
       
        <h2 class="bold padding-bottom-7"><?php printf('%.1f', $average); ?> <small>/ 5</small></h2>				
        <?php
				$averageRating = round($average, 0);
				for ($i = 1; $i <= 5; $i++) {
					$ratingClass = "btn-default btn-grey";
					if($i <= $averageRating) {
						$ratingClass = "btn-warning";
					}
				?>
    <!-- Refactored button with updated class -->
    <button type="button" class="star-btn <?php echo $ratingClass; ?>" aria-label="Left Align">
        <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
    </button>
<?php } ?>


      </div>
      <div class="col-sm-3">
				<?php
				$fiveStarRatingPercent = round(($fiveStarRating/5)*100);
				$fiveStarRatingPercent = !empty($fiveStarRatingPercent)?$fiveStarRatingPercent.'%':'0%';	
				
				$fourStarRatingPercent = round(($fourStarRating/5)*100);
				$fourStarRatingPercent = !empty($fourStarRatingPercent)?$fourStarRatingPercent.'%':'0%';
				
				$threeStarRatingPercent = round(($threeStarRating/5)*100);
				$threeStarRatingPercent = !empty($threeStarRatingPercent)?$threeStarRatingPercent.'%':'0%';
				
				$twoStarRatingPercent = round(($twoStarRating/5)*100);
				$twoStarRatingPercent = !empty($twoStarRatingPercent)?$twoStarRatingPercent.'%':'0%';
				
				$oneStarRatingPercent = round(($oneStarRating/5)*100);
				$oneStarRatingPercent = !empty($oneStarRatingPercent)?$oneStarRatingPercent.'%':'0%';
				
				?>
				<div class="pull-left">
					<div class="pull-left" style="width:35px; line-height:1;">
						<div style="height:9px; margin:5px 0;">5 <span class="glyphicon glyphicon-star"></span></div>
					</div>
					<div class="pull-left" style="width:180px;">
						<div class="progress" style="height:9px; margin:8px 0;">
						  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="5" style="width: <?php echo $fiveStarRatingPercent; ?>">
							<span class="sr-only"><?php echo $fiveStarRatingPercent; ?></span>
						  </div>
						</div>
					</div>
					<div class="pull-right" style="margin-left:10px;"><?php echo $fiveStarRating; ?></div>
				</div>
				
				<div class="pull-left">
					<div class="pull-left" style="width:35px; line-height:1;">
						<div style="height:9px; margin:5px 0;">4 <span class="glyphicon glyphicon-star"></span></div>
					</div>
					<div class="pull-left" style="width:180px;">
						<div class="progress" style="height:9px; margin:8px 0;">
						  <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="4" aria-valuemin="0" aria-valuemax="5" style="width: <?php echo $fourStarRatingPercent; ?>">
							<span class="sr-only"><?php echo $fourStarRatingPercent; ?></span>
						  </div>
						</div>
					</div>
					<div class="pull-right" style="margin-left:10px;"><?php echo $fourStarRating; ?></div>
				</div>
				<div class="pull-left">
					<div class="pull-left" style="width:35px; line-height:1;">
						<div style="height:9px; margin:5px 0;">3 <span class="glyphicon glyphicon-star"></span></div>
					</div>
					<div class="pull-left" style="width:180px;">
						<div class="progress" style="height:9px; margin:8px 0;">
						  <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="3" aria-valuemin="0" aria-valuemax="5" style="width: <?php echo $threeStarRatingPercent; ?>">
							<span class="sr-only"><?php echo $threeStarRatingPercent; ?></span>
						  </div>
						</div>
					</div>
					<div class="pull-right" style="margin-left:10px;"><?php echo $threeStarRating; ?></div>
				</div>
				<div class="pull-left">
					<div class="pull-left" style="width:35px; line-height:1;">
						<div style="height:9px; margin:5px 0;">2 <span class="glyphicon glyphicon-star"></span></div>
					</div>
					<div class="pull-left" style="width:180px;">
						<div class="progress" style="height:9px; margin:8px 0;">
						  <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="5" style="width: <?php echo $twoStarRatingPercent; ?>">
							<span class="sr-only"><?php echo $twoStarRatingPercent; ?></span>
						  </div>
						</div>
					</div>
					<div class="pull-right" style="margin-left:10px;"><?php echo $twoStarRating; ?></div>
				</div>
				<div class="pull-left">
					<div class="pull-left" style="width:35px; line-height:1;">
						<div style="height:9px; margin:5px 0;">1 <span class="glyphicon glyphicon-star"></span></div>
					</div>
					<div class="pull-left" style="width:180px;">
						<div class="progress" style="height:9px; margin:8px 0;">
						  <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="1" aria-valuemin="0" aria-valuemax="5" style="width: <?php echo $oneStarRatingPercent; ?>">
							<span class="sr-only"><?php echo $oneStarRatingPercent; ?></span>
						  </div>
						</div>
					</div>
					<div class="pull-right" style="margin-left:10px;"><?php echo $oneStarRating; ?></div>
				</div>
			</div>		
    </div>
    <!--rating block form the users -->
    <div class="row">
			<div class="col-sm-7">
				<hr/>
				<div class="review-block">		
				<?php
				$garageRating = $rating->getGarageRating($_GET['garage_id']);
				foreach($garageRating as $rating){				
					$date=date_create($rating['created']);
					$reviewDate = date_format($date,"M d, Y");						
					$profilePic = "profile.png";	
					if($rating['avatar']) {
						$profilePic = $rating['avatar'];	
					}
				?>				
					<div class="row">
						<div class="col-sm-3">
							<img src="profile.png" class="img-rounded user-pic">
							<div class="review-block-name">By <a href="#"><?php echo $rating['FullName']; ?></a></div>
							<div class="review-block-date"><?php echo $reviewDate; ?></div>
						</div>
						<div class="col-sm-9">
							<div class="review-block-rate">
								<?php
								for ($i = 1; $i <= 5; $i++) {
									$ratingClass = "btn-default btn-grey";
									if($i <= $rating['ratingNumber']) {
										$ratingClass = "btn-warning";
									}
								?>
								<button type="button" class="star-btn btn-xs <?php echo $ratingClass; ?>" aria-label="Left Align">
								  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
								</button>								
								<?php } ?>
							</div>
							<div class="review-block-title"><?php echo $rating['title']; ?></div>
							<div class="review-block-description"><?php echo $rating['comments']; ?></div>
						</div>
					</div>
					<hr/>					
				<?php } ?>
				</div>
			</div>
		</div>
    
    <?php if(isset($_SESSION['login'])): ?>
        <!-- in here only users that have interaction with the garage only will be able to rate -->
        <!-- users that can rate the  -->
        <!--1. users that requested inspection this car  -->
        <!-- 2. users that have interaction with the garage -->
        <!-- 3. users the insected there vehicle -->
      <?php
      $userid=$_SESSION['id'];
      $garageidforrating=$_GET['garage_id'];
    //  now we got the id of user and the id of garage we can make a connection with different tables 
  // tables to consider 
  // 1. schedule
  // 2. vehicle_inspections
      $querys="SELECT * FROM `schedule` WHERE `garageid` = $garageidforrating AND `userid` = $userid";
      $results=$dbhh->query($querys);
      if($results->num_rows > 0){
        ?>
        <div class="col-sm-5 d-flex align-items-center justify-content-center">
        <button type="button" id="rateGarage" class="custom-button">Rate this garage</button>
        </div>
        <?php
      }else{

        $querys1="SELECT * FROM `vehicle_inspections` 
        INNER JOIN `tblvehicles` ON `tblvehicles`.`id` = `vehicle_inspections`.`vehicle_id`
        WHERE `vehicle_inspections`.`garage_id` = $garageidforrating AND `tblvehicles`.`userid` = $userid";
       $results1=$dbhh->query($querys1);
       if($results1->num_rows > 0){
        ?>
        <div class="col-sm-5 d-flex align-items-center justify-content-center">
        <button type="button" id="rateGarage" class="custom-button">Rate this garage</button>
        </div>
        <?php
       }
      }

      ?>
    
    <?php endif; ?>



  </div>
  <div id="ratingSection" style="display:none;">
		<div class="row">
			<div class="col-sm-12">
				<form id="ratingForm" method="POST">					
					<div class="form-group">
						<h4>Rate this garage</h4>
						<button type="button" class="star-btn btn-warning btn-sm rateButton" aria-label="Left Align">
						  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
						</button>
						<button type="button" class="star-btn btn-default btn-grey btn-sm rateButton" aria-label="Left Align">
						  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
						</button>
						<button type="button" class="star-btn btn-default btn-grey btn-sm rateButton" aria-label="Left Align">
						  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
						</button>
						<button type="button" class="star-btn btn-default btn-grey btn-sm rateButton" aria-label="Left Align">
						  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
						</button>
						<button type="button" class="star-btn btn-default btn-grey btn-sm rateButton" aria-label="Left Align">
						  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
						</button>
						<input type="hidden" class="form-control" id="rating" name="rating" value="1">
						<input type="hidden" class="form-control" id="garageId" name="garageId" value="<?php echo $_GET['garage_id']; ?>">
						<input type="hidden" name="action" value="saveRating">
						
					</div>		
          <div class="form-group custom-form-group">
    <label for="usr" class="custom-label">Title*</label>
    <input type="text" class="form-control custom-input" id="title" name="title" required>
</div>
<div class="form-group custom-form-group">
    <label for="comment" class="custom-label">Comment*</label>
    <textarea class="form-control custom-textarea" rows="5" id="comment" name="comment" required></textarea>
</div>

					<div class="form-group">
						<button type="submit" class="custom-button btn-info" id="saveReview">Save Review</button> <button type="button" class="custom-button btn-info" id="cancelReview">Cancel</button>
					</div>			
				</form>
			</div>
		</div>		
	</div>
</div>
              <div role="tabpanel" class="tab-pane" id="Certificates">
			  <div class="certificates">
  <h2>Certificates</h2>
  <div class="certificate-list">
    <div class="certificate-item">
      <!-- <img src="cer.jpg" alt="Certificate 1"> -->
      <h3>Certificate Title</h3>
      <p>Issuing Organization: XYZ Institute</p>
      <p>Date of Issuance: January 1, 2024</p>
    </div>
    <!-- Add more certificate items as needed -->
  </div>
</div>
              </div>
              <div role="tabpanel" class="tab-pane" id="message">
             
              <!-- A SECTION FOR MAKING AN APPOINETMENT TO THE GARAGE  -->

       
              <aside class="col-md-6 offset-md-3">
    <div class="sidebar_widget text-center">
        <div class="widget_heading">
            <h5><i class="fa fa-envelope" aria-hidden="true"></i> Schedule Appointment</h5>
        </div>
        <form method="post">
            <div class="form-group">
                <label>Vehicle Plate Number:</label>
                <input type="text" class="form-control"  name="plate_number" onBlur="platenumbers()" id="platenumber"  placeholder="Vehicle Plate Number" required>
                <span id="plate-number-validation" style="font-size:12px;"></span> 
            </div>
            <input type="hidden" name="garage_id" value="<?php echo $_GET['garage_id']; ?>">
            <div class="form-group">
                <label>Message:</label>
                <textarea rows="4" class="form-control" name="message" placeholder="Message" required></textarea>
            </div>

            <?php if($_SESSION['login']) { ?>
                <div class="form-group">
                    <input type="submit" class="btn"  name="submit" id="submit" value="Request Appointment">
                </div>
            <?php } else { ?>
                <a href="#loginform" class="btn btn-xs uppercase" data-toggle="modal" data-dismiss="modal">Login To Schedule</a>
            <?php } ?>
        </form>
    </div>
</aside>

      <!--/Side-Bar-->         
</div>
              <!--/END OF THE SECTION WHERE USERS CAN USE TO COMMUNICATE WITH THE GARAGE   -->
              </div>
      </div>
</div>
<!--end of the panel list for the garage-->
</div>
<!--should end here -->
<!-- another card choice-->                          
<!--end of the card-->
<!--Footer -->
<?php include('includes/footer.php');?>
<!-- /Footer--> 

<!--Back to top-->
<div id="back-top" class="back-top"> <a href="#top"><i class="fa fa-angle-up" aria-hidden="true"></i> </a> </div>
<!--/Back to top--> 

<!--Login-Form -->
<?php include('includes/login.php');?>
<!--/Login-Form --> 

<!--Register-Form -->
<?php include('includes/registration.php');?>


<!--Forgot-password-Form -->
<?php include('includes/forgotpassword.php');?>
<!-- Scripts --> 
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script> 
<script src="assets/js/interface.js"></script> 
<script src="garagerating/js/rating.js"></script>
<!--Switcher-->
<script src="assets/switcher/js/switcher.js"></script>
<!--bootstrap-slider-JS--> 
<script src="assets/js/bootstrap-slider.min.js"></script> 
<!--Slider-JS--> 
<script src="assets/js/slick.min.js"></script> 
<script src="assets/js/owl.carousel.min.js"></script>
<script>
function platenumbers() {
    $("#loaderIcon").show();
    jQuery.ajax({
        url: "./users/action/platenumber-validation.php",
        data:'platenumber='+$("#platenumber").val(),
        type: "POST",
        success:function(data){
            $("#plate-number-validation").html(data);
            $("#loaderIcon").hide();
        },
        error:function (){}
    });
}
</script>
</body>
</html>
