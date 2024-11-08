<?php

session_start();
include('includes/configtwo.php');
error_reporting(0);
$msg = ""; 
$error = ""; 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extract the form data
    $seller_id=$_POST['userid'];
    $platenumber=$_POST['platenumber'];
    $vehicletitle = $_POST['VehicleTitle'];
    $brandname = $_POST['brandname'];
    $location = $_POST['location'];
    $vehicle_for=$_POST['vehicle_for'];
    $url = $_POST['url'];
    $FuelType=$_POST['FuelType'];
    $price=$_POST['price'];
    $modelyear = $_POST['modelyear'];
    $seatingcapacity = $_POST['seatingcapacity'];
    $image1=$_FILES['img1']['name'];
    $image2 = $_FILES["img2"]["name"];
    $image3 = $_FILES["img3"]["name"];
    $image4 = $_FILES["img4"]["name"];
    $image5 = $_FILES["img5"]["name"];
    // File paths
    $vimage1 = "admin/img/vehicleimages/" . $_FILES["img1"]["name"];
    $vimage2 = "admin/img/vehicleimages/" . $_FILES["img2"]["name"];
    $vimage3 = "admin/img/vehicleimages/" . $_FILES["img3"]["name"];
    $vimage4 = "admin/img/vehicleimages/" . $_FILES["img4"]["name"];
    $vimage5 = "admin/img/vehicleimages/" . $_FILES["img5"]["name"];
    move_uploaded_file($_FILES["img1"]["tmp_name"], $vimage1);
    move_uploaded_file($_FILES["img2"]["tmp_name"], $vimage2);
    move_uploaded_file($_FILES["img3"]["tmp_name"], $vimage3);
    move_uploaded_file($_FILES["img4"]["tmp_name"], $vimage4);
    move_uploaded_file($_FILES["img5"]["tmp_name"], $vimage5);

//getting the location of the mekina to match with the existing garage 
$query = "SELECT l.id, COUNT(*) AS count FROM location l WHERE l.location_name = '$location'";
$result = $dbhh->query($query);
$row1 = $result->fetch_assoc();

