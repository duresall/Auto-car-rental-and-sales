<?php
if(isset($_POST['login'])) {
    $email=$_POST['email'];
    $password=md5($_POST['password']);
    $sql ="SELECT id,EmailId,Password,FullName FROM tblusers WHERE EmailId='$email' and Password='$password'";
    $result = mysqli_query($dbhh, $sql);
    $sql2 = "SELECT UserName, Password FROM admin WHERE UserName='$email' AND Password='$password'";
    $result2 = mysqli_query($dbhh, $sql2);
    $sql3 ="SELECT garage_id,email,Password FROM garageowner WHERE email='$email' and password='$password'";
    $result3 = mysqli_query($dbhh, $sql3);
    if(mysqli_num_rows($result) > 0) {
        $_SESSION['login']=$_POST['email'];
        $row = mysqli_fetch_assoc($result);
        $_SESSION['fname']=$row['FullName'];
        $_SESSION['location']=$row['City'];
        $_SESSION['id']=$row['id'];
        $_SESSION['email']=$row['email'];
        $userId = $row['id'];
        $updateSql = "UPDATE tblusers SET status = 1 WHERE id = $userId";
        mysqli_query($dbhh, $updateSql);
        $currentpage=$_SERVER['REQUEST_URI'];
        echo "<script type='text/javascript'> document.location = '$currentpage'; </script>";
    } elseif(mysqli_num_rows($result2) > 0) {

      $_SESSION['alogin'] = $_POST['email'];
			echo "<script type='text/javascript'> document.location = './admin/dashboard.php'; </script>";

    }elseif(mysqli_num_rows($result3) > 0) {

      $_SESSION['alogin'] = $_POST['email'];			
      $row = $result->fetch_assoc();
      $_SESSION['garage_id']=$row['garage_id'];
      echo "<script type='text/javascript'> document.location = './garage/dashboard.php'; </script>";
    
    }else {
        echo "<script>alert('Invalid Details');</script>";
    }
}
?>


<div class="modal fade" id="loginform">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Login</h3>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="login_wrap">
            <div class="col-md-12 col-sm-6">
              <form method="post">
                <div class="form-group">
                  <input type="email" class="form-control" name="email" placeholder="Email address*">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" name="password" placeholder="Password*">
                </div>
                <div class="form-group checkbox">
                  <input type="checkbox" id="remember">
                </div>
                <div class="form-group">
                  <input type="submit" name="login" value="Login" class="btn btn-block">
                </div>
              </form>
            </div>
           
          </div>
        </div>
      </div>
      <div class="modal-footer text-center">
        <p>Don't have an account? <a href="#signupform" data-toggle="modal" data-dismiss="modal">Signup Here</a></p>
        <p><a href="./garage/forgotpassword.php" >Forgot Password ?</a></p>
      </div>
    </div>
  </div>
</div>