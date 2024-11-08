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
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet"> 
<style>

html{
  overflow-x: hidden;
}
 body {
    overflow-x: hidden;
    position: relative;
            min-height: 100%;
            margin: 0;
}
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
.garage-container {
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
        width: calc(100% - 10px); /* Adjust margins for single item per row */
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
 
 .explore-tabs .nav-link {
    font-size: 16px;
    padding: 5px 10px;
    border-radius: 5px 5px 0 0;
    background-color: white;
    border-bottom: none;
  }

  .explore-tabs .nav-link.active {
    background-color: #f7f7f7;
    border-color: #e6e6e6 #e6e6e6 #fff #e6e6e6;
  }

  .explore-tabs {
    margin-bottom: 20px;
    display: flex;
  }
  .explore-tabs .nav-item {
    display: flex;
    margin-right: 0px;
 
  }

  .explore-tabs .nav-link {
    font-size: 16px;
    padding-bottom: 5px; 
    color: #333; 
    text-decoration: none; 
    transition: border-color 0.3s; 
  }

  .explore-tabs .nav-link:hover {
    border-bottom-color: #007bff; 
  }
  .nav-item{
    margin-left: 1px;
    
  }
  .car-items img {
    width: 100%;
    height: 150px; 
    object-fit: cover; 
    border: none; 
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
<!-- <?php include('includes/colorswitcher.php');?> -->
<!-- /Switcher -->  
        
<!--Header-->
<?php include('includes/header.php');?>
<!-- /Header --> 


<!-- home page staring section  -->
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
        <!-- <button class="btn btn-default filter-button" data-filter="Electric">Electric</button>   -->
        <button class="btn btn-default filter-button" data-filter="rent">for rent</button>
        <button class="btn btn-default filter-button" data-filter="sale">for sales</button>
      </div>
      
      <!-- Car listings -->
      <div class="row" id="car-listings">
        <?php 
          // Define pagination variables
          $results_per_page = 6;
          $page = isset($_GET['page']) ? $_GET['page'] : 1;
          $offset = ($page - 1) * $results_per_page;

          // Fetch data from the database with pagination
          $sql = "SELECT tblvehicles.VehiclesTitle, tblbrands.BrandName,tblvehicles.status,tblvehicles.post_status,
           tblvehicles.Price, tblvehicles.FuelType, tblvehicles.Vehicle_for, tblvehicles.ModelYear,
            tblvehicles.id,tblvehicles.garageId, tblvehicles.SeatingCapacity, tblvehicles.inspection,
             tblvehicles.VehiclesOverview,
              tblvehicles.Vimage1 FROM tblvehicles JOIN tblbrands ON tblbrands.id = tblvehicles.VehiclesBrand WHERE tblvehicles.status = 1 AND tblvehicles.post_status = 1  LIMIT $offset, $results_per_page ";
          $query = $dbh->prepare($sql);
          $query->execute();
          $results = $query->fetchAll(PDO::FETCH_OBJ);
          $cnt = 1;
          if($query->rowCount() > 0) {
            foreach($results as $result) {  

              if($result->status=='1' && $result->post_status=='1'){
        ?>  
            
            <div class="col-md-4 col-sm-6 col-xs-12 car-item" 
     data-category="<?php echo htmlentities($result->FuelType . ' ' . $result->Vehicle_for); ?>">

          <div class="recent-car-list">
            <div class="car-info-box"> 
              <a href="vehical-details.php?vhid=<?php echo htmlentities($result->id); ?>">
                         <div class="position-relative">
                         <img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage1); ?>"  class="img-responsive" alt="image">
                   <?php
                         
                         if ($result->inspection == 0) {
                             echo '<span class="featured-badge">uninspected</span>';
                         } elseif ($result->inspection == 1) {
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
              <span class="price">Price: <?php echo  number_format(($result->Price)); ?> ETB</span> 
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
    $sql = "SELECT COUNT(*) AS total FROM tblvehicles WHERE status = 1 AND Post_status = 1";
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


<!-- home page staring section end -->



<!-- EXPLORE MORE Vehicles -->


<section>
  <div class="container">
    <div class="section-header text-center">
      <h2>Explore More</h2>
    </div>
    <div class="row">
<ul class="nav nav-tabs explore-tabs" role="tablist">
  <li class="nav-item">
    <a class="nav-link " data-toggle="tab" href="#economic">Economic</a>  
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#family">Family</a>

  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#luxury">Luxury</a>

  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#garage">Garages</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#uninspected">unispected</a>
  </li>
  <!-- Add more tabs as needed -->
</ul>

      <div class="tab-content">
        <!-- section for economic cars if the vehicle is for sales
 cars valued less than 500k should appear and if it is for rent
  cars with the price less than 1000per days should appear -->

      <div id="economic" class="container tab-pane active">
   <div class="car-container">
  <div class="description">This tab contains economic cars.</div>
  <!-- PHP CODE FOR ECONOMIC CARS -->
  <?php
$query1 = "SELECT * FROM tblvehicles WHERE (Vehicle_for = 'sale' AND Price < 500000) OR (Vehicle_for = 'rent' AND Price < 1000) AND status = 1";
$answer1 = $dbhh->query($query1);
if($answer1->num_rows > 0){
  while($rows1 = $answer1->fetch_assoc()){
          ?>
                  <div class="car-items">
        
        <a href="vehical-details.php?vhid=<?php echo $rows1['id']; ?>">
           <img src="admin/img/vehicleimages/<?php echo $rows1['Vimage1']; ?>"  class="img-responsive" alt="uninspected cars">
         </a>
         
         <h3>price: <?php echo number_format($rows1['Price'])?> ETB</h3>
         <h6>vehicle for: <?php echo $rows1['Vehicle_for']?></h6>
        </div>
        <?php
}
}
?>
    <!-- Add more Economic cars as needed -->
  </div>
        </div>
        <!-- in there cars that are usually used for family
         will apprear a catagorie is nessesory but we will 
         manage ma nigga -->
        <div id="family" class="container tab-pane fade">
          <div class="car-container">
          <div id="family" class="container tab-pane ">
            <div class="car-items">
              <a href="#">
                <img src="./Explore/image/f.jpg" class="img-responsive" alt="Car Image">
              </a>
              <h3>Family Car 1</h3>
              <p>Price: 10,800,000</p>
            </div>
            <div class="car-items">
              <a href="#">
                <img src="audi1.jpg" class="img-responsive" alt="Car Image">
              </a>
              <h3>Family Car 2</h3>
              <p>Price:10,800,000</p>
            </div>
            <!-- Add more Family cars as needed -->
          </div>
        </div>
        <!-- Add more tab panes as needed -->
      </div>

<!-- in there we need cars that are -->
      <div id="luxury" class="container tab-pane fade">
          <div class="car-container">
          <div id="luxury" class="container tab-pane ">
            <div class="car-items">
              <a href="#">
                <img src="./Explore/image/ra.jpg" class="img-responsive" alt="Car Image">
              </a>
              <h3>luxury Car 1</h3>
              <p>Price: 10,800,000</p>
            </div>
            <div class="car-items">
              <a href="#">
                <img src="./Explore/image/t.jpg" class="img-responsive" alt="Car Image">
              </a>
              <h3>luxury Car 1</h3>
              <p>Price: 20,800,000</p>
            </div>
            <!-- Add more Family cars as needed -->
            <div class="car-items">
              <a href="#">
                <img src="./Explore/image/a.jpg" class="img-responsive" alt="Car Image">
              </a>
              <h3>luxury Car 1</h3>
              <p>Price: 19,800,000</p>
            </div>
            <!-- Add more Family cars as needed -->
            <div class="car-items">
              <a href="#">
                <img src="./Explore/image/k.jpg" class="img-responsive" alt="Car Image">
              </a>
              <h3>luxury Car 1</h3>
              <p>Price: 19,800,000</p>
            </div>
            <!-- Add more Family cars as needed -->
            <div class="car-items">
              <a href="#">
                <img src="./Explore/image/b.jpg" class="img-responsive" alt="Car Image">
              </a>
              <h3>luxury Car 1</h3>
              <p>Price: 17,800,000</p>
            </div>
            <!-- Add more Family cars as needed -->
            <div class="car-items">
              <a href="#">
                <img src="./Explore/image/t.jpg" class="img-responsive" alt="Car Image">
              </a>
              <h3>luxury Car 1</h3>
              <p>Price: 18,800,000</p>
            </div>
            <!-- Add more Family cars as needed -->
          </div>
        </div>
      </div>
 <div id="garage" class="container tab-pane fade">
  <div class="car-container">
    <div id="garage" class="container tab-pane">
    <?php
      $query = "SELECT g.*, ROUND(AVG(gr.ratingNumber), 1) AS avg_rating
      FROM garageowner AS g
      LEFT JOIN garage_rating AS gr ON g.garage_id = gr.garageId
      WHERE g.status = 0
      GROUP BY g.garage_id
      ORDER BY avg_rating DESC ";

        $result = $dbhh->query($query);
        if ($result->num_rows > 0) {
            while ($row1= $result->fetch_assoc()) {
        ?>   
      <div class="car-items">
        <a href="garage_profile.php?garage_id=<?php echo $row1['garage_id']; ?>">
          <img src="./garage/image/<?php echo $row1['Image']; ?>"  class="img-responsive" alt="GarageImage">
        </a>
        <h3>Garage rating: <?php echo $row1['avg_rating']?>/5</h3>
        <p>Location: <?php echo $row1['address']?></p>
      </div>
      
      <?php
            }
          }?>   
    </div>      
  </div>
</div>
<!-- section for uninspected vehicles -->
<div id="uninspected" class="container tab-pane fade">
  <div class="car-container">
    <div id="uninspected" class="container tab-pane">
      <?php
$query="SELECT * FROM tblvehicles WHERE inspection = 0 and status=1 and Post_status=1";
$answer=$dbhh->query($query);
if ($answer->num_rows > 0) {
  while($rows=$answer->fetch_assoc()){
      ?>
      <!-- php code  -->
      <div class="car-items">

       <a href="vehical-details.php?vhid=<?php echo $rows['id']; ?>">
          <img src="admin/img/vehicleimages/<?php echo $rows['Vimage1']; ?>"  class="img-responsive" alt="uninspected cars">
        </a>
        
        <h3>price: <?php echo number_format($rows['Price'])?> ETB</h3>
        <p>mileage: <?php echo $rows['mileage']?></p>
      </div>
      <?php
       }
      }
 
      ?>
  </div>
</div>
      </div>
      <!-- end of uninspected vehicles -->
    </div>
  </div>
  </div>
</section>
<!-- END OF EXPLORE -->

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
    const filterButtons = document.querySelectorAll('.filter-button');
const carItems = document.querySelectorAll('.car-item');

filterButtons.forEach(button => {
    button.addEventListener('click', () => {
        const filter = button.getAttribute('data-filter');
        let foundMatchingItems = false; 

        carItems.forEach(item => {
            const categories = item.getAttribute('data-category').split(' ');
            const vehicleFor = item.getAttribute('data-vhiclefor');

            if (filter === 'all' || categories.includes(filter) || vehicleFor === filter) {
                item.style.display = 'block';
                foundMatchingItems = true; 
            } else {
                item.style.display = 'none';
            }
        });
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
          google.translate.TranslateElement(
            { pageLanguage: "en" },
            "english_paragraph"
          );
        }
      }
    </script>

    <script
      type="text/javascript"
      src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"
    ></script>



</body>

</html>