if ($row1['count'] > 0) {
    $garageCount = $row1['count'];
    $location_id = $row1['id'];
    $sql = "INSERT INTO `tblvehicles`( `VehiclesTitle`,`plate_number`, `VehiclesBrand`, `location`, `Price`, `FuelType`, `ModelYear`, `SeatingCapacity`, `userid`, `url`,vehicle_for,
    `Vimage1`, `Vimage2`, `Vimage3`, `Vimage4`, `Vimage5` ) VALUES ('$vehicletitle','$platenumber','$brandname','$location','$price','$FuelType','$modelyear','$seatingcapacity','$seller_id','$url','$vehicle_for',
    '$image1','$image2','$image3','$image4','$image5')";
   if ($dbhh->query($sql) === TRUE) {
       $msg = "Vehicle posted successfully. It will be listed shortly.";
       $_SESSION['msg'] = $msg;
       if ($garageCount > 0) {
           $redirectUrl = "garageLocation.php?id=" . urlencode($location_id);
           header("Location: $redirectUrl");
           exit(); 
       } 
   } else {
       $error = "Something went wrong while posting the vehicle. Please try again.";
       $_SESSION['error'] = $error;
   } 
} else {
    $location = $_POST['location'];
    $sql = "INSERT INTO `tblvehicles`( `VehiclesTitle`,`plate_number`, `VehiclesBrand`, `location`, `Price`, `FuelType`, `ModelYear`, `SeatingCapacity`, `userid`, `url`,
     `Vimage1`, `Vimage2`, `Vimage3`, `Vimage4`, `Vimage5` ) VALUES ('$vehicletitle','$platenumber','$brandname','$location','$price','$FuelType','$modelyear','$seatingcapacity','$seller_id','$url',
     '$image1','$image2','$image3','$image4','$image5')";
    if ($dbhh->query($sql) === TRUE) {
        $msg = "Vehicle posted successfully. It will be listed shortly.";
        $_SESSION['msg'] = $msg;
        if ($garageCount > 0) {
            $redirectUrl = "garageLocation.php?id=" . urlencode($location_id);
            header("Location: $redirectUrl");
            exit(); 
        } 
    } else {
        $error = "Something went wrong while posting the vehicle. Please try again.";
        $_SESSION['error'] = $error;
    }
}   
}
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<title>Auto car rental and sales || List your car</title>
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
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
 <style>
    .error {
        color: red;
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
/* Add your custom CSS styles here */

/* Style for form labels */
.form-group label {
    font-weight: bold;
}

/* Style for form inputs */
.form-group {
        padding-left: 10px; /* Adjust padding as needed */
        padding-right: 10px; /* Adjust padding as needed */
    }

    .form-group label {
        margin-bottom: 0; /* Remove margin below labels */
    }

    .form-group .form-control {
        margin-bottom: 10px; /* Adjust spacing between input fields */
    }
/* Style for select dropdown */
.selectpicker {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    margin-bottom: 10px;
}


/* Style for form buttons */
.btn {
    padding: 10px 20px;
    background-color: #007bff; /* Bootstrap primary color */
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.btn:hover {
    background-color: #0056b3; /* Darker shade of primary color on hover */
}

/* Additional styling can be added as needed */
/* for google translation */
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
<?php include('includes/headers.php');?>
<!-- /Header --> 
<!--Page Header-->
<section class="page-header contactus_page">
  <div class="container">
    <div class="page-header_wrap">
      <div class="page-heading">
        <h1>List Your Vehicle</h1>
      </div>
      <ul class="coustom-breadcrumb">
        <li><a href="index.php">Home</a></li>
        <li>List Your Vehicle</li>
      </ul>
    </div>
  </div>
  <!-- Dark Overlay-->
  <div class="dark-overlay"></div>
</section>
<!-- /Page Header--> 

<section class="post_vehicle section-padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 offset-md-2 text-center">
                <h5>You can post your vehicle using the form below</h5>
                <?php if(isset($_SESSION['msg'])): ?>
                    <div class="succWrap" id="responseMessage"><strong>SUCCESS</strong>: <?php echo htmlentities($_SESSION['msg']); ?> 
                    <span id="countdown" style="display:none">5</span>
                    <script>
                    setTimeout(function(){
                        document.getElementById("responseMessage").style.display = "none";
                    }, 5000);
                    setTimeout(function(){
                        var i = document.getElementById("countdown");
                        if (parseInt(i.innerHTML) === 0) {
                            i.style.display = "none";
                        } else {
                            i.innerHTML = parseInt(i.innerHTML) - 1;
                        }
                        setTimeout(arguments.callee, 1000);
                    }, 1000);
                    </script>
                    </div>
                    <?php unset($_SESSION['msg']); ?>
                <?php endif; ?>

                <?php if(isset($_SESSION['error'])): ?>
                    <div class="errorWrap" id="responseMessage"><strong>ERROR</strong>: <?php echo htmlentities($_SESSION['error']); ?> </div>
                    <?php unset($_SESSION['error']); ?>
                <?php endif; ?>
                
                <div class="contact_form gray-bg">


<!-- for submitin from  -->


<form  id="form" name="form" action="" method="post" class="form-horizontal" enctype="multipart/form-data">
                        <div class="panel panel-default">
                            <div class="panel-heading">Basic Info</div>
                            <div class="panel-body">
                        


<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label class="control-label" >Vehicle plate number<span style="color:red">*</span></label>
            <input type="text" name="platenumber" class="form-control" id="platenumber" onBlur="platenumbers()">
            <span id="plate-number-validation" style="font-size:12px;"></span> 
            <div class="error"></div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label class="control-label">Select Brand<span style="color:red">*</span></label>
            <select class="selectpicker" name="brandname" id="brandname">
                                <option value=""> Select </option>
                                <?php 
                                    $ret="select id,BrandName from tblbrands";
                                    $query= $dbh -> prepare($ret);
                                    $query-> execute();
                                    $results = $query -> fetchAll(PDO::FETCH_OBJ);
                                    if($query -> rowCount() > 0) {
                                        foreach($results as $result) {
                                ?>
                                <option value="<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->BrandName);?></option>
                                <?php 
                                        } 
                                    } 
                                ?>
                            </select>
            <div class="error"></div>
        </div>
    </div>
</div>

<div class="row ">
    <div class="col-sm-6">
        <div class="form-group">
            <label class="control-label">Vehicle Title<span style="color:red">*</span></label>
            <input type="text" name="VehicleTitle" class="form-control" id="VehicleTitle">
            <div class="error"></div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label class="control-label">Vehicle for<span style="color:red">*</span></label>
            <select class="selectpicker" name="vehicle_for" id="vehicle_for">
                                <option value="">Select</option>
                                <option value="sale ">Sale </option>
                                <option value="rent">Rent</option>
                            </select>
            <div class="error"></div>
        </div>
    </div>
</div>

<!-- next -->
<div class="row ">
<div class="col-sm-6">
        <div class="form-group">
           <label class="control-label">Seating Capacity<span style="color:red">*</span></label>
            <input type="number" name="seatingcapacity" class="form-control" id="seatingcapacity">
            <div class="error"></div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
        <label  class="control-label"> Model Year<span style="color:red">*</span></label>
        <select class="selectpicker" name="modelyear" id="modelyear">
            <option value="">Select</option>
            <?php
            for($i=2000; $i<=2024; $i++){
            ?>
            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
            <?php
            }
            ?>
        </select>
       <div class="error"></div>
        </div>
    </div>
</div>
<!-- next -->
<div class="row ">
<div class="col-sm-6">
        <div class="form-group">
           <label class="control-label">Youtube link<span style="color:red">*</span></label>
            <input type="text" name="url" class="form-control" placeholder="optional">
            <div class="error"></div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
        <label class="control-label">Fule Type<span style="color:red">*</span></label>
            <select class="selectpicker" name="FuelType" id="FuelType">
                                <option value="">Select</option>
                                <option value="Pertrol ">petrol </option>
                                <option value="Deiesel">desile</option>
                            </select>
                            <div class="error"></div>
        </div>
    </div>
</div>
<!-- NEXT -->
<div class="row ">
    <div class="col-sm-6">
        <div class="form-group">
        <label  class="control-label"> Location<span style="color:red">*</span></label>
        <input type="text" name="location" class="form-control" id="location" list="locationList">
       <datalist id="locationList"></datalist>
       <div class="error"></div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
           <label class="control-label">price<span style="color:red">*</span></label>
            <input type="number" name="price" class="form-control" id="price">
            <div class="error"></div>
        </div>
    </div>
</div>
                           
<!-- Continue adding pairs of form groups in the same pattern -->


                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <h4><b>Upload Images</b></h4>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-4">
                                        Image 1 <span style="color:red">*</span><input type="file" name="img1" id="img1">
                                        <div class="error"></div>
                                    </div>
                                    <div class="col-sm-4">
                                        Image 2 <span style="color:red">*</span><input type="file" name="img2" id="img2">
                                        <div class="error"></div>
                                    </div>
                                    <div class="col-sm-4">
                                        Image 3 <span style="color:red">*</span><input type="file" name="img3" id="img3">
                                        <div class="error"></div>
                                    </div>
                                    <div class="col-sm-4">
                                        Image 4 <span style="color:red">*</span><input type="file" name="img4" id="img4">
                                        <div class="error"></div>
                                    </div>
                                    <div class="col-sm-4">
                                        Image 5 <input type="file" name="img5">
                                    </div>
                                </div>

                                <?php if(isset($_SESSION['id'])) { 
                                    $seller_id = $_SESSION['id'];
                                ?>
                                <input type="hidden" name="userid" value="<?= $seller_id ?>">
                                <?php } ?>

                                <div class="hr-dashed"></div>

                                <div class="form-group">
                                    <div class="col-sm-6 col-sm-offset-2">
                                        <?php if($_SESSION['login']) { ?>
                                            <button id="saveChangesBtn" class="btn btn-primary" name="submit" type="submit">Post</button>
                                        <?php } else { ?>
                                            <a href="#loginform" class="btn btn-xs uppercase" data-toggle="modal" data-dismiss="modal">Login to submit</a> 
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>



<!-- END  for submitin from  -->

                </div>
            </div>
        </div>
    </div>
</section>



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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

<script src="assets/js/bootstrap.min.js"></script> 
<script src="assets/js/interface.js"></script> 
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
        url: "./users/action/platenumbers.php",
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

<script>
$(document).ready(function () {
  // Initialize form validation
  $("#form").validate({
    // Define rules for form fields
    rules: {
      platenumber: { required: true },
      VehicleTitle: { required: true, pattern: /^[a-zA-Z\s]+$/ },
      brandname: { required: true },
      location: { required: true },
      price: { required: true, number: true },
      modelyear: { required: true, number: true },
      seatingcapacity: { required: true },
      mileage: { required: true },
      vehicle_for: { required: true },
      FuelType: { required: true },
      img1: { required: true },
      img2: { required: true },
      img3: { required: true },
      img4: { required: true }
    },
    // Define error messages
    messages: {
      // Add custom error messages if needed
    },
    // Handle error placement
    errorPlacement: function (error, element) {
      element.closest(".form-group").find(".error").empty().append(error.addClass("error-message"));
    },
    // Handle field highlighting
    highlight: function (element) {
      $(element).closest(".form-group").removeClass("has-success").addClass("has-error");
    },
    // Handle field unhighlighting
    unhighlight: function (element) {
      $(element).closest(".form-group").removeClass("has-error").addClass("has-success");
    }
  });

  // Trigger validation on blur event for input and select fields
  $("#form input, #form select").on("keyup blur", function () {
    $(this).valid();
  });

  // Validate individual fields on blur event
  $("#platenumber, #VehicleTitle, #brandname, #location, #price, #modelyear, #seatingcapacity, #vehicle_for, #FuelType, #img1, #img2, #img3, #img4").on("blur", function () {
    $(this).valid();
  });

  // Handle form submission
  $("#saveChangesBtn").click(function (event) {
    // Prevent form submission if it's not valid
    if (!$("#form").valid()) {
      event.preventDefault();
    } else {
      // Form is valid, proceed with action
      console.log("Save changes button clicked");
    }
  });
});

   
</script>

<script>
$(document).ready(function(){
    $('#location').keyup(function(){
        var query = $(this).val();
        if(query !== ''){
            $.ajax({
                url: 'search_location.php', // URL of your backend service to fetch location suggestions
                method: 'POST',
                data: {query: query},
                success: function(data){
                    $('#locationList').html(data); // Update the datalist with suggestions
                }
            });
        }
    });
});
</script> 


</body>
</body>
</html>














