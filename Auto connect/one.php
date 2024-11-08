<?php 
session_start();
include('includes/config.php');
error_reporting(0);

?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<title>Auto car rental and sales | Vehicle Details</title>
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
<link rel="shortcut icon" href="assets/images/favicon-icon/auto.png">
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
<style>
  /* Responsive PDF container */
.responsive-pdf-container {
    position: relative;
    width: 100%;
    overflow: hidden;
    padding-top: 56.25%; /* 16:9 aspect ratio for responsive iframe */
    margin-bottom: 20px; /* Add space between elements */
}

.responsive-pdf-container iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}

/* Responsive images */
.img-responsive {
    max-width: 100%;
    height: auto;
}
/*  */
  #listing_img_slider {
    display: flex;
    flex-wrap: nowrap;
    overflow-x: auto;
    margin: 0;
    padding: 0;
    -webkit-overflow-scrolling: touch; /* For smooth scrolling on iOS */
  }
  
  #listing_img_slider > div {
    margin: 0;
    padding: 0;
  }

  .custom-image {
    width: 500px;
    height: 250px;
  }
  .rounded-icon {
        width: 30px;
        height: 30px;
        background-color: #007BFF; /* Change the background color as needed */
        border-radius: 50%;
        display: inline-flex; /* Use inline-flex to make the icon and text inline */
        justify-content: center;
        align-items: center;
        margin-left: 10px; /* Adjust margin as needed */
    }

    .rounded-icon i {
        color: #fff; /* Change the icon color as needed */
        font-size: 16px; /* Adjust the icon size as needed */
    }
.video-container {
            position: relative;
            padding-bottom: 56.25%; /* 16:9 aspect ratio */
            padding-top: 25px;
            height: 0;
        }
        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 80%;
            height: 80%;
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

<!--Listing-Image-Slider-->

<?php 

$vhid=intval($_GET['vhid']);

$sql = "SELECT 
tblvehicles.VehiclesTitle,
tblvehicles.Price,
tblvehicles.url,
tblvehicles.Vimage1,
tblvehicles.Vimage2,
tblvehicles.Vimage3,
tblvehicles.Vimage4,
tblvehicles.FuelType AS fuel_type,
tblvehicles.ModelYear AS model_year,
tblvehicles.SeatingCapacity AS seating_capacity,
tblvehicles.VehiclesBrand AS vehicle_brand,
tblvehicles.inspection,  -- Ensure 'inspection' column is included
tblbrands.BrandName,
tblbrands.id AS bid,
vi_inner.*
FROM 
tblvehicles 
JOIN 
tblbrands ON tblbrands.id = tblvehicles.VehiclesBrand
JOIN 
(SELECT * FROM vehicle_inspections vi2 
WHERE vi2.inspection_date = (SELECT MAX(vi1.inspection_date) 
FROM vehicle_inspections vi1 
WHERE vi1.vehicle_id = vi2.vehicle_id)) vi_inner 
ON vi_inner.vehicle_id = tblvehicles.id 
WHERE 
tblvehicles.id = '$vhid'
";

