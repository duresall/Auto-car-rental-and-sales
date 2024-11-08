<?php 
session_start();
include('includes/configtwo.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);
if(isset($_POST['submit'])) {
    $fromdate = $_POST['fromdate'];
    $todate = $_POST['todate'];
    $message = $_POST['message'];
    $useremail = $_SESSION['login'];
    $status = 0;
    $vhid = $_GET['vhid'];
    $bookingno = mt_rand(100000000, 999999999);
  // Check connection
    if ($dbhh->connect_error) {
        die("Connection failed: " . $dbhh->connect_error);
    }

    $ret = "SELECT * FROM tblbooking WHERE ('$fromdate' BETWEEN DATE(FromDate) AND DATE(ToDate) OR '$todate' BETWEEN DATE(FromDate) AND DATE(ToDate) OR DATE(FromDate) BETWEEN '$fromdate' AND '$todate') AND VehicleId='$vhid'";
    $result1 = $dbhh->query($ret);

    if ($result1->num_rows == 0) {
        $sql = "INSERT INTO tblbooking(BookingNumber, userEmail, VehicleId, FromDate, ToDate, message, Status) VALUES('$bookingno','$useremail','$vhid','$fromdate','$todate','$message','$status')";
        if ($dbhh->query($sql) === TRUE) {
            echo "<script>alert('Booking successful.');</script>";
            echo "<script type='text/javascript'> document.location = 'my-booking.php'; </script>";
        } else {
            echo "<script>alert('Something went wrong. Please try again');</script>";
            echo "<script type='text/javascript'> document.location = 'car-listing.php'; </script>";
        }
    } else {
        echo "<script>alert('Car already booked for these days');</script>";
        echo "<script type='text/javascript'> document.location = 'car-listing.php'; </script>";
    }

}
?>

<!DOCTYPE HTML>
<html lang="en">
<head>

<title>Car Rental | Vehicle Details</title>
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
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/images/favicon-icon/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/images/favicon-icon/apple-touch-icon-114-precomposed.html">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/images/favicon-icon/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="assets/images/favicon-icon/apple-touch-icon-57-precomposed.png">
<link rel="shortcut icon" href="assets/images/favicon-icon/favicon.png">
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
</head>
<body>

<!-- Start Switcher -->
<?php include('includes/colorswitcher.php');?>
<!-- /Switcher -->  

<!--Header-->
<?php include('includes/header.php');?>
<!-- /Header --> 

<!--Listing-Image-Slider-->

<?php 


$vhid=intval($_GET['vhid']);
$sql = "SELECT tblvehicles.*,tblbrands.BrandName,tblbrands.id as bid  from tblvehicles join tblbrands on tblbrands.id=tblvehicles.VehiclesBrand where tblvehicles.id='$vhid'";
$result=$dbhh->query($sql);
$cnt=1;
if($result->num_rows > 0)
{
while($row=$result->fetch_assoc())
{  
$_SESSION['brndid']=$row['bid'];  
?>  
<section id="listing_img_slider">
  <div><img src="admin/img/vehicleimages/<?php echo htmlentities($row['Vimage1']);?>" class="img-responsive" alt="image" width="900" height="560"></div>
  <div><img src="admin/img/vehicleimages/<?php echo htmlentities($row['Vimage2']);?>" class="img-responsive" alt="image" width="900" height="560"></div>
  <div><img src="admin/img/vehicleimages/<?php echo htmlentities($row['Vimage3']);?>" class="img-responsive" alt="image" width="900" height="560"></div>
  <div><img src="admin/img/vehicleimages/<?php echo htmlentities($row['Vimage4']);?>" class="img-responsive"  alt="image" width="900" height="560"></div>
  <?php if($row['Vimage5']=="")
{
} else {
  ?>
  <div><img src="admin/img/vehicleimages/<?php echo htmlentities($row['Vimage5']);?>" class="img-responsive" alt="image" width="900" height="560"></div>
  <?php } ?>
</section>
<!--/Listing-Image-Slider-->


<!--Listing-detail-->
<section class="listing-detail">
  <div class="container">
    <div class="listing_detail_head row">
      <div class="col-md-9">
        <h2><?php echo htmlentities($row['BrandName']);?> , <?php echo htmlentities($row['VehiclesTitle']);?></h2>
      </div>
      <div class="col-md-3">
        <div class="price_info">
          <p><?php echo htmlentities($row['PricePerDay']);?> </p>birr
         
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-9">
        <div class="main_features">
          <ul>
            <li> <i class="fa fa-calendar" aria-hidden="true"></i>
              <h5><?php echo htmlentities($row['ModelYear']);?></h5>
              <p>Reg.Year</p>
            </li>
            <li> <i class="fa fa-cogs" aria-hidden="true"></i>
              <h5><?php echo htmlentities($row['FuelType']);?></h5>
              <p>Fuel Type</p>
            </li>
       
            <li> <i class="fa fa-user-plus" aria-hidden="true"></i>
              <h5><?php echo htmlentities($row['SeatingCapacity']);?></h5>
              <p>Seats</p>
            </li>
          </ul>
        </div>

        <div class="listing_more_info">
          <div class="listing_detail_wrap"> 
            <!-- Nav tabs -->
            <ul class="nav nav-tabs gray-bg" role="tablist">
              <li role="presentation" class="active"><a href="#vehicle-overview " aria-controls="vehicle-overview" role="tab" data-toggle="tab">Vehicle Overview </a></li>
              <li role="presentation"><a href="#accessories" aria-controls="accessories" role="tab" data-toggle="tab">Accessories</a></li>
              <li role="presentation" ><a href="#inspected_Garage" aria-controls="inspected_Garage" role="tab" data-toggle="tab">inspected Garage</a></li>
              <?php if($_SESSION['login']) { ?>
                     <li role="presentation"><a href="#inspected_Garage" aria-controls="inspected_Garage" role="tab" data-toggle="tab">user contact information</a></li>
                 <?php } else { ?>
                     <li ><a href="#loginform" data-toggle="modal">Login to for information</a></li>
                 <?php } ?>
            </ul>      
            <!-- Tab panes -->
            <div class="tab-content"> 
              <!-- vehicle-overview -->
              <div role="tabpanel" class="tab-pane active" id="vehicle-overview">
                <p><?php echo htmlentities($result->VehiclesOverview);?></p>
              </div>

                  <!-- Accessories -->
                <div role="tabpanel" class="tab-pane" id="accessories"> 
                <table>
                  <thead>
                    <tr>
                      <th colspan="2">Accessories</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Air Conditioner</td>
                       <?php if($row['AirConditioner']==1)
                      {
                          ?>
                      <td><i class="fa fa-check" aria-hidden="true"></i></td>
                      <?php } else { ?> 
                      <td><i class="fa fa-close" aria-hidden="true"></i></td>
                      <?php } ?> </tr>

                      <tr>
                      <td>AntiLock Braking System</td>
                      <?php if($row['AntiLockBrakingSystem']==1)
                      {
                       ?>
                      <td><i class="fa fa-check" aria-hidden="true"></i></td>
                      <?php } else {?>
                      <td><i class="fa fa-close" aria-hidden="true"></i></td>
                      <?php } ?>
                      </tr>
                      <tr>
                         <td>Power Steering</td>
                         <?php if($row['PowerSteering']==1)
                            {
                                  ?>
                                <td><i class="fa fa-check" aria-hidden="true"></i></td>
                             <?php } else { ?>
                              <td><i class="fa fa-close" aria-hidden="true"></i></td>
                             <?php } ?>
                                </tr>
                                   <tr>
                                      <td>Power Windows</td>

                                   <?php if($row['PowerWindows']==1)
                                       {
                                        ?>
                                   <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                   <?php } else { ?>
                                   <td><i class="fa fa-close" aria-hidden="true"></i></td>
                                   <?php } ?>
                                   </tr>
                                                      
                                    <tr>
                                   <td>CD Player</td>
                                   <?php if($row['CDPlayer']==1)
                                   {
                                   ?>
                                   <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                   <?php } else { ?>
                                   <td><i class="fa fa-close" aria-hidden="true"></i></td>
                                   <?php } ?>
                                   </tr>
                                   
                                   <tr>
                                   <td>Leather Seats</td>
                                   <?php if($row['LeatherSeats']==1)
                                   {
                                   ?>
                                   <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                   <?php } else { ?>
                                   <td><i class="fa fa-close" aria-hidden="true"></i></td>
                                   <?php } ?>
                                   </tr>
                                   
                                   <tr>
                                   <td>Central Locking</td>
                                   <?php if($row['CentralLocking']==1)
                                   {
                                   ?>
                                   <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                   <?php } else { ?>
                                   <td><i class="fa fa-close" aria-hidden="true"></i></td>
                                   <?php } ?>
                                   </tr>
                                   
                                   <tr>
                                   <td>Power Door Locks</td>
                                   <?php if($row['PowerDoorLocks']==1)
                                   {
                                   ?>
                                   <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                   <?php } else { ?>
                                   <td><i class="fa fa-close" aria-hidden="true"></i></td>
                                   <?php } ?>
                                                       </tr>
                                                       <tr>
                                   <td>Brake Assist</td>
                                   <?php if($row['BrakeAssist']==1)
                                   {
                                   ?>
                                   <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                   <?php  } else { ?>
                                   <td><i class="fa fa-close" aria-hidden="true"></i></td>
                                   <?php } ?>
                                   </tr>
                                   
                                   <tr>
                                   <td>Driver Airbag</td>
                                   <?php if($row['DriverAirbag']==1)
                                   {
                                   ?>
                                   <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                   <?php } else { ?>
                                   <td><i class="fa fa-close" aria-hidden="true"></i></td>
                                   <?php } ?>
                                    </tr>
                                    
                                    <tr>
                                    <td>Passenger Airbag</td>
                                    <?php if($row['PassengerAirbag']==1)
                                   {
                                   ?>
                                   <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                   <?php } else {?>
                                   <td><i class="fa fa-close" aria-hidden="true"></i></td>
                                   <?php } ?>
                                   </tr>
                                   <tr>
                                   <td>Crash Sensor</td>
                                   <?php if($row['CrashSensor']==1)
                                   {
                                   ?>
                                   <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                   <?php } else { ?>
                                   <td><i class="fa fa-close" aria-hidden="true"></i></td>
                                   <?php } ?>
                                   </tr>
                      </tbody>
                </table>
          </div>
              <!--added for the garage integration part-->
              <div role="tabpanel" class="tab-pane " id="inspected_Garage">
                <h6>the video display of the car</h6>
               <?php

 $data=$row['url'];
  $final=str_replace('watch?v=','embed/',$data);

       echo '<iframe width="560" height="315" src="'.$final.'"
      title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
               ?>
              </div>
            </div>
          </div>
          
        </div>
<?php }} ?>
   
      </div>
      
      <!--Side-Bar-->
      <aside class="col-md-3">
      
        <div class="share_vehicle">
          <p>inquery section </p>
        </div>
        <div class="sidebar_widget">
          <div class="widget_heading">

            <h5><i class="fa fa-envelope" aria-hidden="true"></i>Book Now</h5>
          </div>
          <form method="post">
            <div class="form-group">
              <label>From Date:</label>
              <input type="date" class="form-control" name="fromdate" placeholder="From Date" required>
            </div>
            <div class="form-group">
              <label>To Date:</label>
              <input type="date" class="form-control" name="todate" placeholder="To Date" required>
            </div>
            <div class="form-group">
              <textarea rows="4" class="form-control" name="message" placeholder="Message" required></textarea>
            </div>

          <?php if($_SESSION['login']){?>
              <div class="form-group">
                <input type="submit" class="btn"  name="submit" value="Book Now">
              </div>
              <?php } else { ?>
<a href="#loginform" class="btn btn-xs uppercase" data-toggle="modal" data-dismiss="modal">Login For Book</a>

              <?php } ?>
          </form>
        </div>
      </aside>
      <!--/Side-Bar--> 
    </div>
    
    <div class="space-20"></div>
    <div class="divider"></div>
    
    <!--Similar-Cars-->
    <div class="similar_cars">
      <h3>Similar Cars</h3>
      <div class="row">
<?php 
$bid=$_SESSION['brndid'];
$sql="SELECT tblvehicles.VehiclesTitle,tblbrands.BrandName,tblvehicles.PricePerDay,tblvehicles.FuelType,tblvehicles.ModelYear,tblvehicles.id,tblvehicles.SeatingCapacity,tblvehicles.VehiclesOverview,tblvehicles.Vimage1 from tblvehicles join tblbrands on tblbrands.id=tblvehicles.VehiclesBrand where tblvehicles.VehiclesBrand='$bid'";
$result1=$dbhh->query($sql);
$cnt=1;
if($result1->num_rows() > 0)
{
while($row1=$result->fetch_assoc())
{ ?>      
        <div class="col-md-3 grid_listing">
          <div class="product-listing-m gray-bg">
            <div class="product-listing-img"> <a href="vehical-details.php?vhid=<?php echo htmlentities($row1['id']);?>"><img src="admin/img/vehicleimages/<?php echo htmlentities($row1['Vimage1']);?>" class="img-responsive" alt="image" /> </a>
            </div>
            <div class="product-listing-content">
              <h5><a href="detail_edited.php?vhid=<?php echo htmlentities($row1['id']);?>"><?php echo htmlentities($row1['BrandName']);?> , <?php echo htmlentities($row1['VehiclesTitle']);?></a></h5>
              <p class="list-price"><?php echo htmlentities($row1['PricePerDay']);?>/birr</p>
          
              <ul class="features_list">
                
             <li><i class="fa fa-user" aria-hidden="true"></i><?php echo htmlentities($row1['SeatingCapacity']);?> seats</li>
                <li><i class="fa fa-calendar" aria-hidden="true"></i><?php echo htmlentities($row1['ModelYear']);?> model</li>
                <li><i class="fa fa-car" aria-hidden="true"></i><?php echo htmlentities($row1['FuelType']);?></li>
              </ul>
            </div>
          </div>
        </div>
 <?php }} ?>       

      </div>
    </div>
    <!--/Similar-Cars--> 
    
  </div>
</section>
<!--/Listing-detail--> 

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
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script> 
<script src="assets/js/interface.js"></script> 
<script src="assets/switcher/js/switcher.js"></script>
<script src="assets/js/bootstrap-slider.min.js"></script> 
<script src="assets/js/slick.min.js"></script> 
<script src="assets/js/owl.carousel.min.js"></script>
</body>
</html>