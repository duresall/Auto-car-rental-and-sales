<?php 
session_start();
include('includes/config.php');
include('includes/configtwo.php');
$sql = "SELECT * FROM garageowner";
  $Garages = $dbhh->query($sql);
error_reporting(0);
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
    /* Custom CSS for Container Section */



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
    border-radius: 50%; /* make it circular */
    border: 4px solid #fff; /* add a border */
    width: 200px; /* adjust the size as needed */
    height: 200px;
    object-fit: cover; /* ensure the image covers the container */
}

.garage_detail_wrap {
border: #dcd9d9 solid 1px;
width: 800px;
}
@media (max-width: 768px) {
    .garage_detail_wrap {
        width: 100%; 
border: #dcd9d9 solid 1px;/* Adjust width for mobile devices */
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

.btn-half-filled {
    /* Define the style for half-filled stars */
    color: #FFD700; /* Gold color for half-filled star */
}
/* Style for default (grey) and warning (gold) buttons */
.btn-default,
.btn-grey {
    color: #777777; /* Default color for empty stars */
    background-color: #eeeeee; /* Default background color for empty stars */
    border-color: #dddddd; /* Default border color for empty stars */
}

.btn-warning {
    color: #FFD700; /* Gold color for filled stars */
    background-color: #FFD700; /* Background color for filled stars */
    border-color: #FFD700; /* Border color for filled stars */
}

/* Style for the star buttons */
.star-btn {
    border: none;
    padding: 0;
    background: none;
    cursor: pointer;
    font-size: 24px;
}

/* Style for the glyphicon star icons */
.glyphicon-star {
    margin: 0 3px;
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

    // Display the average rating
    echo "Average rating for garage ID " . $garageId . ": " . $averageRating;
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
        <li>garage details <?php printf('%.1f', $average); ?></li>
      </ul>
    </div>
  </div>
  <!-- Dark Overlay-->
  <div class="dark-overlay"></div>
</section>
<!-- /Page Header--> 
<section class="section-padding gray-bg">

</section>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-4">
      <img class="img-fluid rounded-circle" src="./garage/image/garage3.jpg" alt="Garage image" id="garageImage">
    </div>
    <div class="col-md-4">
        <h3>garage name</h3>
        <br>
        <hr>

    </div>
  </div>
  
  <!--panel list -->
            
  <div class="garage_more_info">
          <div class="garage_detail_wrap"> 
            <!-- Nav tabs -->
            <ul class="nav nav-tabs gray-bg" role="tablist">
              <li role="presentation" class="active"><a href="#contactInfo " aria-controls="contactInfo" role="tab" data-toggle="tab">contact information</a></li>
              <li role="presentation"><a href="#Rating" aria-controls="Rating" role="tab" data-toggle="tab">Rating and reviews</a></li>
              <li role="presentation" ><a href="#Certificates" aria-controls="Certificates" role="tab" data-toggle="tab">Certificates</a></li>
              <li role="presentation" ><a href="#Galary" aria-controls="Galary" role="tab" data-toggle="tab">Galary</a></li>
            </ul>     
        </div>
        <div class="tab-content"> 
              <div role="tabpanel" class="tab-pane active" id="contactInfo">
                <p>THIS IS THE SECTION FOR CONTACT INFORMATION</p>          
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
$averageRating = round($average, 1); // Round the average rating to one decimal place
$fullStars = floor($averageRating); // Get the integer part of the rating
$halfStar = ceil($averageRating - $fullStars); // Check if there's a half-star

for ($i = 1; $i <= 5; $i++) {
    if ($i <= $fullStars) {
        // Full star
        $ratingClass = "btn-warning";
    } elseif ($halfStar == 1 && $i == $fullStars + 1) {
        // Half star
        $ratingClass = "btn-half-filled";
    } else {
        // Empty star
        $ratingClass = "btn-default btn-grey";
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
	
  </div>
</div>


              <div role="tabpanel" class="tab-pane" id="Certificates">
              <p>THIS IS THE SECTION FOR Certificates</p>
              </div>
              <div role="tabpanel" class="tab-pane" id="Galary">
              <p>THIS IS THE SECTION FOR Certificates</p>
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
<script src="../garagerating/js/rating.js"></script>
<!--Switcher-->
<script src="assets/switcher/js/switcher.js"></script>
<!--bootstrap-slider-JS--> 
<script src="assets/js/bootstrap-slider.min.js"></script> 
<!--Slider-JS--> 
<script src="assets/js/slick.min.js"></script> 
<script src="assets/js/owl.carousel.min.js"></script>
</body>
</html>
