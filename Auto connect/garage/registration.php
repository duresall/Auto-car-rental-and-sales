<?php
include('includes/configtwo.php');

if(isset($_GET['token'])) {
    $token = $_GET['token'];

    // Check if the token exists and is not used
    $checkTokenQuery = "SELECT * FROM garage_registration WHERE token = '$token' AND used = 0";
    $checkTokenResult = $dbhh->query($checkTokenQuery);

    if($checkTokenResult->num_rows > 0) {
        $row = $checkTokenResult->fetch_assoc();
        $email = $row['email']; 
    } else {
        echo "<script>alert('Invalid token. Please try again');</script>";
        exit;
    }
} else {
    echo "<script>alert('Token not found');</script>";
    exit;
}

if(isset($_POST['Register'])) {
    $password = md5($_POST['password']);
    $phone = $_POST['phone'];

    $insertQuery = "INSERT INTO garageowner (email, password, phone) VALUES ('$email', '$password', '$phone')";
    $insertResult = $dbhh->query($insertQuery);
    if($insertResult) {
        // Mark the token as used
        $updateTokenQuery = "UPDATE garage_registration SET used = 1 WHERE token = '$token'";
        $dbhh->query($updateTokenQuery);

        echo "<script>alert('Registration successful. Now you can login');</script>";
        echo "<script>window.location.href='../index.php';</script>";
        exit;
    } else {
        echo "<script>alert('Something went wrong. Please try again');</script>";
    }
}
?>
<!doctype html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Auto car rental and sales  | Garage Login</title>
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<link rel="stylesheet" href="css/fileinput.min.css">
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>	
	<div class="login-page bk-img" style="background-image: url(img/login-bg.jpg);">
		<div class="form-content">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-md-offset-3">
						<h1 class="text-center text-bold mt-4x" style="color:#fff">Garage | Sign in</h1>
						<div class="well row pt-2x pb-3x bk-light">
							<div class="col-md-8 col-md-offset-2">
								<form method="post">
									<label for="" class="text-uppercase text-sm">Email </label>
									<input type="text" placeholder="Email" name="email" class="form-control mb" value="<?php echo $email; ?>" readonly>
                                    <label for="" class="text-uppercase text-sm">Phone number </label>
									<input type="text" placeholder="979347137" name="phone" class="form-control mb">
                                    <label for="" class="text-uppercase text-sm">password </label>
									<input type="password" placeholder="password" name="password" class="form-control mb">
									<label for="" class="text-uppercase text-sm">confirm password</label>
									<input type="password" placeholder="confirem password" name="confirempassword" class="form-control mb">
									<button class="btn btn-primary btn-block" name="Register" type="submit">REGISTER</button>
								</form>
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

</body>

</html>