<?php
session_start();
error_reporting(0);
include('includes/configtwo.php');
if(strlen($_SESSION['login']) == 0) { 
    header('location:index.php');
} else {
    if(isset($_POST['addpreference'])) {
        $brand = $_POST['brandname'];
        $userid = $_SESSION['id'];
        $useremail = $_SESSION['login'];
        $userphone = mysqli_real_escape_string($dbhh, $_POST['phone']);
        $query = "SELECT ContactNo, EmailId FROM tblusers WHERE ID = $userid";
        $result4 = $dbhh->query($query);
        if ($result4->num_rows > 0) {
            while($row = $result4->fetch_assoc()) {
                $userphone = $row['ContactNo'];
                $useremail = $row['EmailId'];
                // Add quotes around values in SQL query
                $sql = "UPDATE `pereference` SET `brand` = '$brand', `phone` = '$userphone' WHERE `email` = '$useremail' ";
                $result = $dbhh->query($sql);
                if($result) {
                    $msg= 'Preference updated successfully';
                } else {
                    $msg= 'Error updating preference';
                }
            }
        } else {
            echo 'No user found';
        }
    }

?>
  <!DOCTYPE HTML>
<html lang="en">
<head>

<title>Auto car rental and sales | My Profile</title>
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
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/images/favicon-icon/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/images/favicon-icon/apple-touch-icon-114-precomposed.html">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/images/favicon-icon/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="assets/images/favicon-icon/apple-touch-icon-57-precomposed.png">
<link rel="shortcut icon" href="assets/images/favicon-icon/auto.png">
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet"> 
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

.my_vehicle_lists {
  margin: 0 auto;
  padding: 0;
}


.my_vehicle_lists ul.vehicle_listing {
  padding: 0;
  margin: 0;
}

/* Individual vehicle listing item */
.my_vehicle_lists ul.vehicle_listing li {
  list-style: none;
  border-bottom: 1px solid #e6e6e6;
  padding: 20px 0;
  overflow: hidden;
  position: relative;
}

/* Floating container for vehicle image */
.vehicle_img {
  float: left;
  margin-right: 20px;
  width: 25%;
}

/* Styling for vehicle images */
.vehicle_img img {
  max-width: 100%;
}

/* Anchor tag styling for vehicle details */
.my_vehicle_lists ul.vehicle_listing li a {
  color: #111;
}

/* Container for vehicle title */
.vehicle_title {
  float: left;
  padding: 12px 0;
  width: 50%;
}

.vehicle_statu {
    margin-top: 10px; /* Adjust the top margin as needed */
}

.remove-preference-btn {
    display: inline-block;
    padding: 5px 10px;
    font-size: 14px;
    font-weight: bold;
    text-decoration: none;
    color: #d9534f; /* Button color for removal action */
    border: 2px solid #d9534f; /* Button border color */
    border-radius: 5px; /* Button border radius */
    transition: all 0.3s ease;
}

.remove-preference-btn:hover {
    color: #c9302c; /* Button color on hover */
    border-color: #c9302c; /* Button border color on hover */
}

.remove-preference-btn i {
    margin-right: 5px; /* Adjust the spacing between the icon and the text */
}

.clearfix {
    clear: both;
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
<section class="page-header profile_page">
  <div class="container">
    <div class="page-header_wrap">
      <div class="page-heading">
        <h1>Your Profile</h1>
      </div>
      <ul class="coustom-breadcrumb">
        <li><a href="#">Home</a></li>
        <li>Pereference</li>
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
  { ?>
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
                    <span class="detail-value"><?php echo htmlentities($result->FullName);?></span>
                </div>
                <div class="user-detail">
                    <span class="detail-label">Address:</span>
                    <span class="detail-value"><?php echo htmlentities($result->Address);?></span>
                </div>
                <div class="user-detail">
                    <span class="detail-label">City:</span>
                    <span class="detail-value"><?php echo htmlentities($result->City);?></span>
                </div>
                <div class="user-detail">
                    <span class="detail-label">Country:</span>
                    <span class="detail-value"><?php echo htmlentities($result->Country);?></span>
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="row">
      <div class="col-md-3 col-sm-3">
        <?php include('includes/sidebar.php');?>
      <div class="col-md-6 col-sm-8">
        <div class="profile_wrap">
          <h5 class="uppercase underline">Pereference Settings</h5>
          <?php  
         if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>

          <form  method="post">
     <?php   $id = $_SESSION['id']; 
$sql_preference = "SELECT pereference.Brand, tblbrands.BrandName, tblbrands.id 
                   FROM tblbrands 
                   LEFT JOIN pereference ON pereference.Brand = tblbrands.id 
                   WHERE pereference.userid = $id";
$result_preference = $dbhh->query($sql_preference);
$current_preference = null;
if ($result_preference) {
    $row_preference = $result_preference->fetch_assoc();
    $current_preference = $row_preference['Brand'];
}
?>

<div class="form-group">
    <label class="control-label">Brand of the vehicle</label>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <select class="selectpicker" name="brandname">
            <?php
            // Retrieve available brands
            $sql_brands = "SELECT id, BrandName FROM tblbrands";
            $result_brands = $dbhh->query($sql_brands);
            if ($result_brands) {
                while ($row_brand = $result_brands->fetch_assoc()) {
                    $brand_id = $row_brand['id'];
                    $brand_name = $row_brand['BrandName'];
                    // Display each brand as an option
                    echo '<option value="' . $brand_id . '"';
                    // If this brand is the user's current preference, mark it as selected
                    if ($current_preference == $brand_id) {
                        echo ' selected';
                    }
                    echo '>' . htmlentities($brand_name) . '</option>';
                }
            }
            ?>
        </select>
            </div>
            <?php }
 }
           ?>
           
            <div class="form-group">
              <button type="submit" name="addpreference" class="btn">update preference <span class="angle_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></button>
            </div>
          </form>
          
        </div>
        <!-- this is were the matching result will be jelese -->
        <h5 class="uppercase underline">mactching results for your pereferance</h5>
        <div class="my_vehicle_lists">
            <ul class="vehicle_listing">
<?php
//first job lets get the id of the logged in user from the session
$id=$_SESSION['id'];
//than we will use four tables 1. pereferance 2. tblbrands 3. tblvehicles 4. tblusers
//first we will join these four tables
$sql_join = "SELECT 
    u.id AS user_id,
    u.FullName,
    u.EmailId,
    u.ContactNo,
    p.id AS pereference_id,
    p.Brand,
    p.phone,
    p.email,
    p.userid AS pereference_userid,
    p.status AS pereference_status,
    v.id AS vehicle_id,
    v.status As vehicle_status,
    v.VehiclesTitle,
    v.VehiclesBrand,
    v.userid AS vehicle_userid,
    v.status AS vehicle_status,
    v.Vimage1,
    v.RegDate,
    b.id AS brand_id,
    b.BrandName 
FROM 
    pereference p 
JOIN 
    tblbrands b ON p.Brand = b.id 
JOIN 
    tblvehicles v ON p.Brand = v.VehiclesBrand
JOIN 
    tblusers u ON v.userid = u.id
WHERE 
    p.userid = $id AND v.userid!=$id AND v.status = 1
ORDER BY 
    RegDate DESC"; 

//aye ene gobez eko negn lol next we will execure the query 
$joined_result=$dbhh->query($sql_join);
if($joined_result){
    while($row = $joined_result->fetch_assoc()){
            $brand = $row['BrandName'];
            $userid=$row['userid'];
            $email=$row['EmailId'];//this is the person that is selling the vehicle
            $phone=$row['ContactNo'];//this is the phonw number of the person that is selling the vehicle
            $vehicleTitle=$row['VehiclesTitle'];//this is the vehicle title
            $image=$row['Vimage1'];//this is the vehicle title
            $vehicleid=$row['vehicle_id'];//this is the vehicle id
            $date=$row['RegDate'];
            ?>
            <li>
            <div class="vehicle_img">
                <a href="vehical-details.php?vhid=<?php echo $vehicleid; ?>">
                    <img src="admin/img/vehicleimages/<?php echo $image; ?>" alt="image">
                </a>
            </div>
            <div class="vehicle_title">
                <h6>
                    <a href="vehical-details.php?vhid=<?php echo $vehicleid; ?>">
                        <?php echo  $brand ?>, <?php echo $vehicleTitle ?>
                    </a>
                </h6>
                <p><b>Posted date:</b> <?php echo $date; ?> </p>
                <!-- You should define where the message is coming from -->
                <div style="float: left"><p><b>email:</b> <?php echo $email; ?> </p></div>
                <div style="float: left"><p><b> phone:</b> <?php echo $phone; ?> </p></div>
            </div>

            <div class="vehicle_statu">
            <a href="#" class="btn outline btn-xs active-btn remove-preference-btn">
                 <i class="fas fa-times"></i> Remove
                  </a>

            </div>
        </li>
        <hr />
        <?php        
        
       
    }
}
?>
         </ul>
            
        </div>
      </div>
    </div>
  </div>
</section>
<!--/Profile-setting--> 

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
<!--/Forgot-password-Form --> 

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
<?php }
 ?>