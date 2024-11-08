<?php
session_start();
include('includes/config.php');
include('includes/configtwo.php');
if(isset($_POST['login']))
             {
               $email=$_POST['email'];
               $password=md5($_POST['password']);
               $sql ="SELECT garage_id,email,Password FROM garageowner WHERE email='$email' and password='$password'";
               $result= $dbhh -> query($sql);
			   if ($result) {
				if ($result->num_rows > 0) {
					$_SESSION['alogin'] = $_POST['email'];
					
					$row = $result->fetch_assoc();

					$_SESSION['garage_id']=$row['garage_id'];
					echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
				} else {
					echo "<script>alert('Invalid Details');</script>";
				}
			} else {
				echo "Error: " . $dbhh->error;
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
	<style>
			.bk-light {
  background: #eee;
}
	</style>
</head>
<body>	
	<div class="login-page bk-img" style="background-image: url(./image/garagebackground.jpg);">
		<div class="form-content">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-md-offset-3">
						<h1 class="text-center text-bold mt-4x" style="color:#fff">Garage | Sign in</h1>
						<div class="well row pt-2x pb-3x bk-light">
							<div class="col-md-8 col-md-offset-2">
								<form method="post">
									<label for="" class="text-uppercase text-sm">Email </label>
									<input type="text" placeholder="Email" name="email" class="form-control mb">

									<label for="" class="text-uppercase text-sm">Password</label>
									<input type="password" placeholder="Password" name="password" class="form-control mb">
									<button class="btn btn-primary btn-block" name="login" type="submit">LOGIN</button>
								</form>
			                       <p style="margin-top: 4%" text-align="center"><a href="forgotpassword.index.php">FORGOT PASSWORD</a>	</p>
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