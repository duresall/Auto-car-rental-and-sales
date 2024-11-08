<?php 
session_start();
error_reporting(0);
include('includes/configtwo.php');
if(strlen($_SESSION['login'])==0)
  { 
header('location:index.php');
}
else{

?>
<!DOCTYPE HTML>
<html lang="en">
<head>

<title>Car Rental Portal | Car Listing</title>
<!--Bootstrap -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
<!--Custome Style -->
<link rel="stylesheet" href="assets/css/style.css" type="text/css">
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
<style>

.car-info-box img {
    max-width: 100%;
    height: auto;
    display: block;
    margin: 0 auto;
}

.recent-car-list {
  background: #ffffff none repeat scroll 0 0;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
  margin-top: 20px;
}
.car-info-box {
  position: relative;
}
.recent-car-list img {
        width: 100%;
        height: 200px;
        max-width: 100%;
        object-fit: cover;
    }
  #car-listings {
    padding-left: 5px;
    display: flex;
    flex-wrap: wrap;
    justify-content: ;
}

.car-item {
    width: calc(33.33% - 20px); /* Adjust margins for three items per row */
    margin-bottom: 20px;
}
.center-text {
    text-align: center;
    margin-top:5px;
    padding-bottom:5px;
   
}

.btn {
    display: inline-block;
   
    background-color: #007bff;
    color: #fff;
    text-decoration: none;
    border-radius: 4px;
    transition: background-color 0.3s;
}

.btn:hover {
    background-color: #0056b3;
}

</style>
</head>
<body>

<!-- Start Switcher -->
<?php include('includes/colorswitcher.php');?>
<!-- /Switcher -->  

<!--Header--> 
<?php include('includes/header.php');?>
<!-- /Header --> 

<!--Page Header-->
<section class="page-header listing_page">
  <div class="container">
    <div class="page-header_wrap">
      <div class="page-heading">
        <h1>Car Listing</h1>
      </div>
      <ul class="coustom-breadcrumb">
        <li><a href="#">Home</a></li>
        <li>Car Listing</li>
      </ul>
    </div>
  </div>
  <!-- Dark Overlay-->
  <div class="dark-overlay"></div>
</section>
<!-- /Page Header--> 
<section class="section-padding gray-bg">
  <div class="container">
    <div class="section-header text-center">
      <h2>Select your perefered <span>Garage</span></h2>
    </div>
    <div class="row"> 
      
      <!-- Nav tabs -->
      <div class="recent-tab">
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active"><a href="#resentnewcar" role="tab" data-toggle="tab">Garages</a></li>
        </ul>
      </div>
      <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="resentnewcar">
        <?php
        if ($dbhh->connect_error) {
            die("Connection failed: " . $dbhh->connect_error);
        }

        $location_id=intval($_GET['id']);


if(isset($_SESSION['user_latitude']) && isset($_SESSION['user_longitude'])) {
          
  $query = "SELECT g.*, l.*, ROUND(AVG(gr.ratingNumber), 1) AS avg_rating
FROM garageowner AS g

LEFT JOIN garage_rating AS gr ON g.garage_id = gr.garageId
JOIN location AS l ON g.location = l.id
WHERE g.location = '$location_id'
AND ( 6371 * acos( cos( radians(".$_SESSION['user_latitude'].") ) * cos( radians( g.latitude ) ) 
* cos( radians( g.longitude ) - radians(".$_SESSION['user_longitude'].") ) + sin( radians(".$_SESSION['user_latitude'].") ) * sin( radians( g.latitude ) ) ) ) < 30
GROUP BY g.garage_id
ORDER BY 
CASE WHEN ( 6371 * acos( cos( radians(".$_SESSION['user_latitude'].") ) * cos( radians( g.latitude ) ) 
* cos( radians( g.longitude ) - radians(".$_SESSION['user_longitude'].") ) + sin( radians(".$_SESSION['user_latitude'].") ) * sin( radians( g.latitude ) ) ) ) < 30 THEN 1 ELSE 2 END,
avg_rating DESC
LIMIT 3";


} else {
  
$query = "SELECT g.*, l.location_name, ROUND(AVG(gr.ratingNumber), 1) AS avg_rating
FROM garageowner AS g
JOIN garage_rating AS gr ON g.garage_id = gr.garageId
JOIN location AS l ON g.location = l.id
WHERE g.location = '$location_id'
GROUP BY g.garage_id
ORDER BY avg_rating DESC";

}






$result = $dbhh->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
        ?>  
                <div class="col-list-3">
                    <div class="recent-car-list">
                        <div class="car-info-box">
                            <a href="garage_profile.php?garage_id=<?php echo htmlentities($row['garage_id']); ?>">
                                <img src="garage/image/<?php echo htmlentities($row['Image']); ?>"  class="img-responsive" alt="Garage Image">
                            </a>
                            <ul>
                                <li><i class="fa fa-map-marker" aria-hidden="true"></i><?php echo htmlentities($row['location_name']); ?></li>
                                <li><i class="fa fa-star" aria-hidden="true"></i><?php echo htmlentities($row['avg_rating']); ?>/5</li>
                                <li><i class="fa fa-calendar" aria-hidden="true"></i><?php echo htmlentities($row['years_of_experience']); ?> Years of Experience</li>
                            </ul>
                            
                        </div>
<div class="center-text">
    <a href="garage-details.php?gid='<?php echo htmlentities($row['id']); ?>'" class="btn">send inspection request</a>
</div>                        
                    </div>
                </div>
        <?php
            }
        } else {
            echo "No garages found.";
        }

        // Close database connection
        $dbhh->close();
        ?>

    </div>
</div>

  </div>
 
</section>



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

<!--/Register-Form --> 

<!--Forgot-password-Form -->
<?php include('includes/forgotpassword.php');?>
<!-- Scripts --> 
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script> 
<script src="assets/js/interface.js"></script> 
<!--Switcher-->
<script src="assets/switcher/js/switcher.js"></script>
<!--bootstrap-slider-JS--> 
<script src="assets/js/bootstrap-slider.min.js"></script> 
<!--Slider-JS--> 
<script src="assets/js/slick.min.js"></script> 
<script src="assets/js/owl.carousel.min.js"></script>
</body>
</html>
<?php } ?>