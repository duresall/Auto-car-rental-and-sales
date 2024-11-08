<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
file_put_contents('debug.log', print_r($_POST, true));

include('includes/configtwo.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:../index.php');
}
else
{
    $msg="";
    $error="";
    if (isset($_POST["submit"])) {
        $question = $_POST["question"];
        $answer = $_POST["answer"];
    
        // Prepare the SQL statement with placeholders
        $sql = "INSERT INTO fqa (question, answer) VALUES (?, ?)";
    
        // Prepare the statement
        $stmt = $dbhh->prepare($sql);
    
        // Bind the parameters
        $stmt->bind_param("ss", $question, $answer);
    
        // Execute the statement
        if ($stmt->execute()) {
            $msg = "added successfully";
        } else {
            $error = "Something went wrong. Please try again.";
        }
    }
    
?>

<!DOCTYPE HTML>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="theme-color" content="#3e454c">

    <title>Auto Car Rental and Sales | Admin Manage FQAs</title>

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
    <!-- Admin Style -->
    <link rel="stylesheet" href="css/style.css">

    <style>
        .errorWrap {
            padding: 10px;
            margin: 0 0 20px 0;
            background: #fff;
            border-left: 4px solid #dd3d36;
            -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
            box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
        }

        .succWrap {
            padding: 10px;
            margin: 0 0 20px 0;
            background: #fff;
            border-left: 4px solid #5cb85c;
            -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
            box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
        }

        .panel-heading {
            background-color: #f5f5f5;
            border-bottom: 1px solid #ddd;
            padding: 10px 15px;
        }

        .panel-body {
            padding: 15px;
        }

        .form-horizontal .control-label {
            padding-top: 7px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .btn-primary {
            background-color: #337ab7;
            border-color: #2e6da4;
        }

        .btn-primary:hover {
            background-color: #286090;
            border-color: #204d74;
        }
    </style>

</head>

<body>
    <?php include('includes/header.php'); ?>
    <div class="ts-main-content">
        <?php include('includes/leftbar.php'); ?>
        <div class="content-wrapper">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-12">

                        <h2 class="page-title">Manage FQA </h2>

                        <div class="row">
                            <div class="col-md-10">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Form fields</div>
                                    <div class="panel-body">
                                        <form method="post"  class="form-horizontal">
                                            <?php if ($error) { ?>
                                                <div class="errorWrap"><strong>ERROR</strong>: <?php echo htmlentities($error); ?> </div>
                                            <?php } else if ($msg) { ?>
                                                <div class="succWrap"><strong>SUCCESS</strong>: <?php echo htmlentities($msg); ?> </div>
                                            <?php } ?>

                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Enter Question</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="question" class="form-control" required />
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Enter Answer</label>
                                                <div class="col-sm-8">
                                                    <textarea name="answer" id="answer" class="form-control" ></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-sm-8 col-sm-offset-4">
                                                <input type="submit" name="submit" class="btn btn-info" value="Add FAQ" />
                                                </div>
                                            </div>
                                        </form>

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
    <script type="text/JavaScript">
        // JavaScript functions here
    </script>
    <script type="text/javascript" src="nicEdit.js"></script>
    <script type="text/javascript">
        bkLib.onDomLoaded(function() {
            nicEditors.allTextAreas()
        });
    </script>
    <script src="/richtext/jquery.richtext.js"></script>
    <script>
	// initialize rich text library
	window.addEventListener("load", function () {
		$("#answer").richText();
	});
</script>
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

<?php } ?>