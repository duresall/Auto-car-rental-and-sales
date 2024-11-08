<?php
session_start();
error_reporting(0);
include('includes/configtwo.php');
$sql = "SELECT * FROM fqa";
	$statement = $dbhh->prepare($sql);
	$statement->execute();

$result = $statement->get_result();
$faqs = $result->fetch_all(MYSQLI_ASSOC);

?>
<!DOCTYPE HTML>
<html lang="en">
<head>

<title>Auto car rental and sales || FQAS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--Bootstrap -->
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
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
 <style>

 .accordion_one .panel-group {
	    border: 1px solid #f1f1f1;
	    margin-top: 100px
	}
	a:link {
	    text-decoration: none
	}
	.accordion_one .panel {
	    background-color: transparent;
	    box-shadow: none;
	    border-bottom: 0px solid transparent;
	    border-radius: 0;
	    margin: 0
	}
	.accordion_one .panel-default {
	    border: 0
	}
	.accordion-wrap .panel-heading {
	    padding: 0px;
	    border-radius: 0px
	}
	h4 {
	    font-size: 18px;
	    line-height: 24px
	}
	.accordion_one .panel .panel-heading a.collapsed {
	    color: #999999;
	    display: block;
	    padding: 12px 30px;
	    border-top: 0px
	}
	.accordion_one .panel .panel-heading a {
	    display: block;
	    padding: 12px 30px;
	    background: #fff;
	    color: #313131;
	    border-bottom: 1px solid #f1f1f1
	}
	.accordion-wrap .panel .panel-heading a {
	    font-size: 14px
	}
	.accordion_one .panel-group .panel-heading+.panel-collapse>.panel-body {
	    border-top: 0;
	    padding-top: 0;
	    padding: 25px 30px 30px 35px;
	    background: #fff;
	    color: #999999
	}
	.img-accordion {
	    width: 81px;
	    float: left;
	    margin-right: 15px;
	    display: block
	}
	.accordion_one .panel .panel-heading a.collapsed:after {
	    content: "\2b";
	    color: #999999;
	    background: #f1f1f1
	}
	.accordion_one .panel .panel-heading a:after,
	.accordion_one .panel .panel-heading a.collapsed:after {
	    font-family: 'FontAwesome';
	    font-size: 15px;
	    width: 36px;
	    line-height: 48px;
	    text-align: center;
	    background: #F1F1F1;
	    float: left;
	    margin-left: -31px;
	    margin-top: -12px;
	    margin-right: 15px
	}
	.accordion_one .panel .panel-heading a:after {
	    content: "\2212"
	}
	.accordion_one .panel .panel-heading a:after,
	.accordion_one .panel .panel-heading a.collapsed:after {
	    font-family: 'FontAwesome';
	    font-size: 15px;
	    width: 36px;
	    height: 48px;
	    line-height: 48px;
	    text-align: center;
	    background: #F1F1F1;
	    float: left;
	    margin-left: -31px;
	    margin-top: -12px;
	    margin-right: 15px
	}
	/* Update font styles */
.panel-title a {
    font-size: 18px;
    font-weight: bold;
    color: #333; /* Change to your preferred text color */
}

.panel-body {
    font-size: 16px;
    line-height: 1.6;
    color: #666; /* Change to your preferred text color */
}

/* Add spacing between elements */
.panel-heading {
    padding: 15px 0;
}

.panel-body {
    padding: 20px 0;
}

/* Add borders and shadows */
.panel {
    border: 1px solid #eaeaea; /* Adjust color as needed */
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Add a subtle shadow */
    margin-bottom: 20px;
}

/* Hover effects */
.panel-title a:hover {
    color: #007bff; /* Change to your preferred hover color */
}

/* Customize accordion icon */
.panel-title a.collapsed:after,
.panel-title a:after {
    content: "\f067"; /* Unicode for FontAwesome minus icon */
    font-family: 'FontAwesome';
    font-size: 14px;
    float: right;
    margin-top: 3px;
}

.panel-title a.collapsed:after {
    content: "\f068"; /* Unicode for FontAwesome plus icon */
}

/* Optional: Add background color to panel headers */
.panel-heading {
    background-color: #f9f9f9; /* Change to your preferred background color */
}
/* Adjustments for the container and panel layout */
.faq-container {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
}

.faq-panel-container {
    width: calc(50% - 20px); /* Adjust width as needed */
    margin-bottom: 20px;
}

/* Style for the panel and accordion */
.faq-panel {
    border: 1px solid #eaeaea; /* Adjust color as needed */
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Add a subtle shadow */
}

.panel-heading {
    background-color: #f9f9f9; /* Change to your preferred background color */
    padding: 15px;
    cursor: pointer;
}

.panel-body {
    padding: 15px;
}