$result=$dbhh->query($sql);
$cnt=1;
if($result->num_rows > 0)
{
$row=$result->fetch_assoc();
{  
$_SESSION['brndid']=$row['bid'];  
?>  
<section id="listing_img_slider">
  <div><img src="admin/img/vehicleimages/<?php echo htmlentities($row['Vimage1']);?>" class="custom-image" alt="image"></div>
  <div><img src="admin/img/vehicleimages/<?php echo htmlentities($row['Vimage2']);?>" class="custom-image" alt="image"></div>
  <div><img src="admin/img/vehicleimages/<?php echo htmlentities($row['Vimage3']);?>" class="custom-image" alt="image"></div>
  <div><img src="admin/img/vehicleimages/<?php echo htmlentities($row['Vimage4']);?>" class="custom-image" alt="image"></div>
  <?php if($row['Vimage5']!="") { ?>
    <div><img src="admin/img/vehicleimages/<?php echo htmlentities($row['Vimage5']);?>" class="custom-image" alt="image"></div>
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
          <p><?php echo number_format(($row['Price']));?> ETB</p> 
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-9">
        <div class="main_features">
          <ul>
            <li> <i class="fa fa-calendar" aria-hidden="true"></i>
              <h5><?php echo htmlentities($row['model_year']);?></h5>
              <p>Reg.Year</p>
            </li>
            <li> <i class="fa fa-cogs" aria-hidden="true"></i>
              <h5><?php echo htmlentities($row['fuel_type']);?></h5>
              <p>Fuel Type</p>
            </li>
       
            <li> <i class="fa fa-user-plus" aria-hidden="true"></i>
              <h5><?php echo htmlentities($row['seating_capacity']);?></h5>
              <p>Seats</p>
            </li>
          <!-- adding for milage -->
          <li> <i class="fa fa-tachometer" aria-hidden="true"></i>
              <h5><?php echo htmlentities($row['milage']);?></h5>
              <p>Mileage</p>
            </li>
          </ul>
        </div>

        <div class="listing_more_info">
          <div class="listing_detail_wrap"> 
            <!-- Nav tabs -->
            <ul class="nav nav-tabs gray-bg" role="tablist">
              
              <?php
             
            if($row['inspection']==1){
            ?>
              <li role="presentation" class="active"><a href="#vehicle-overview" aria-controls="vehicle-overview" role="tab" data-toggle="tab">Vehicle Overview </a></li>
              <li role="presentation"><a href="#accessories" aria-controls="accessories" role="tab" data-toggle="tab">Accessories</a></li>
              <?php
              }
              ?>
              <li role="presentation" ><a href="#video" aria-controls="video" role="tab" data-toggle="tab">video dispaly</a></li>
              <?php if($_SESSION['login']) { ?>
                     <li role="presentation"><a href="#contact_info" aria-controls="contact_info" role="tab" data-toggle="tab">user contact information</a></li>
                 <?php } else { ?>
                     <li ><a href="#loginform" data-toggle="modal">Login for seller information</a></li>
                 <?php } ?>
            </ul>
            <div class="tab-content">
              <!-- this is vhicles overview section  -->
              <div role="tabpanel" class="tab-pane active" id="vehicle-overview">
              <?php 
                       if($row['inspection']==1){

                        ?>
                             <table>
                                <thead>
                                  <tr>
                                    <th colspan="2">Vehicle condition</th>
                                  </tr>
                                </thead>
                                <tbody>        
                    
                         <!-- ADDITIONAL INFOMATIONS -->

                              <!-- FOR TRANSMITION  -->
                                   <tr>
                                   <td>Transmition</td>
                                   <?php if($row['transmition']==1)
                                   {
                                   ?>
                                   <td><i class="fa fa-close" aria-hidden="true"></i> Bad</td>
                                   <?php } else if($row['transmition']==2)
                                   {
                                   ?>
                                   <td><i class="fa fa-check" aria-hidden="true"></i> Good</td>
                                   <?php } else if($row['transmition']==3)
                                   {
                                   ?>
                                   <td><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Moderate</td>
                                   <?php } else if($row['transmition']==4){
                                   ?>
                                   <td><i class="fa fa-star" aria-hidden="true"></i> Excellent</td>
                                       <?php } ?>
                                   </tr>
                                  
                              <!-- END for TRANSMITION  -->
                              <!-- FOR EXUSION SYSTEM  -->
                                   <tr> 
                                   <td>Exusion System</td>
                                   <?php if($row['exhustion']==1)
                                   {
                                   ?>
                                   <td><i class="fa fa-close" aria-hidden="true"></i> Severe Rust</td>
                                   <?php } else if($row['exhustion']==2)
                                   {
                                   ?>
                                   <td><i class="fa fa-check" aria-hidden="true"></i> Moderate Rust</td>
                                   <?php } else if($row['exhustion']==3)
                                   {
                                   ?>
                                   <td><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Minor Rust</td>
                                   <?php } else if($row['exhustion']==4){
                                   ?>
                                   <td><i class="fa fa-star" aria-hidden="true"></i> No Issues</td>
                                       <?php } ?>
                                   </tr>
                                  
                              <!-- END OF EXUSION SYSTEM -->
                              <!-- for tire condition  -->

                              <tr> 
                                   <td>tire Condition</td>
                                   <?php if($row['tireCondition']==1)
                                   {
                                   ?>
                                   <td><i class="fa fa-close" aria-hidden="true"></i> Irreparable Damage</td>
                                   <?php } else if($row['tireCondition']==2)
                                   {
                                   ?>
                                   <td><i class="fa fa-check" aria-hidden="true"></i>Unsafe Condition</td>
                                   <?php } else if($row['tireCondition']==3)
                                   {
                                   ?>
                                   <td><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> In Need of Maintenance</td>
                                   <?php } else if($row['tireCondition']==4){
                                   ?>
                                   <td><i class="fa fa-star" aria-hidden="true"></i> Good Condition</td>
                                       <?php } ?>
                                   </tr>


                              <!--/ end for tire condition  -->
                              <!-- engin condition  -->
                              <tr> 
                                   <td>Engine condition</td>
                                   <?php if($row['enginCondition']==1)
                                   {
                                   ?>
                                   <td><i class="fa fa-close" aria-hidden="true"></i>Critical Condition</td>
                                   <?php } else if($row['enginCondition']==2)
                                   {
                                   ?>
                                   <td><i class="fa fa-check" aria-hidden="true"></i>Requires Repairs</td>
                                   <?php } else if($row['enginCondition']==3)
                                   {
                                   ?>
                                   <td><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> In Need of Maintenance</td>
                                   <?php } else if($row['enginCondition']==4){
                                   ?>
                                   <td><i class="fa fa-star" aria-hidden="true"></i> Good Condition</td>
                                       <?php } ?>
                                   </tr>
                               <!-- /engin condition  -->
                 <!-- Body condition  -->
                 <tr>
                                   <td>Vehicle body condition</td>
                                   <?php if($row['body']==1)
                                   {
                                   ?>
                                   <td><i class="fa fa-close" aria-hidden="true"></i>Severe Dents/Scratches</td>
                                   <?php } else if($row['body']==2)
                                   {
                                   ?>
                                   <td><i class="fa fa-check" aria-hidden="true"></i>Moderate Dents/Scratches</td>
                                   <?php } else if($row['body']==3)
                                   {
                                   ?>
                                   <td><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Minor Dents/Scratches</td>
                                   <?php } else if($row['body']==4){
                                   ?>
                                   <td><i class="fa fa-star" aria-hidden="true"></i> No Issues</td>
                                       <?php } ?>
                                   </tr>
                  <!--/ Body condition  -->

                                 
                      </tbody>
                </table>

                                <!-- TABLE FOR VEHICLE STATUS -->
<?php
                           echo' <h3 style="text-align:center; margin-top:50px;">Vehicle Overview</h3>';
                           echo'<hr>';
                               $overview = $row['vehicleOverview'];
                               $file_extension = pathinfo($overview, PATHINFO_EXTENSION);
                               if ($file_extension == 'pdf') {
                                   echo '<div class="responsive-pdf-container">';
                                   echo '<iframe src="./garage/image/' . $overview . '" frameborder="0"></iframe>';
                                   echo '</div>';
                               } 
                               else if (in_array($file_extension, ['jpg', 'jpeg', 'png', 'gif'])) {
                                   echo '<img src="./garage/image/' . $overview . '" alt="Vehicle Overview" class="img-responsive">';
                               } 
                               else {
                                   echo '<p>' . htmlentities($overview) . '</p>';
                               } 
                               echo '<hr>';
                              
                              
                              
                              // inspector inforamation
                              // garage inspector information 
                     
$garage = $row['garage_id'];

$query1 = "SELECT * FROM garageowner WHERE garage_id= '$garage'";
$answer = $dbhh->query($query1);

if ($answer->num_rows > 0) {
    $row4 = $answer->fetch_assoc();
    $location_id = $row4['Location']; // Correct variable name from $location to $location_id
    $name = $row4['name'];
    $phone = $row4['phone'];
    $garage_id = $row4['garage_id'];

    $query4 = "SELECT location_name FROM location WHERE id='$location_id'"; // Correct variable name from $location to $location_id
    $answer1 = $dbhh->query($query4);

    if ($answer1->num_rows > 0) {
        $row6 = $answer1->fetch_assoc();
        $location_name = $row6['location_name'];

        // Check if image is available, otherwise use a default image
        $image = (!empty($row4['Image'])) ? $row4['Image'] : 'profile.png';

        // Display garage information with image
        echo '<div style="display: flex; flex-direction: column; align-items: center; margin: 20px 0;">';
        echo '<img src="./garage/image/' . $image . '" alt="Garage Image" style="border-radius: 50%; width: 150px; height: 150px; object-fit: cover;">';
        echo '<h4>Vehicle Inspector Garage Information</h4>';
        echo '<p>Garage Name: <a href="garage_profile.php?garage_id=' . $garage_id . '">' . htmlentities($name) . '</a></p>';
        echo '<p>Garage Address: ' . htmlentities($location_name) . '</p>';
        echo '<p>Contact Phone: <a href="tel:' . htmlentities($phone) . '">' . htmlentities($phone) . '</a></p>';
        echo '</div>';
        echo '<hr>';
    }
}
                      // end of the inspectionr information 
                    }         ?>
                                <!-- TABLE FOR VEHICLE STATUS -->                                        
              </div>

              <!-- end of vehicle overview section  -->
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
                      {?>
                      <td><i class="fa fa-check" aria-hidden="true"></i></td>
                      <?php } else { ?>
                      <td><i class="fa fa-close" aria-hidden="true"></i></td>
                      <?php } ?>
                    </tr>

                    <tr>
                      <td>AntiLock Braking System</td>
                      <?php if($row['AntiLockBrakingSystem']==1)
                      {?>
                      <td><i class="fa fa-check" aria-hidden="true"></i></td>
                      <?php } else {?>
                      <td><i class="fa fa-close" aria-hidden="true"></i></td>
                      <?php } ?>
                    </tr>
                    <tr>
                       <td>Power Steering</td>
                       <?php if($row['PowerSteering']==1)
                          {?>
                          <td><i class="fa fa-check" aria-hidden="true"></i></td>
                          <?php } else { ?>
                          <td><i class="fa fa-close" aria-hidden="true"></i></td>
                          <?php } ?>
                    </tr>
                    <tr>
                       <td>Power Windows</td>

                       <?php if($row['PowerWindows']==1)
                          {?>
                       <td><i class="fa fa-check" aria-hidden="true"></i></td>
                       <?php } else { ?>
                       <td><i class="fa fa-close" aria-hidden="true"></i></td>
                       <?php } ?>
                    </tr>
                    <tr>
                      <td>CD Player</td>
                      <?php if($row['CDPlayer']==1)
                      {?>
                      <td><i class="fa fa-check" aria-hidden="true"></i></td>
                      <?php } else { ?>
                      <td><i class="fa fa-close" aria-hidden="true"></i></td>
                      <?php } ?>
                    </tr>
                    <tr>
                      <td>Leather Seats</td>
                      <?php if($row['LeatherSeats']==1)
                      {?>
                      <td><i class="fa fa-check" aria-hidden="true"></i></td>
                      <?php } else { ?>
                      <td><i class="fa fa-close" aria-hidden="true"></i></td>
                      <?php } ?>
                    </tr>
                    <tr>
                      <td>Central Locking</td>
                      <?php if($row['CentralLocking']==1)
                      {?>
                      <td><i class="fa fa-check" aria-hidden="true"></i></td>
                      <?php } else { ?>
                      <td><i class="fa fa-close" aria-hidden="true"></i></td>
                      <?php } ?>
                    </tr>
                    <tr>
                      <td>Power Door Locks</td>
                      <?php if($row['PowerDoorLocks']==1)
                      {?>
                      <td><i class="fa fa-check" aria-hidden="true"></i></td>
                      <?php } else { ?>
                      <td><i class="fa fa-close" aria-hidden="true"></i></td>
                      <?php } ?>
                    </tr>
                    <tr>
                      <td>Brake Assist</td>
                      <?php if($row['BrakeAssist']==1)
                      {?>
                      <td><i class="fa fa-check" aria-hidden="true"></i></td>
                      <?php } else { ?>
                      <td><i class="fa fa-close" aria-hidden="true"></i></td>
                      <?php } ?>
                    </tr>
                    <tr>
                      <td>Driver Airbag</td>
                      <?php if($row['DriverAirbag']==1)
                      {?>
                      <td><i class="fa fa-check" aria-hidden="true"></i></td>
                      <?php } else { ?>
                      <td><i class="fa fa-close" aria-hidden="true"></i></td>
                      <?php } ?>
                    </tr>
                    <tr>
                      <td>Passenger Airbag</td>
                      <?php if($row['PassengerAirbag']==1)
                      {?>
                      <td><i class="fa fa-check" aria-hidden="true"></i></td>
                      <?php } else { ?>
                      <td><i class="fa fa-close" aria-hidden="true"></i></td>
                      <?php } ?>
                    </tr>
                    <tr>
                      <td>Crash Sensor</td>
                      <?php if($row['CrashSensor']==1)
                      {?>
                      <td><i class="fa fa-check" aria-hidden="true"></i></td>
                      <?php } else { ?>
                      <td><i class="fa fa-close" aria-hidden="true"></i></td>
                      <?php } ?>
                    </tr>
                  </tbody>
                </table>
                <?php }} ?>
          </div>
          
              <!--added for the garage integration part-->
                       
 <div role="tabpanel" class="tab-pane" id="video">
                <div class="text-center">
                <h6>Video display of the car</h6>
                </div>
   
    <?php
    $sql3 = "SELECT tblvehicles.url  from tblvehicles  where tblvehicles.id='$vhid'";
$result = $dbhh->query($sql3);
$row1=$result->fetch_assoc();
$data = $row1['url'];
$final = str_replace('watch?v=', 'embed/', $data);

if (empty($data)) {
    echo "
        <div class='text-center'>
    
            <p>A video hasn't been uploaded for this car</p>
        </div>
    ";
} else {
    echo '
        <div class="video-container">
            <iframe src="' . $final . '" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
    ';
}
?>
</div>

<div role="tabpanel" class="tab-pane" id="contact_info">
    <div class="text-center">
        <h6> Seller information</h6>
    </div>
    <hr>
    <?php
    $vhid = intval($_GET['vhid']);
    $sql = "SELECT tblusers.FullName,tblusers.EmailId,tblusers.ContactNo,tblusers.photo,tblusers.id as userid,tblvehicles.* from tblvehicles join tblusers on tblusers.id=tblvehicles.userid where tblvehicles.id='$vhid'";
    $query = $dbhh->query($sql);
    if ($query->num_rows > 0) {
        while ($row3 = $query->fetch_assoc()) {
            $fname = $row3['FullName'];
            $email = $row3['EmailId'];
            $mobile = $row3['ContactNo'];
            $address = $row3['Address'];
            $city = $row3['City'];
            $country = $row3['Country'];
            $image = $row3['photo'];
            $id = $row3['userid'];
    ?>
            <?php 
        if(empty($image)) {
    ?>
                <div style="display: flex; flex-direction: column; align-items: center; margin: 20px 0;">
                <img src="profile.png" alt="Seller Image" style="border-radius: 50%; width: 100px; height: 100px; object-fit: cover;">
                <div style="display: flex; justify-content: center; width: 100%;">
    <?php 
        } else {
    ?>
                            <div style="display: flex; flex-direction: column; align-items: center; margin: 20px 0;">
                              <img src="<?php echo $image; ?>" alt="Seller Image" style="border-radius: 50%; width: 200px; height: 200px; object-fit: cover;">
                                <div style="display: flex; justify-content: center; width: 100%;">
    <?php 
        }
    ?>


<div style="text-align: center; margin-top: 20px;">
    <div class="rounded-icon">
        <i class="fa fa-envelope" aria-hidden="true"></i>
    </div>
    <p class="uppercase_text" style="color: #555; display: inline;">Email: <a href="mailto:<?php echo htmlentities($email); ?>" style="color: #007BFF; text-decoration: none;">
            <?php echo htmlentities($email); ?></a> </p>
</div>
<div style="text-align: center; margin-top: 20px;">
    <div class="rounded-icon">
        <i class="fa fa-phone" aria-hidden="true"></i>
    </div>
    <p class="uppercase_text" style="color: #555; display: inline;">Phone number: <a href="tel:<?php echo htmlentities($mobile); ?>" style="color: #007BFF; text-decoration: none;">
            <?php echo htmlentities($mobile); ?></p>

</div>
                </div>
                <?php
                if ($_SESSION['id'] == $id) {
                ?>
                   <a href="#" class="disabled-link" style="text-decoration: none; color: #aaa; background-color: #eee; padding: 8px 16px; border-radius: 4px; margin-top: 20px; cursor: not-allowed;" disabled>
                   <i class="fa fa-comments" aria-hidden="true"></i> You can't chat with yourself
                   </a>

                <?php } else {
                ?>
                    <a href="chat-area.php?user_id=<?php echo $id; ?>" style="text-decoration: none; color: #fff; background-color: #007BFF; padding: 8px 16px; border-radius: 4px; margin-top: 20px;">
                        <i class="fa fa-comments" aria-hidden="true"></i>Start chat
                    </a>
                <?php
                }
                ?>
            </div>
    <?php
        }
    }
  
    ?>
</div>

   
      </div>
      
      
    </div>
    
    <div class="space-20"></div>
    <div class="divider"></div>
    
    <!--Similar-Cars-->
    <div class="similar_cars">
      <h3>Similar Cars</h3>
      <div class="row">
<?php 
$bid=$_SESSION['brndid'];
$sql = "SELECT tblvehicles.VehiclesTitle, tblbrands.BrandName, tblvehicles.Price, tblvehicles.FuelType, tblvehicles.ModelYear, tblvehicles.id, tblvehicles.SeatingCapacity, tblvehicles.VehiclesOverview, tblvehicles.Vimage1
 from tblvehicles join tblbrands on tblbrands.id=tblvehicles.VehiclesBrand where tblvehicles.VehiclesBrand='$bid' AND tblvehicles.status=1";
$result1=$dbhh->query($sql);
$cnt=1;
if($result1->num_rows > 0)
{
while($row1=$result1->fetch_assoc())
{ ?>      
        <div class="col-md-3 grid_listing">
          <div class="product-listing-m gray-bg">
            <div class="product-listing-img"> <a href="vehical-details.php?vhid=<?php echo htmlentities($row1['id']);?>"><img src="admin/img/vehicleimages/<?php echo htmlentities($row1['Vimage1']);?>" class="img-responsive" alt="image" /> </a>
            </div>
            <div class="product-listing-content">
              <h5><a href="vehical-details.php?vhid=<?php echo htmlentities($row1['id']);?>"><?php echo htmlentities($row1['BrandName']);?> , <?php echo htmlentities($row1['VehiclesTitle']);?></a></h5>
              <p class="list-price"><?php echo number_format(($row1['Price']));?>ETB</p>
          
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
