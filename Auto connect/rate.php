<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Garage Ratings and Reviews</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <!-- Custom CSS -->
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

        @import url(http://fonts.googleapis.com/css?family=Roboto);

        /****** LOGIN MODAL ******/
        .loginmodal-container {
            padding: 30px;
            max-width: 350px;
            width: 100% !important;
            background-color: #f7f7f7;
            margin: 0 auto;
            border-radius: 2px;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            font-family: roboto;
        }

        .loginmodal-container h1 {
            text-align: center;
            font-size: 1.8em;
            font-family: roboto;
        }

        .loginmodal-container input[type="submit"] {
            width: 100%;
            display: block;
            margin-bottom: 10px;
            position: relative;
        }

        .loginmodal-container input[type="text"],
        input[type="password"] {
            height: 44px;
            font-size: 16px;
            width: 100%;
            margin-bottom: 10px;
            -webkit-appearance: none;
            background: #fff;
            border: 1px solid #d9d9d9;
            border-top: 1px solid #c0c0c0;
            /* border-radius: 2px; */
            padding: 0 8px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        .loginmodal-container input[type="text"]:hover,
        input[type="password"]:hover {
            border: 1px solid #b9b9b9;
            border-top: 1px solid #a0a0a0;
            -moz-box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
            -webkit-box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .loginmodal {
            text-align: center;
            font-size: 14px;
            font-family: "Arial", sans-serif;
            font-weight: 700;
            height: 36px;
            padding: 0 8px;
            /* border-radius: 3px; */
            /* -webkit-user-select: none;
            user-select: none; */
        }

        .loginmodal-submit {
            /* border: 1px solid #3079ed; */
            border: 0px;
            color: #fff;
            text-shadow: 0 1px rgba(0, 0, 0, 0.1);
            background-color: #4d90fe;
            padding: 17px 0px;
            font-family: roboto;
            font-size: 14px;
            /* background-image: -webkit-gradient(linear, 0 0, 0 100%,   from(#4d90fe), to(#4787ed)); */
        }

        .loginmodal-submit:hover {
            /* border: 1px solid #2f5bb7; */
            border: 0px;
            text-shadow: 0 1px rgba(0, 0, 0, 0.3);
            background-color: #357ae8;
            /* background-image: -webkit-gradient(linear, 0 0, 0 100%,   from(#4d90fe), to(#357ae8)); */
        }

        .loginmodal-container a {
            text-decoration: none;
            color: #666;
            font-weight: 400;
            text-align: center;
            display: inline-block;
            opacity: 0.6;
            transition: opacity ease 0.5s;
        }

        .login-help {
            font-size: 12px;
        }
        .hidden {
            display: none;
        }
        .logged-user {
            font-weight: bold;
        }
        .user-pic {
            width: 60px;
            height: 60px;
        }
    </style>
</head>
<body>

<div class="container">

    <div id="ratingDetails"> 		
        <div class="row">			
            <div class="col-sm-3">	
            <?php
           $query = "SELECT AVG(ratingNumber) AS averageRating FROM garage_rating WHERE garageId = $garage_id";
           $averageResult = mysqli_query($connection, $query);
           $row = mysqli_fetch_assoc($averageResult);
           $averageRating = $row['averageRating'];
           mysqli_free_result($averageResult);
?>
			
                <h4>Rating and Reviews</h4>
                <h2 class="bold padding-bottom-7"><?php printf('%.1f', $average); ?> <small>/ 5</small></h2>				
                <?php
                $averageRating = round($average, 0);
                for ($i = 1; $i <= 5; $i++) {
                    $ratingClass = "btn-default btn-grey";
                    if($i <= $averageRating) {
                        $ratingClass = "btn-warning";
                    }
                ?>
                <button type="button" class="btn btn-sm <?php echo $ratingClass; ?>" aria-label="Left Align">
                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                </button>	
                <?php } ?>				
            </div>
        </div>
    
        <!-- PHP Query to Retrieve Garage Ratings and Reviews -->
        <?php
       
        $garage_id = $_GET['garage_id'];
    
        // Query to retrieve ratings and reviews for the specific garage_id
        $query = "SELECT gr.ratingId, gr.ratingNumber, gr.userId, gr.garageId, gr.created, gr.comments, gr.title, u.username, u.avatar, go.garage_name
                  FROM garage_rating gr
                  INNER JOIN user u ON gr.userId = u.userId
                  INNER JOIN garageowner go ON gr.garageId = go.garageId
                  WHERE gr.garageId = $garage_id";
    
        $result = mysqli_query($connection, $query);
    
        if (!$result) {
            die("Database query failed.");
        }
    
        // Display the ratings and reviews
        while ($row = mysqli_fetch_assoc($result)) {
            $ratingNumber = $row['ratingNumber'];
            $username = $row['username'];
            $avatar = $row['avatar'];
            $created = $row['created'];
            $comments = $row['comments'];
            $title = $row['title'];
    
            // Format the date
            $reviewDate = date_create($created);
            $formattedDate = date_format($reviewDate, "M d, Y");
    
            // Display the rating and review information in your HTML structure
            ?>
            <div class="row">
                <div class="col-sm-3">
                    <img src="image/<?php echo $avatar; ?>" class="img-rounded user-pic">
                    <div class="review-block-name">By <a href="#"><?php echo $username; ?></a></div>
                    <div class="review-block-date"><?php echo $formattedDate; ?></div>
                </div>
                <div class="col-sm-9">
                    <div class="review-block-rate">
                        <?php
                        for ($i = 1; $i <= 5; $i++) {
                            $ratingClass = "btn-default btn-grey";
                            if ($i <= $ratingNumber) {
                                $ratingClass = "btn-warning";
                            }
                            ?>
                            <button type="button" class="btn btn-xs <?php echo $ratingClass; ?>" aria-label="Left Align">
                                <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                            </button>
                        <?php } ?>
                    </div>
                    <div class="review-block-title"><?php echo $title; ?></div>
                    <div class="review-block-description"><?php echo $comments; ?></div>
                </div>
            </div>
            <hr/>
        <?php }
    
        // Free result set
        mysqli_free_result($result);
    
        // Close the database connection
        mysqli_close($connection);
        ?>
    </div>
    
































    <div class="row">
        <div class="col-sm-7">
            <hr/>
            <div class="review-block">		

                <!-- Fake review block -->
                <div class="row">
                    <div class="col-sm-3">
                        <img src="profile.png" class="img-rounded user-pic">
                        <div class="review-block-name">By <a href="#">John Doe</a></div>
                        <div class="review-block-date">Jan 1, 2024</div>
                    </div>
                    <div class="col-sm-9">
                        <div class="review-block-rate">
                            <!-- Fake rating stars -->
                            <button type="button" class="btn btn-xs btn-warning" aria-label="Left Align">
                                <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                            </button>
                            <button type="button" class="btn btn-xs btn-warning" aria-label="Left Align">
                                <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                            </button>
                            <button type="button" class="btn btn-xs btn-warning" aria-label="Left Align">
                                <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                            </button>
                            <button type="button" class="btn btn-xs btn-default btn-grey" aria-label="Left Align">
                                <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                            </button>
                            <button type="button" class="btn btn-xs btn-default btn-grey" aria-label="Left Align">
                                <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                            </button>
                        </div>
                        <div class="review-block-title">Great experience!</div>
                        <div class="review-block-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla vestibulum sapien at lorem egestas, et fringilla arcu lobortis.</div>
                    </div>
                </div>
                <hr/>

                <!-- You can add more fake reviews following the same pattern -->

            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
</html>
