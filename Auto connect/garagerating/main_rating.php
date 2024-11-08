<?php 
session_start();

?>

<title>rating</title>

<script src="js/rating.js"></script>
<link rel="stylesheet" href="css/style.css">

<div class="container">		
	<h2>Example: Star Rating System with Ajax, PHP and MySQL</h2>
	<?php
	include 'class/Rating.php';
	$rating = new Rating();
	$garageList = $rating->getGarageList();
	foreach($garageList as $garage){
		$average = $rating->getRatingAverage($garage["garage_id"]);
	?>	
	<div class="row">
		<div class="col-sm-2" style="width:150px">
			<img class="product_image" src="image/<?php echo $garage["Image"]; ?>" style="width:100px;height:200px;padding-top:10px;">
		</div>
		<div class="col-sm-4">
		<h4 style="margin-top:10px;"><?php echo $garage["name"]; ?></h4>
		<div><span class="average"><?php printf('%.1f', $average); ?> <small> /5</small></span> <span class="rating-reviews"><a href="show_rating.php?garage_id=<?php echo $garage["garage_id"]; ?>">Rating & Reviews</a></span></div>
		<?php echo $garage["address"]; ?>		
		</div>		
	</div>
	<?php } ?>	
</div>	
</div>	
<?php include('inc/footer.php');?>






