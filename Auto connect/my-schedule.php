<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/configtwo.php');
if(strlen($_SESSION['login'])==0)
  { 
header('location:index.php');
}
else{
?><!DOCTYPE HTML>
<html lang="en">
<head>

<title>Auto car rental and sales  - My appointment</title>
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
<!-- Fav and touch icons -->
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/images/favicon-icon/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/images/favicon-icon/apple-touch-icon-114-precomposed.html">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/images/favicon-icon/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="assets/images/favicon-icon/apple-touch-icon-57-precomposed.png">
<link rel="shortcut icon" href="assets/images/favicon-icon/auto.png">
<!-- Google-Font-->
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]--> 
<style>
  .user_profile_info {
    border: 1px solid #ccc;
    border-radius: 8px;
    padding: 20px;
    display: flex;
    align-items: center;
}

.upload_user_logo img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    margin-right: 20px;
}

.col-md-8 {
    width: calc(100% - 120px); /* Adjust width based on the image size */
}

.dealer_info {
    padding: 10px;
}

.uppercase {
    text-transform: uppercase;
}

.underline {
    text-decoration: underline;
}

.user-details {
    display: flex;
    flex-direction: column;
}

.user-detail {
    margin-bottom: 10px;
}

.detail-label {
    font-weight: bold;
    margin-right: 5px;
}

.detail-value {
    color: #333;
    font-weight: bold;
}
</style> 
</head>
<body>

<!-- Start Switcher -->
<?php include('includes/colorswitcher.php');?>
<!-- /Switcher -->  
        
<!--Header-->
<?php include('includes/header.php');?>
<!--Page Header-->
<!-- /Header --> 

<!--Page Header-->
<section class="page-header profile_page">
  <div class="container">
    <div class="page-header_wrap">
      <div class="page-heading">
        <h1>My schedule</h1>
      </div>
      <ul class="coustom-breadcrumb">
        <li><a href="#">Home</a></li>
        <li>My schedule</li>
      </ul>
    </div>
  </div>
  <!-- Dark Overlay-->
  <div class="dark-overlay"></div>
</section>
<!-- /Page Header--> 

<?php 
$id=$_SESSION['id'];
$sql2 = "SELECT * from tblusers where id=$id";
$result2=$dbhh->query($sql2);
if($result2->num_rows > 0){
$cnt=1;
while($row2 = $result2->fetch_assoc()) 
  {
 ?>
<section class="user_profile inner_pages">
  <div class="container">
  <div class="user_profile_info gray-bg padding_4x4_40">
    <div class="upload_user_logo">
        <?php 
        if(empty($row2['photo'])) {
    ?>
            <img src="profile.png" alt="Default Profile Image">
    <?php 
        } else {
    ?>
            <img src="<?php echo htmlentities($row2['photo']); ?>" alt="User Profile Image">
    <?php 
        }
    ?>
    </div>
    <div class="col-md-8">
        <div class="dealer_info">
            <h6 class="uppercase underline">User Information</h6>
            <div class="user-details">
                <div class="user-detail">
                    <span class="detail-label">Full Name:</span>
                    <span class="detail-value"><?php echo htmlentities($row2['FullName']);?></span>
                </div>
                <div class="user-detail">
                    <span class="detail-label">Address:</span>
                    <span class="detail-value"><?php echo htmlentities($row2['Address']) ?></span>
                </div>
                <div class="user-detail">
                    <span class="detail-label">City:</span>
                    <span class="detail-value"><?php echo htmlentities($row2['City']);?></span>
                </div>
                <?php
  }
}
    ?>
            </div>
        </div>
    </div>
</div>
    <div class="row">
      <div class="col-md-3 col-sm-3">
       <?php include('includes/sidebar.php');?>
      <div class="col-md-6 col-sm-6">                                    
                <h3>My Appointments</h3>
    <ul class="appointment-list">
        <?php
        // Fetch appointments
        $id = $_SESSION['id'];

        $sql = "SELECT s.*, v.Vimage1,v.VehiclesTitle,g.name,tblbrands.BrandName,v.id as vhid FROM schedule s 
        INNER JOIN tblvehicles v ON s.vid = v.plate_number 
        INNER JOIN garageowner g ON s.garageid = g.garage_id
        INNER JOIN tblbrands ON v.VehiclesBrand = tblbrands.id
        WHERE s.userid = '$id' ORDER BY s.id DESC";

        
        $result = mysqli_query($dbhh, $sql);
        if (mysqli_num_rows($result) > 0) {
            $count = mysqli_num_rows($result);
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <li class="<?php if($count > 1){echo 'clearfix';}?>">
                    <div class="vehicle_img"> <a href="vehical-details.php?vhid=<?php echo htmlentities($result->vid);?>"><img src="admin/img/vehicleimages/<?php echo htmlentities($row['Vimage1']);?>" alt="image"></a> </div>
                    <div class="vehicle_title">
                      <h6><a href="vehical-details.php?vhid=<?php echo htmlentities($row['vhid']);?>"> <?php echo htmlentities($row['BrandName']);?> , <?php echo htmlentities($row['VehiclesTitle']);?></a></h6>
                      <p>Appointment sent to: <a href="garage_profile.php?garage_id=<?php echo htmlentities($row['garageid']);?>"><?php echo htmlentities($row['name']); ?></a></p>
                      <?php
                     if($row['appointment_date'] != ''){ 
                        ?>
                      <p>Schduled for date: <?php echo date('F d, Y', strtotime($row['appointment_date'])); ?></p>

                        <?php
                     }
                     ?>
                    </div>  
                    <?php if($row['status']==1)
                            { ?>
                            <div class="vehicle_status">
                                <a href="#" class="btn outline btn-xs active-btn">Confirmed</a>
                                <div class="clearfix"></div>
                            </div>
                                  <?php } else if($row['status']==2) { ?>
                     <div class="vehicle_status">
                        <a href="#" class="btn outline btn-xs">Cancelled</a>
                        <div class="clearfix"></div>
                    </div>

                            <?php } else { ?>
                     <div class="vehicle_status">
                        <a href="#" class="btn outline btn-xs">Not Confirm yet</a>
                        <div class="clearfix"></div>
                    </div>
                            <?php } ?>
                </li>
                <?php
                $count--;
            }
        } else {
            echo "<p>No appointments found.</p>";
        }
        ?>
    </ul>
</div>
     </div>
  </div>
</section>
<!--/my-vehicles--> 
<?php include('includes/footer.php');?>
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