<?php 
session_start();
include('includes/config.php');
include('includes/configtwo.php');
error_reporting(0);
?>  

<!DOCTYPE HTML>
<html lang="en">
<head>

<title>Car Rental Portal | Car Listing</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--Bootstrap -->
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

<!--Listing-->
<section class="listing-page">
  <div class="container">
    <div class="row">
      <div class="col-md-9 col-md-push-3">
        <div class="result-sorting-wrapper">
          <div class="sorting-count">
<?php 

//Query for Listing count
$brand=$_POST['brand'];
$fueltype=$_POST['fueltype'];

$location=$_POST['location'];



$sql = "SELECT id from tblvehicles where tblvehicles.VehiclesBrand=:brand and tblvehicles.FuelType=:fueltype and (tblvehicles.location IN (SELECT id FROM location WHERE location_name = :location) OR tblvehicles.location = :location)";
$query = $dbh -> prepare($sql);
$query -> bindParam(':brand',$brand, PDO::PARAM_STR);
$query -> bindParam(':fueltype',$fueltype, PDO::PARAM_STR);
$query -> bindParam(':location',$location, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=$query->rowCount();
?>
<p><span><?php echo htmlentities($cnt);?> Listings</span></p>
</div>
</div>

<?php 

$sql1 = "SELECT v.*, b.BrandName, b.id AS bid  
        FROM tblvehicles v
        JOIN tblbrands b ON b.id = v.VehiclesBrand 
        WHERE v.VehiclesBrand = :brand 
        AND v.FuelType = :fueltype 
        AND v.Status = 1
        AND (
            (SELECT COUNT(*) FROM location WHERE location_name = :location AND id = CAST(v.location AS UNSIGNED)) > 0
            OR 
            (SELECT COUNT(*) FROM location WHERE location_name = :location AND id = CAST(v.location AS CHAR)) > 0
        )";
$query1 = $dbh->prepare($sql1);
$query1->bindParam(':brand', $brand, PDO::PARAM_STR);
$query1->bindParam(':fueltype', $fueltype, PDO::PARAM_STR);
$query1->bindParam(':location', $location, PDO::PARAM_STR);
$query1->execute();
$results = $query1->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{  ?>
        <div class="product-listing-m gray-bg">
          <div class="product-listing-img"><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage1);?>" class="img-responsive" alt="Image" /> </a> 
          </div>
          <div class="product-listing-content">
            <h5><a href="vehical-details.php?vhid=<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->BrandName);?> , <?php echo htmlentities($result->VehiclesTitle);?></a></h5>
            <p class="list-price"> <?php echo htmlentities($result->Price);?> birr</p>
            <ul>
              <li><i class="fa fa-user" aria-hidden="true"></i><?php echo htmlentities($result->SeatingCapacity);?> seats</li>
              <li><i class="fa fa-calendar" aria-hidden="true"></i><?php echo htmlentities($result->ModelYear);?> model</li>
              <li><i class="fa fa-car" aria-hidden="true"></i><?php echo htmlentities($result->FuelType);?></li>

<?php

$locationplace=$result->location;
if(is_numeric($locationplace))
{
    $sql2 = "SELECT location_name FROM location WHERE id = :location";
    $query2 = $dbh->prepare($sql2);
    $query2->bindParam(':location', $locationplace, PDO::PARAM_STR);
    $query2->execute();
    $results2 = $query2->fetchAll(PDO::FETCH_OBJ);
    $locationplace=$results2[0]->location_name;
}
?>


              <li><i class="fa fa-map-marker" aria-hidden="true"></i><?php echo htmlentities($locationplace);?></li>
            </ul>
            <a href="vehical-details.php?vhid=<?php echo htmlentities($result->id);?>" class="btn">View Details <span class="angle_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></a>
          </div>
        </div>
      <?php }
      } ?>
         </div>
      
      <!--Side-Bar-->
      <aside class="col-md-3 col-md-pull-9">
        <div class="sidebar_widget">
          <div class="widget_heading">
            <h5><i class="fa fa-filter" aria-hidden="true"></i> Find Your  Car </h5>
          </div>
          <div class="sidebar_filter">
            <form action="search-carresult.php" method="post">
              <div class="form-group select">
                <select class="form-control" name="brand">
                  <option>Select Brand</option>

                  <?php $sql = "SELECT * from  tblbrands ";
                         $query = $dbh -> prepare($sql);
                         $query->execute();
                         $results=$query->fetchAll(PDO::FETCH_OBJ);
                         $cnt=1;
                         if($query->rowCount() > 0)
                         {
                         foreach($results as $result)
                         {       ?>  
                         <option value="<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->BrandName);?></option>
                         <?php }} ?>
                 
                </select>
              </div>
              <div class="form-group select">
                <select class="form-control" name="fueltype">
                  <option>Select Fuel Type</option>
                    <option value="Petrol">Petrol</option>
                    <option value="Diesel">Diesel</option>
                    <option value="CNG">CNG</option>
                </select>
              </div>
              <div class="form-group select">
                <select class="form-control" name="location">
                <option>Select your desired location</option>
                <?php
                  $sql1 = "SELECT IF(tblvehicles.location REGEXP '^[0-9]+$',(SELECT location_name FROM location WHERE id=tblvehicles.location),tblvehicles.location) as Location, tblvehicles.location FROM tblvehicles WHERE Vehicle_for IN ('sale', 'rent') GROUP BY Location ORDER BY Location";
                                 $query1 = $dbh -> prepare($sql1);
                                 $query1->execute();
                                 $results=$query1->fetchAll(PDO::FETCH_OBJ);
                                 $cnt=1;
                                 if($query1->rowCount() > 0)
                                 {
                                  foreach($results as $result)
                                  {       ?>  
                                  <option value="<?php echo htmlentities($result->Location);?>"><?php echo htmlentities($result->Location);?> </option>
                                  <?php }} ?>
                </select>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-block"><i class="fa fa-search" aria-hidden="true"></i> Search Car</button>
              </div>
            </form>
          </div>
        </div>

        <div class="sidebar_widget">
          <div class="widget_heading">
            <h5><i class="fa fa-car" aria-hidden="true"></i> Recently Listed Cars</h5>
          </div>
          <div class="recent_addedcars">
            <ul>
                    <?php $sql = "SELECT tblvehicles.*, tblbrands.BrandName, tblbrands.id as bid  
                        FROM tblvehicles 
                        JOIN tblbrands ON tblbrands.id = tblvehicles.VehiclesBrand 
                        WHERE tblvehicles.Status = 1 
                        ORDER BY tblvehicles.id DESC 
                        LIMIT 4";
                    $query = $dbh -> prepare($sql);
                    $query->execute();
                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                    $cnt=1;
                    if($query->rowCount() > 0)
                    {
                    foreach($results as $result)
                    {  ?>

              <li class="gray-bg">
                <div class="recent_post_img"> <a href="vehical-details.php?vhid=<?php echo htmlentities($result->id);?>"><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage1);?>" alt="image"></a> </div>
                <div class="recent_post_title"> <a href="vehical-details.php?vhid=<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->BrandName);?> , <?php echo htmlentities($result->VehiclesTitle);?></a>
                  <p class="widget_price"> <?php echo htmlentities($result->Price);?> birr</p>
                </div>
              </li>
              <?php }} ?>
              
            </ul>
          </div>
        </div>
      </aside>
      <!--/Side-Bar--> 
    </div>
  </div>
</section>
<!-- /Listing--> 

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
