<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/configtwo.php');
if(strlen($_SESSION['login'])==0)
  { 
header('location:index.php');
}
else{
?><!DOCTYPE HTML>
<html lang="en">
<head>

<title>Auto car rental and sales Portal - Chat-area</title>
<!--Bootstrap -->
<meta name="viewport" content="width=device-width, initial-scale=1">
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
<!-- Google-Font-->
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<style>
  .upload_user_logo img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    margin-right: 20px;
}
.users {
    margin: 20px auto;
    max-width: 400px;
}
.wrapper {
    margin: 20px auto;
    max-width: 600px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    padding: 5px;
}

.users .wrapper {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
}

.users .search {
    margin: 20px 0;
    display: flex;
    position: relative;
    align-items: center;
    justify-content: space-between;
}

.users .search .text {
    font-size: 18px;
}

.users .search input {
    position: relative;
    height: 42px;
    width: calc(100% - 50px);
    font-size: 16px;
    padding: 0 13px;
    border: 1px solid #e6e6e6;
    outline: none;
    border-radius: 5px;
    transition: all 0.2s ease;
}

.users .search button {
    width: 47px;
    height: 42px;
    font-size: 17px;
    cursor: pointer;
    border: none;
    background: #fff;
    color: #333;
    outline: none;
    border-radius: 0 5px 5px 0;
    transition: all 0.2s ease;
}

.users .search button.active {
    background: #333;
    color: #fff;
}
:is(.users, .users-list) .content{
  display: flex;
  align-items: center;
}
:is(.users, .users-list) .content .details{
  color: #000;
  margin-left: 20px;
}
:is(.users, .users-list) .details span{
  font-size: 18px;
  font-weight: 500;
}

.users .search input.show {
    width: calc(100% - 110px);
}

.users-list {
    max-height: 350px;
    overflow-y: auto;
}

.users-list a {
    display: flex;
    align-items: center;
    padding-bottom: 10px;
    margin-bottom: 15px;
    padding-right: 15px;
    border-bottom: 1px solid #f1f1f1;
    text-decoration: none;
    color: #333;
}

.users-list a:last-child {
    margin-bottom: 0;
    border-bottom: none;
}

.users-list a img {
    height: 40px;
    width: 40px;
    border-radius: 50%;
    margin-right: 10px;
}

.users-list a .details p {
    color: #67676a;
}

.users-list a .status-dot {
    font-size: 12px;
    color: #468669;
    padding-left: 60px;
}

.users-list a .status-dot.offline {
    color: #ccc;
}

/* Hide scrollbar */
:is(.users-list,.chat-box)::-webkit-scrollbar {
    width: 0;
    display: none;
}
/*chat area*/
.wrapper img{
  object-fit: cover;
  border-radius: 50%;
}
.chat-area header{
  display: flex;
  align-items: center;
  padding: 18px 30px;
}
.chat-area header img{
  height: 45px;
  width: 45px;
  margin: 0 15px;
}
.chat-area header .details span{
  font-size: 17px;
  font-weight: 500;
}
.chat-box{
  position: relative;
  min-height: 500px;
  max-height: 500px;
  overflow-y: auto;
  padding: 10px 30px 20px 30px;
  background: #f7f7f7;
  box-shadow: inset 0 32px 32px -32px rgb(0 0 0 / 5%),
              inset 0 -32px 32px -32px rgb(0 0 0 / 5%);
}
.chat-box .text{
  position: absolute;
  top: 45%;
  left: 50%;
  width: calc(100% - 50px);
  text-align: center;
  transform: translate(-50%, -50%);
}
.chat-box .chat{
  margin: 15px 0;
}
.chat-box .chat p{
  word-wrap: break-word;
  padding: 8px 16px;
  box-shadow: 0 0 32px rgb(0 0 0 / 8%),
              0rem 16px 16px -16px rgb(0 0 0 / 10%);
}
.chat-box .outgoing{
  display: flex;
}
.chat-box .outgoing .details{
  margin-left: auto;
  max-width: calc(100% - 130px);
}
.outgoing .details p{
  background: #333;
  color: #fff;
  border-radius: 18px 18px 0 18px;
}
.chat-box .incoming{
  display: flex;
  align-items: flex-end;
}
.chat-box .incoming img{
  height: 35px;
  width: 35px;
}
.chat-box .incoming .details{
  margin-right: auto;
  margin-left: 10px;
  max-width: calc(100% - 130px);
}
.incoming .details p{
  background: #fff;
  color: #333;
  border-radius: 18px 18px 18px 0;
}
.typing-area{
  padding: 18px 30px;
  display: flex;
  justify-content: space-between;
}
.typing-area input{
  height: 45px;
  width: calc(100% - 58px);
  font-size: 16px;
  padding: 0 13px;
  border: 1px solid #e6e6e6;
  outline: none;
  border-radius: 5px 0 0 5px;
}
.typing-area button{
  color: #fff;
  width: 55px;
  border: none;
  outline: none;
  background: #333;
  font-size: 19px;
  cursor: pointer;
  opacity: 0.7;
  pointer-events: none;
  border-radius: 0 5px 5px 0;
  transition: all 0.3s ease;
}
.typing-area button{
  opacity: 1;
  pointer-events: auto;
}
.user_profile_info {
    border: 1px solid #ccc;
    border-radius: 8px;
    padding: 20px;
    display: flex;
    align-items: center;
}

.upload_user_logo img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    margin-right: 20px;
}

.col-md-8 {
    width: calc(100% - 120px); /* Adjust width based on the image size */
}

