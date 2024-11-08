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
if(isset($_POST['updateprofile']))
  {
$name=$_POST['fullname'];
$mobileno=$_POST['mobilenumber'];
$dob=$_POST['dob'];
$adress=$_POST['address'];
$city=$_POST['city'];
$country=$_POST['country'];
$email=$_SESSION['login'];
$photo = $_FILES['photo']['name'];
// Check if file was uploaded without errors
if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){
    $image = "users/img/" . $_FILES["photo"]["name"];
    move_uploaded_file($_FILES["photo"]["tmp_name"], $image);
} else {
    // Handle the file upload error here
    $image = ""; // Assign an empty string or handle it as needed
}
$sql = "UPDATE tblusers SET FullName='$name', ContactNo='$mobileno', dob='$dob', Address='$adress', City='$city', Country='$country', Photo='$image' WHERE EmailId='$email'";
if ($dbhh->query($sql) === TRUE) {
    $msg="Profile Updated Successfully";
} else {
    echo "Error updating record: " . $dbhh->error;
}
}

?>
  <!DOCTYPE HTML>
<html lang="en">
<head>

<title>Auto car rental and sales | My Profile</title>
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
  .upload_user_logo {
  float: left;
  position: relative;
  width: 20%;
  padding: auto;
}
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
    object-fit: cover;
}

.col-md-8 {
    width: calc(100% - 120px); 
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
/* for google translator */

.VIpgJd-ZVi9od-ORHb-OEVmcd {
        display: none;
      }
      
      .goog-te-gadget img {
        display: none !important;
      }
      .goog-te-combo {
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 14px;
        background-color: #fff;
        color: #333;
      }
      /* Style the dropdown arrow */
      .goog-te-combo-arrow {
        display: none; /* Hide the default dropdown arrow */
      }
      /* Style the language options */
      .goog-te-menu-value {
        font-size: 14px;
        color: #333;
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
        <li>Profile</li>
      </ul>
    </div>
  </div>
  <!-- Dark Overlay-->
  <div class="dark-overlay"></div>
</section>
<!-- /Page Header--> 

<?php 
$useremail=$_SESSION['login'];
$sql = "SELECT * from tblusers where EmailId=:useremail";
$query = $dbh -> prepare($sql);
$query -> bindParam(':useremail',$useremail, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{ ?>
<section class="user_profile inner_pages">
  <div class="container">
  <div class="user_profile_info gray-bg padding_4x4_40">
  <div class="upload_user_logo">
    <?php 
        if(empty($result->photo)) {
    ?>
            <img src="profile.png" alt="Default Profile Image">
    <?php 
        } else {
    ?>
            <img src="<?php echo htmlentities($result->photo); ?>" alt="User Profile Image">
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
            </div>
        </div>
    </div>
</div>

    <div class="row">
      <div class="col-md-3 col-sm-3">
        <?php include('includes/sidebar.php');?>
      <div class="col-md-6 col-sm-8">
        <div class="profile_wrap">
          <h5 class="uppercase underline">Genral Settings</h5>
          <?php  
         if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
          <form  method="post" enctype="multipart/form-data">
           <div class="form-group">
              <label class="control-label">Reg Date -</label>
             <?php echo htmlentities($result->RegDate);?>
            </div>
             <?php if($result->UpdationDate!=""){?>
            <div class="form-group">
              <label class="control-label">Last Update at  -</label>
             <?php echo htmlentities($result->UpdationDate);?>
            </div>
            <?php } ?>
            <div class="form-group">
              <label class="control-label">Full Name</label>
              <input class="form-control white_bg" name="fullname" value="<?php echo htmlentities($result->FullName);?>" id="fullname" type="text"  required>
            </div>
            <div class="form-group">
              <label class="control-label">Email Address</label>
              <input class="form-control white_bg" value="<?php echo htmlentities($result->EmailId);?>" name="emailid" id="email" type="email" required readonly>
            </div>
            <div class="form-group">
              <label class="control-label">Phone Number</label>
              <input class="form-control white_bg" name="mobilenumber" value="<?php echo htmlentities($result->ContactNo);?>" id="phone-number" type="text" required>
            </div>
            <div class="form-group">
              <label class="control-label">Date of Birth&nbsp;(dd/mm/yyyy)</label>
              <input class="form-control white_bg" value="<?php echo htmlentities($result->dob);?>" name="dob" placeholder="dd/mm/yyyy" id="birth-date" type="text" >
            </div>
            <div class="form-group">
              <label class="control-label">Your Address</label>
              <textarea class="form-control white_bg" name="address" rows="4" ><?php echo htmlentities($result->Address);?></textarea>
            </div>
            <div class="form-group">
            <label class="control-label">Photo</label>
            <?php if($result->Photo != null): ?>
                <img src="<?php echo ($result->Photo); ?>" alt="User Photo">
            <?php else: ?>
                <input class="form-control white_bg" name="photo" type="file" accept="image/*">
            <?php endif; ?>
            </div>
            <div class="form-group">
              <label class="control-label">City</label>
              <input class="form-control white_bg" id="city" name="city" value="<?php echo htmlentities($result->City);?>" type="text">
            </div>
            <?php }} ?>
           
            <div class="form-group">
              <button type="submit" name="updateprofile" class="btn">Save Changes <span class="angle_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></button>
            </div>
          </form>
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
<script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement(
          {
            pageLanguage: "en",
            includedLanguages: "am,en",
            layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
            autoDisplay: false,
          },
          "google_translate_element"
        );

        // Ensure the specific paragraph always displays in English
        var englishParagraph = document.getElementById("english_paragraph");
        if (englishParagraph) {
            var notranslateElements = englishParagraph.getElementsByClassName("notranslate");
            for (var i = 0; i < notranslateElements.length; i++) {
                notranslateElements[i].setAttribute("translate", "no");
            }
        }
    }
</script>
<script
    type="text/javascript"
    src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"
></script>

</body>
</html>
<?php } ?>