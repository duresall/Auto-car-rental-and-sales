<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('includes/configtwo.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:../index.php');
}
else{
    $email=$_SESSION['alogin'];

    $sql1="SELECT garage_id FROM garageowner WHERE email='$email'";
    $result1 = mysqli_query($dbhh, $sql1);
    $row1 = mysqli_fetch_array($result1);
    $garage_id = $row1['garage_id'];
    echo "Email of the user is: "; 
    var_dump($email); 


    $query = "SELECT 
    gr.ratingId, 
    gr.ratingNumber, 
    gr.userId, 
    gr.garageId, 
    gr.created, 
    gr.comments, 
    gr.title, 
    u.FullName,
    u.photo
FROM 
    garage_rating gr
INNER JOIN 
    tblusers u ON gr.userId = u.id
WHERE 
    gr.garageId = $garage_id
ORDER BY gr.created DESC
LIMIT 1";

           
           $result = mysqli_query($dbhh, $query);	
?>

<!doctype html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
	<title>Auto car rental and sales | Admin Create Brand</title>
	<!-- Font awesome -->
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<!-- Sandstone Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Bootstrap Datatables -->
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<!-- Bootstrap social button library -->
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<!-- Bootstrap select -->
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<!-- Bootstrap file input -->
	<link rel="stylesheet" href="css/fileinput.min.css">
	<!-- Awesome Bootstrap checkbox -->
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<!-- Admin Stye -->
	<link rel="stylesheet" href="css/style.css">
	<style>
	    /* Custom CSS */
        .btn-grey {
            background-color: #d8d8d8;
            color: #fff;
        }
        .rating-block {
            background-color: #fafafa;
            border: 1px solid #efefef;
            padding: 15px 15px 20px 15px;
            border-radius: 3px;
        }
        .bold {
            font-weight: 700;
        }
        .padding-bottom-7 {
            padding-bottom: 7px;
        }

        .review-block {
            background-color: #fafafa;
            border: 1px solid #efefef;
            padding: 15px;
            border-radius: 3px;
            margin-bottom: 15px;
        }
        .review-block-name {
            font-size: 12px;
            margin: 10px 0;
        }
        .review-block-date {
            font-size: 12px;
        }
        .review-block-rate {
            font-size: 13px;
            margin-bottom: 15px;
        }
        .review-block-title {
            font-size: 15px;
            font-weight: 700;
            margin-bottom: 10px;
        }
        .review-block-description {
            font-size: 13px;
        }
        .average {
            background-color: #388e3c;
            line-height: normal;
            display: inline-block;
            color: #fff;
            padding: 2px 4px 2px 6px;
            border-radius: 3px;
            font-weight: 500;
            font-size: 12px;
            vertical-align: middle;
        }
        .rating-reviews {
            padding-left: 8px;
            font-weight: 500;
            color: #878787;
        }
        .user-pic {
  width: 60px;
  height: 60px;
}
		</style>

</head>

<body>
	<?php include('includes/header.php');?>
	<div class="ts-main-content">
	<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">
					
						<h2 class="page-title">Your Rating and reviews</h2>

						<div class="row">
							<div class="col-md-10">
								<div class="panel panel-default">
									<div class="panel-heading">Rating and reviews</div>
									<div class="panel-body">          
<!-- displaying the rating and reviews for the logged in garage -->
<div class="row">
                                <div class="col-sm-7">
                                    <hr/>
                                    <div class="review-block">
                                    <?php
                            if ($result = mysqli_query($dbhh, $query)) {
                              // Check for query errors
                              if (mysqli_num_rows($result) > 0) {
                                function displayAvatar($photo) {
                                  return "<img src='../$photo' class='img-rounded user-pic'>";
                                }
                                function displayRatingStars($rating) {
                                  $stars = '';
                                  for ($i = 0; $i < 5; $i++) {
                                    if ($i < $rating) {
                                      $stars .= '<button type="button" class="btn btn-xs btn-warning" aria-label="Left Align"><span class="glyphicon glyphicon-star" aria-hidden="true"></span></button>';
                                    } else {
                                      $stars .= '<button type="button" class="btn btn-xs btn-default btn-grey" aria-label="Left Align"><span class="glyphicon glyphicon-star" aria-hidden="true"></span></button>';
                                    }
                                  }
                                  return $stars;
                                }
                                while ($row = mysqli_fetch_assoc($result)) {
                                  echo '<div class="row">';
                                  echo '<div class="col-sm-3">';
                                  $photo = !empty($row['photo']) ? $row['photo'] : 'profile.png';
                                  echo displayAvatar($photo);
                                  echo '<div class="review-block-name">By <a href="#">' . htmlspecialchars($row['FullName']) . '</a></div>';
                                  echo '<div class="review-block-date">' . $row['created'] . '</div>';
                                  echo '</div>';
                                  echo '<div class="col-sm-9">';
                                  echo '<div class="review-block-rate">';
                                  echo displayRatingStars($row['ratingNumber']);
                                  echo '</div>';
                                  echo '<div class="review-block-title">' . htmlspecialchars($row['title']) . '</div>';
                                  echo '<div class="review-block-description">' . htmlspecialchars($row['comments']) . '</div>';
                                  echo '</div>';
                                  echo '</div>';
                                  echo '<hr/>';
                                }

                              } else {
                                echo '<p>No reviews available.</p>';
                              }
                            } else {
                              echo "Error fetching reviews: " . mysqli_error($dbhh);
                            }
                            ?>

                        

                                    </div>
                                    <div class="text-center">
                            <a href="" id="see-more-link" class="blue-link">See More</a>
                        </div>
                                </div>
</div>
<hr>

<!-- end of rating and review for the garage  -->
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Loading Scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>
    <script>
    $(document).ready(function(){
        var reviewsFetched = 2; // Initially fetched 2 reviews

        $('#see-more-link').click(function(e){
            e.preventDefault(); // Prevent default link behavior

            // Fetch additional reviews via AJAX
            $.ajax({
                url: 'actions/fetch_reviews.php', // URL to the PHP script that fetches additional reviews
                type: 'POST',
                data: { reviewsFetched: reviewsFetched }, // Send the number of reviews fetched so far
                success: function(response) {
                    // Append the fetched reviews to the review block
                    $('.review-block').append(response);

                    // Update the number of reviews fetched
                    reviewsFetched += 4; // Fetch 4 more reviews next time
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching reviews:', error);
                }
            });
        });
    });
</script>

</body>

</html>
<?php } ?>