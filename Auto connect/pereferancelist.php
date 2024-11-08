
<?php 
session_start();
include('includes/config.php');
include('includes/configtwo.php');
error_reporting(0);

?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<title>Auto car rental and sales</title>

<!--Bootstrap -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="assets/css/style.css" type="text/css">
<link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
<link rel="stylesheet" href="assets/css/owl.transitions.css" type="text/css">
<link href="assets/css/slick.css" rel="stylesheet">
<link href="assets/css/bootstrap-slider.min.css" rel="stylesheet">
<link href="assets/css/font-awesome.min.css" rel="stylesheet">
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
.navigation-list ul {
    list-style-type: none;
    padding: 0;
}

.navigation-list li {
    display: inline-block;
    margin-right: 20px;
}

.car-container {
    overflow-x: auto;
    white-space: nowrap;
    padding: 10px 0;
}

.car-items {
    display: inline-block;
    margin-right: 20px;
    width: 250px; /* Adjust width as needed */
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 10px;
    text-align: center;
    background-color: #f9f9f9;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.car-items img {
    width: 100%;
    border-radius: 5px;
}

.car-items h3 {
    margin-top: 10px;
    font-size: 18px;
}

.car-items p {
    margin-top: 5px;
    font-size: 14px;
    color: #666;
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

@media (max-width: 768px) {
    .car-item {
        width: calc(50% - 20px); /* Adjust margins for two items per row */
    }
}

@media (max-width: 540px) {
    .car-item {
        width: calc(100% - 20px); /* Adjust margins for single item per row */
    }
}
.pagination {
        margin-top: 20px;
        text-align: center;
    }
    .pagination a {
        color: #333;
        padding: 8px 16px;
        text-decoration: none;
        transition: background-color .3s;
        border: 1px solid #ddd;
        margin: 0 4px;
    }
    .pagination a.active {
        background-color: #4CAF50;
        color: white;
    }
    .pagination a:hover:not(.active) {background-color: #ddd;}
    #no-filter-found-message {
    display: none;
    padding: 10px;
    color: black;
    margin-top: 20px;
}
.featured-badge {
    position: absolute;
    top: 1px;                   
    right: 1px;               
    background-color: #2E8BC0; 
    color: black;           
    padding: 5px 10px;   
    border-radius: 5px;        
    font-size: 12px; 
    font-weight: bold; 
  }
  .filter-button + .filter-button {
   margin-left: 10px;
   margin-top: 3px;
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

<!-- Resent Car -->
<section class="section-padding gray-bg">
  <div class="container">
    <div class="section-header text-center">
      <h2>Find the Best <span>CarForYou</span></h2>
    </div>
    <div class="row"> 
      
      <!-- Filter buttons -->
      <div class="text-center">
        <button class="btn btn-default filter-button" data-filter="all">All</button>
        <button class="btn btn-default filter-button" data-filter="Petrol">Petrol</button>
        <button class="btn btn-default filter-button" data-filter="Diesel">Diesel</button>
        <button class="btn btn-default filter-button" data-filter="Electric">Electric</button>  
        <button class="btn btn-default filter-button" data-filter="rent">for rent</button>
        <button class="btn btn-default filter-button" data-filter="sales">for sales</button>
      </div>
      <!-- Car listings -->
      <div class="row" id="car-listings">
        <?php 
          // Define pagination variables
          $results_per_page = 6;
          $page = isset($_GET['page']) ? $_GET['page'] : 1;
          $offset = ($page - 1) * $results_per_page;

          // Fetch data from the database with pagination
          $sql = "SELECT tblvehicles.VehiclesTitle, tblbrands.BrandName,tblvehicles.status, tblvehicles.Price, tblvehicles.FuelType, tblvehicles.Vehicle_for, tblvehicles.ModelYear, tblvehicles.id,tblvehicles.garageId, tblvehicles.SeatingCapacity, tblvehicles.inspection, tblvehicles.VehiclesOverview, tblvehicles.Vimage1 FROM tblvehicles JOIN tblbrands ON tblbrands.id = tblvehicles.VehiclesBrand LIMIT $offset, $results_per_page";
          $query = $dbh->prepare($sql);
          $query->execute();
          $results = $query->fetchAll(PDO::FETCH_OBJ);
          $cnt = 1;
          if($query->rowCount() > 0) {
            foreach($results as $result) {  

              if($result->status=='1'){
        ?>  
            
            <div class="col-md-4 col-sm-6 col-xs-12 car-item" 
     data-category="<?php echo htmlentities($result->FuelType . ' ' . $result->Vehicle_for); ?>">

          <div class="recent-car-list">
            <div class="car-info-box"> 
              <a href="vehical-details.php?vhid=<?php echo htmlentities($result->id); ?>">
                         <div class="position-relative">
                         <img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage1); ?>"  class="img-responsive" alt="image">
                        <?php if ($result->inspection != 1) {
                        echo '<span class="featured-badge">uninspected</span>';
                    }elseif($result->inspection == 1){
                        echo '<span class="featured-badge">Inspected</span>';
                    }
                    ?>
                  </div>
              </a>
              <ul>
                <li><i class="fa fa-car" aria-hidden="true"></i><?php echo htmlentities($result->FuelType); ?></li>
                <li><i class="fa fa-calendar" aria-hidden="true"></i><?php echo htmlentities($result->ModelYear); ?> Model</li>
                <li><i class="fa fa-user" aria-hidden="true"></i><?php echo htmlentities($result->SeatingCapacity); ?> seats</li>
              </ul>
            </div>
            <div class="car-title-m">
              <h6><a href="vehical-details.php?vhid=<?php echo htmlentities($result->id); ?>"><?php echo htmlentities($result->VehiclesTitle); ?></a></h6>
              <span class="price">Price: <?php echo htmlentities($result->Price); ?> birr</span> 
            </div>
            <div class="inventory_info_m">
         
            </div>
          </div>
        </div>
        <?php
              } 
            }
          }
        ?>
      </div>
      <div class="text-center">
      <div id="no-vehicle-found-message" style="display: none;">No filters found</div>
      </div>
      <!-- Pagination Links -->
      <div class="pagination">
    <?php
    // Fetch total records for pagination
    $sql = "SELECT COUNT(*) AS total FROM tblvehicles WHERE status = 1";
    $query = $dbh->prepare($sql);
    $query->execute();
    $row = $query->fetch(PDO::FETCH_ASSOC);
    $total_pages = ceil($row["total"] / $results_per_page);

    if ($page > 1) {
        echo "<a href='?page=".($page-1)."'>Previous</a>";
    }

    for ($i = 1; $i <= $total_pages; $i++) {
        echo "<a href='?page=$i'";
        if ($i == $page) {
            echo " class='active'";
        }
        echo ">$i</a>";
    }
    if ($page < $total_pages) {
        echo "<a href='?page=".($page+1)."'>Next</a>";
    }
    ?>
</div>
    </div>
  </div>
</section>
<!--Testimonial -->
<section class="section-padding testimonial-section parallex-bg">
  <div class="container div_zindex">
    <div class="section-header white-text text-center">
      <h2>Our Satisfied <span>Customers</span></h2>
    </div>
    <div class="row">
      <div id="testimonial-slider">
<?php
$tid = 1;
$sql = "SELECT tbltestimonial.Testimonial, tblusers.FullName 
        FROM tbltestimonial 
        JOIN tblusers ON tbltestimonial.UserEmail = tblusers.EmailId 
        WHERE tbltestimonial.status = $tid 
        LIMIT 4";
    $result = $dbhh->query($sql);
     if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        ?>
        <div class="testimonial-m">
            <div class="testimonial-content">
                <div class="testimonial-heading">
                    <h5><?php echo htmlentities($row['FullName']);?></h5>
                    <p><?php echo htmlentities($row['Testimonial']);?></p>
                </div>
            </div>
        </div>
        <?php 
    }
}
?>

      </div>
    </div>
  </div>
  <!-- Dark Overlay-->
  <div class="dark-overlay"></div>
</section>
<!-- /Testimonial--> 

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

<script>
    // Filter buttons
    const filterButtons = document.querySelectorAll('.filter-button');
const carItems = document.querySelectorAll('.car-item');

filterButtons.forEach(button => {
    button.addEventListener('click', () => {
        const filter = button.getAttribute('data-filter');
        let foundMatchingItems = false; // Flag to check if any matching items were found

        carItems.forEach(item => {
            const categories = item.getAttribute('data-category').split(' ');
            const vehicleFor = item.getAttribute('data-vhiclefor');

            // Check if the category matches the filter or if the filter is 'all'
            if (filter === 'all' || categories.includes(filter) || vehicleFor === filter) {
                item.style.display = 'block';
                foundMatchingItems = true; // Set the flag to true if a matching item is found
            } else {
                item.style.display = 'none';
            }
        });

        // If no matching items were found, display a message
        if (!foundMatchingItems) {
            const noVehicleFoundMessage = document.getElementById('no-vehicle-found-message');
            noVehicleFoundMessage.style.display = 'block';
        } else {
            const noVehicleFoundMessage = document.getElementById('no-vehicle-found-message');
            noVehicleFoundMessage.style.display = 'none';
        }
    });
});

</script>



</body>

</html>



