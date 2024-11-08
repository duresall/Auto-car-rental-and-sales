<?php 
session_start();
include('config.php');
include('configtwo.php');
error_reporting(0);
?>
<header>
  <style>
    #image{
      width: 100px;
     height: 50px;
    }
  </style>
  <div class="default-header">
    <div class="container">
      <div class="row">
        <div class="col-sm-3 col-md-2">
          <div class="logo" > <a href="index.php"><img src="assets/images/car.png" alt="image" id="image" /></a> </div>
        </div>
        <div class="col-sm-9 col-md-10">
          <div class="header_info">
         <?php
         $sql = "SELECT EmailId,ContactNo from tblcontactusinfo";
             $query = $dbh-> prepare($sql);
             $query->execute();
             $results=$query->fetchAll(PDO::FETCH_OBJ);
             foreach ($results as $result) {
             $email=$result->EmailId;
             $contactno=$result->ContactNo;
             }
             ?>   
            <div class="header_widgets">
              <div class="circle_icon"> <i class="fa fa-envelope" aria-hidden="true"></i> </div>
              <p class="uppercase_text">For Support Mail us : </p>
              <a href="mailto:<?php echo htmlentities($email);?>"><?php echo htmlentities($email);?></a> </div>
            <div class="header_widgets">
              <div class="circle_icon"> <i class="fa fa-phone" aria-hidden="true"></i> </div>
              <p class="uppercase_text">Service Helpline Call Us: </p>
              <a href="tel:<?php echo htmlentities($contactno);?>"><?php echo htmlentities($contactno);?></a> </div>
            <div class="social-follow">
            </div>
                <?php   if(strlen($_SESSION['login'])==0)
             	{	
             ?>
              <div class="login_btn"> <a href="#loginform" class="btn btn-xs uppercase" data-toggle="modal" data-dismiss="modal">Login / Register</a> </div>
             <?php }
             else{ 
             echo "Welcome To Auto car rental and sales";
              } ?>
          </div>
          <div id="google_translate_element" style="
  position: relative;
  display: flex;
  justify-content: center;
  align-items: center;

  border-radius: 5px;
  padding: 5px 10px;
  background-color: #fff;
  font-size: 14px;
  margin-right: 10px; /* Adjust margin as needed */
  margin-bottom: 10px; /* Add margin at the bottom */
  margin-left: 5px; /* Shift a bit to the left */
"></div>

        </div>
      </div>
    </div>
    
  </div>
  <!-- Navigation -->
 
  <nav id="navigation_bar" class="navbar navbar-default">
    <div class="container">
      <div class="navbar-header">
        <button id="menu_slide" data-target="#navigation" aria-expanded="false" data-toggle="collapse" class="navbar-toggle collapsed" type="button"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      </div>
      <div class="header_wrap">
        <div class="user_login">
          <ul>
            
            <li class="dropdown"> <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user-circle" aria-hidden="true"></i> 
<?php 
      $email=$_SESSION['login'];
      $sql ="SELECT FullName FROM tblusers WHERE EmailId=:email ";
          $query= $dbh -> prepare($sql);
          $query-> bindParam(':email', $email, PDO::PARAM_STR);
      $query-> execute();
      $results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
	{
	 echo htmlentities($result->FullName); }}?>
   
   <i class="fa fa-angle-down" aria-hidden="true"></i></a>
              <ul class="dropdown-menu">
           <?php if($_SESSION['login']){?>
            <li><a href="chat.php">Profile</a></li>

            <li><a href="logout.php">Sign Out</a></li>
            <?php } ?>
          </ul>
            </li>
            

          </ul>
          
        </div>
       
       

        <div class="header_search">
          <div id="search_toggle"><i class="fa fa-search" aria-hidden="true"></i></div>
<!-- search form for browsing-->
          <form action="search.php" method="post" id="header-search-form" id="seacrch">
            <input type="text" placeholder="Search..." name="searchdata" class="form-control" required="true">
            <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
          </form>
<!--end of the search form-->
        </div>
      </div>
      <div class="collapse navbar-collapse" id="navigation">
        <ul class="nav navbar-nav">
          <li><a href="index.php">Home</a>    </li>
          <li><a href="page.php?type=aboutus">About Us</a></li>
          <li><a href="car-listing.php">Car Listing</a>
          <li><a href="fqa.php">FAQs</a></li>
          <li><a href="contact-us.php">Contact Us</a></li>
          <li><a href="post.php">List your Car</a></li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Navigation end --> 
</header>