.dealer_info {
    padding: 10px;
}

.uppercase {
    text-transform: uppercase;
}

.underline {
    text-decoration: underline;
}

.user-details {
    display: flex;
    flex-direction: column;
}

.user-detail {
    margin-bottom: 10px;
}

.detail-label {
    font-weight: bold;
    margin-right: 5px;
}

.detail-value {
    color: #333;
    font-weight: bold;
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
<?php include('includes/colorswitcher.php');?>
<!-- /Switcher -->  
        
<!--Header-->
<?php include('includes/header.php');?>
<!--Page Header-->
<!-- /Header --> 

<!--Page Header-->
<section class="page-header profile_page">
  <div class="container">
    <div class="page-header_wrap">
      <div class="page-heading">
        <h1>My Post</h1>
      </div>
      <ul class="coustom-breadcrumb">
        <li><a href="#">Home</a></li>
        <li>My Post</li>
      </ul>
    </div>
  </div>
  <!-- Dark Overlay-->
  <div class="dark-overlay"></div>
</section>
<!-- /Page Header--> 

<?php 
$id=$_SESSION['id'];
$sql2 = "SELECT * from tblusers where id=$id";
$result2=$dbhh->query($sql2);
if($result2->num_rows > 0){
$cnt=1;
while($row2 = $result2->fetch_assoc()) 
  {
 ?>
<section class="user_profile inner_pages">
<div class="user_profile_info gray-bg padding_4x4_40">
    <div class="upload_user_logo">
    <?php 
        if(empty($row2['photo'])) {
    ?>
            <img src="profile.png" alt="Default Profile Image">
    <?php 
        } else {
    ?>
            <img src="<?php echo htmlentities($row2['photo']); ?>" alt="User Profile Image">
    <?php 
        }
    ?>
    </div>
    <div class="col-md-8">
        <div class="dealer_info">
            <h6 class="uppercase underline">User Information</h6>
            <div class="user-details">
                <div class="user-detail">
                    <span class="detail-label">Full Name:</span>
                    <span class="detail-value"><?php echo htmlentities($row2["FullName"]);?></span>
                </div>
                <div class="user-detail">
                    <span class="detail-label">Address:</span>
                    <span class="detail-value"><?php echo htmlentities($row2["Address"]);?></span>
                </div>
                <div class="user-detail">
                    <span class="detail-label">City:</span>
                    <span class="detail-value"><?php echo htmlentities($result->City);?></span>
                </div>
                <div class="user-detail">
                    <span class="detail-label">Country:</span>
                    <span class="detail-value"><?php echo htmlentities($result->Country);?></span>
                </div>
            </div>
            <?php

  }
}
?>
        </div>
    </div>
</div>
    <div class="row">
      <div  class="col-md-3 col-sm-3">
       <?php include('includes/sidebar.php');?>
       <div class="notranslate" class="col-md-6 col-sm-8">
        <div class="profile_wrap">
        
    <!-- Update HTML structure and add more styling -->
    <div class="wrapper">
    <section class="chat-area">
      <!--getting the id of the user and performing a query based on that id-->
      <?php
       $user_id=$_GET['user_id'];
       $user="SELECT * from tblusers where id=$user_id";
       $result=$dbhh->query($user);
       $row3 = $result->fetch_assoc();
      
      ?>
        <header>
            <a href="chat.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>

            <?php 
              if(empty($row3['photo'])) {
            ?>
              <img src="profile.png" alt="Default Profile Image">
            <?php 
              } else {
            ?>
              <img src="<?php echo htmlentities($row3['photo']); ?>" alt="User Profile Image">
            <?php 
              }
            ?>

            <div class="details">
                <span><?php echo htmlentities($row3['FullName']);?></span>
                <?php
                if($row3['status']==1){
                  $status="Online";
                    
                        }else{
                          $status="Offline";
                        }
                        ?>
                <p><?php echo htmlentities($status);?></p>
            </div>
        </header>
        <div class="chat-box">
            
            
        </div>
        <form action="" class="typing-area">
       <?php $user_id=$_GET['user_id'];
       ?>
           <input type="text" name="incoming_id"  value="<?php echo $user_id; ?>" hidden>
           <input type="text" name="outgoing_id" class="incoming_id" value="<?php echo $_SESSION['id']; ?>" hidden>
           <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
           <button ><i class="fab fa-telegram-plane"></i></button>
      </form>
              
    </section>  
    </div>


      </div>
    </div>
      <!--end of chat section -->
    
        
       
    </div>
     <!--chat section God please help me on this one-->
  
  </div>
   
</section>
<!--/my-vehicles--> 
<?php include('includes/footer.php');?>

<!-- Scripts --> 
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script> 
<script src="assets/js/interface.js"></script> 
<script src="assets/js/chat-area.js"></script> 
<!--Switcher-->
<script src="assets/switcher/js/switcher.js"></script>
<!--bootstrap-slider-JS--> 
<script src="assets/js/bootstrap-slider.min.js"></script> 
<!--Slider-JS--> 
<script src="assets/js/slick.min.js"></script> 
<script src="assets/js/owl.carousel.min.js"></script>

<script src="assets/js/owl.carousel.min.js"></script>
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
            var notranslateElements = englishParagraph.getElementsByClassName("notranslate");
            for (var i = 0; i < notranslateElements.length; i++) {
                notranslateElements[i].setAttribute("translate", "no");
            }
        }
    }
</script>

    <script
      type="text/javascript"
      src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"
    ></script>
</body>
</html>
<?php } ?>