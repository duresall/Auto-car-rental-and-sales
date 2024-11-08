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

.accordion {
    margin-top: 20px;
}

.card-link {
    color: #333;
    font-weight: 600;
}

.card-link:hover {
    color: #007bff;
    text-decoration: none;
}
#garageImage {
    border-radius: 50%; /* make it circular */
    border: 4px solid #fff; /* add a border */
    width: 200px; /* adjust the size as needed */
    height: 200px;
    object-fit: cover; /* ensure the image covers the container */
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
  
  <div id="garageInfo" class="accordion mt-3">
    <div class="card">
      <div class="card-header">
        <a class="card-link" data-toggle="collapse" href="#rating">
          Rating
        </a>
      </div>
      <div id="rating" class="collapse" data-parent="#garageInfo">
    <div class="card-body">
        <div class="rating">
           
                <!--end of the rating section -->
                <span>&#9733; &#9733; &#9733; &#9733; &#9734;</span>
                <p>3 reviews</p>
                <a href="#" >See more reviews</a>
            </div>
        </div>
    </div>
</div>

    <div class="card">
      <div class="card-header">
        <a class="collapsed card-link" data-toggle="collapse" href="#certificates">
          Certificates
        </a>
      </div>
      <div id="certificates" class="collapse" data-parent="#garageInfo">
        <div class="card-body">
          <!-- Add certificate images here -->
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header">
        <a class="collapsed card-link" data-toggle="collapse" href="#contact">
          Contact Information
        </a>
      </div>
      <div id="contact" class="collapse" data-parent="#garageInfo">
        <div class="card-body">
          <!-- Add contact information here -->
        </div>
      </div>
    </div>
  </div>
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
<!--Switcher-->
<script src="assets/switcher/js/switcher.js"></script>
<!--bootstrap-slider-JS--> 
<script src="assets/js/bootstrap-slider.min.js"></script> 
<!--Slider-JS--> 
<script src="assets/js/slick.min.js"></script> 
<script src="assets/js/owl.carousel.min.js"></script>
</body>
</html>
