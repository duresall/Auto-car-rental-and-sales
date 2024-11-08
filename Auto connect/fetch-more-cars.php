
<?php
session_start();
include('includes/config.php');
include('includes/configtwo.php');
error_reporting(0);
$numAdditionalCars = 3;
$count = $_POST['count'];
$sql = "SELECT tblvehicles.VehiclesTitle, tblbrands.BrandName, tblvehicles.PricePerDay, tblvehicles.FuelType, tblvehicles.ModelYear, tblvehicles.id, tblvehicles.SeatingCapacity, tblvehicles.inspection, tblvehicles.VehiclesOverview, tblvehicles.Vimage1 FROM tblvehicles JOIN tblbrands ON tblbrands.id = tblvehicles.VehiclesBrand LIMIT $numAdditionalCars OFFSET $count";
$result = $dbhh->query($sql);
$html = '';
if($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {  
        $html .= '
        <div class="col-md-4 col-sm-6 col-xs-12 car-item" data-category="'. htmlentities($row['FuelType']) .'">
            <div class="recent-car-list">
                <div class="car-info-box"> 
                    <a href="vehical-details.php?vhid='. htmlentities($row['id']) .'">
                        <div class="position-relative">
                            <img src="admin/img/vehicleimages/'. htmlentities($row['Vimage1']) .'"  class="img-responsive" alt="image">
                        </div>
                    </a>
                    <ul>
                        <li><i class="fa fa-car" aria-hidden="true"></i>'. htmlentities($row['FuelType']) .'</li>
                        <li><i class="fa fa-calendar" aria-hidden="true"></i>'. htmlentities($row['ModelYear']) .' Model</li>
                        <li><i class="fa fa-user" aria-hidden="true"></i>'. htmlentities($row['SeatingCapacity']) .' seats</li>
                    </ul>
                </div>
                <div class="car-title-m">
                    <h6><a href="vehical-details.php?vhid='. htmlentities($row['id']) .'">'. htmlentities($row['VehiclesTitle']) .'</a></h6>
                    <span class="price">$'. htmlentities($row['PricePerDay']) .' /</span> 
                </div>
                <div class="inventory_info_m"></div>
            </div>
        </div>
        ';
    }
}
echo $html;
$sql_count = "SELECT COUNT(*) AS total FROM tblvehicles";
$count_result = $dbhh->query($sql_count);
$total_cars = $count_result->fetch_assoc()['total'];
$remaining_cars = $total_cars - $count;
if ($remaining_cars <= $numAdditionalCars) {
    echo '<input type="hidden" id="more-cars-btn" class="btn btn-primary" value="No more cars left" disabled>';
}
?>