.panel-title a {
    text-decoration: none;
    color: #333; /* Change to your preferred text color */
}

.panel-title a:hover {
    color: #007bff; /* Change to your preferred hover color */
}
/* Adjustments for the container and panel layout */
.faq-container {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
}

.faq-panel-container {
    width: calc(50% - 20px); /* Adjust width as needed */
    margin-bottom: 20px;
}

/* Style for the panel and accordion */
.faq-panel {
    border: 1px solid #eaeaea; /* Adjust color as needed */
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Add a subtle shadow */
}

.panel-heading {
    background-color: #f9f9f9; /* Change to your preferred background color */
    padding: 15px;
    cursor: pointer;
}

.panel-body {
    padding: 15px;
}

.panel-title a {
    text-decoration: none;
    color: #333; /* Change to your preferred text color */
}

.panel-title a:hover {
    color: #007bff; /* Change to your preferred hover color */
}

/* Media query for responsiveness */
@media screen and (max-width: 768px) {
    .faq-panel-container {
        width: 100%; /* Display items in a single column on small screens */
    }
}
/* for google translation  */
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
<!-- <?php include('includes/colorswitcher.php');?> -->
<!-- /Switcher -->  
        
<!--Header-->
<?php include('includes/header.php');?>
<!-- /Header --> 

<!--Page Header-->
<section class="page-header contactus_page">
  <div class="container">
    <div class="page-header_wrap">
      <div class="page-heading">
        <h1>FQA</h1>
      </div>
      <ul class="coustom-breadcrumb">
        <li><a href="#">Home</a></li>
        <li>FAQS</li>
      </ul>
    </div>
  </div>
  <!-- Dark Overlay-->
  <div class="dark-overlay"></div>
</section>
<!-- /Page Header--> 

<!-- FQAS SECTION  -->
<div class="container" style="margin-top: 50px; margin-bottom: 50px;">
<div class="text-center"><h3>FAQs</h3></div>
 <!-- Add heading here -->
    <div class="faq-container">
        <?php 
        $halfCount = ceil(count($faqs) / 2); // Calculate half of the total count of FAQs
        for ($i = 0; $i < $halfCount; $i++):
        ?>
        <div class="faq-panel-container">
            <div class="faq-panel">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion_oneLeft" href="#faq-<?php echo $faqs[$i]['id']; ?>" aria-expanded="false" class="collapsed">
                            <?php echo $faqs[$i]['question']; ?>
                        </a>
                    </h4>
                </div>
                <div id="faq-<?php echo $faqs[$i]['id']; ?>" class="panel-collapse collapse" aria-expanded="false" role="tablist" style="height: 0px;">
                    <div class="panel-body">
                        <?php echo $faqs[$i]['answer']; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endfor; ?>

        <?php for ($i = $halfCount; $i < count($faqs); $i++): ?>
        <div class="faq-panel-container">
            <div class="faq-panel">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion_oneLeft" href="#faq-<?php echo $faqs[$i]['id']; ?>" aria-expanded="false" class="collapsed">
                            <?php echo $faqs[$i]['question']; ?>
                        </a>
                    </h4>
                </div>
                <div id="faq-<?php echo $faqs[$i]['id']; ?>" class="panel-collapse collapse" aria-expanded="false" role="tablist" style="height: 0px;">
                    <div class="panel-body">
                        <?php echo $faqs[$i]['answer']; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endfor; ?>
    </div>
</div>
<!-- END OF FQAS SECTION -->
 
      
      <!--/Side-Bar--> 

<!--Footer -->
<?php include('includes/footer.php');?>
<!-- /Footer--> 

<!--Back to top-->
<div id="back-top" class="back-top"> <a href="#top"><i class="fa fa-angle-up" aria-hidden="true"></i> </a> </div>
<!--/Back to top--> 

<!--Login-Form -->
<?php include('includes/login.php');?>
<!--/Login-Form --> 

<!--Register-Form -->
<?php include('includes/registration.php');?>

<!--/Register-Form --> 

<!--Forgot-password-Form -->
<?php include('includes/forgotpassword.php');?>
<!--/Forgot-password-Form --> 

<!-- Scripts --> 
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script> 
<script src="assets/js/interface.js"></script> 
<!--Switcher-->
<script src="assets/switcher/js/switcher.js"></script>
<!--bootstrap-slider-JS--> 
<script src="assets/js/bootstrap-slider.min.js"></script> 
<!--Slider-JS--> 
<script src="assets/js/slick.min.js"></script> 
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
          google.translate.TranslateElement(
            { pageLanguage: "en" },
            "english_paragraph"
          );
        }
      }
    </script>

    <script
      type="text/javascript"
      src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"
    ></script>

</body>
</html>
