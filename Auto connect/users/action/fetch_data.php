<?php
// Include your database connection file
require_once '../../includes/config.php';

$results_per_page = 6;

// Check the current page, default to page 1
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// Calculate the offset for pagination
$offset = ($page - 1) * $results_per_page;

// Fetch data from the database for the current page only
$sql = "SELECT tblvehicles.VehiclesTitle, tblbrands.BrandName, tblvehicles.status, tblvehicles.post_status,
            tblvehicles.Price, tblvehicles.FuelType, tblvehicles.Vehicle_for, tblvehicles.ModelYear,
            tblvehicles.id, tblvehicles.garageId, tblvehicles.SeatingCapacity, tblvehicles.inspection,
            tblvehicles.VehiclesOverview, tblvehicles.Vimage1 
        FROM tblvehicles 
        JOIN tblbrands ON tblbrands.id = tblvehicles.VehiclesBrand 
        WHERE tblvehicles.status = 1 AND tblvehicles.post_status = 1 
        LIMIT $offset, $results_per_page";

$query = $dbh->prepare($sql);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);

// Output the fetched data
foreach ($results as $result) {  
    if ($result->status=='1' && $result->post_status=='1') {
        ?>  
        <div class="col-md-4 col-sm-6 col-xs-12 car-item" 
            data-category="<?php echo htmlentities($result->FuelType . ' ' . $result->Vehicle_for); ?>">
            <div class="recent-car-list">
                <div class="car-info-box"> 
                    <a href="vehical-details.php?vhid=<?php echo htmlentities($result->id); ?>">
                        <div class="position-relative">
                            <img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage1); ?>" class="img-responsive" alt="image">
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

// Pagination Links
$sql = "SELECT COUNT(*) AS total 
        FROM tblvehicles 
        WHERE status = 1 AND post_status = 1";
$query = $dbh->prepare($sql);
$query->execute();
$row = $query->fetch(PDO::FETCH_ASSOC);
$total_records = $row["total"];
$total_pages = ceil($total_records / $results_per_page);

echo '<div class="pagination">';
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
echo '</div>';

// No closing PHP tag needed
