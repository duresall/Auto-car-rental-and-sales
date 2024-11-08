<?php

require "../vendor/autoload.php";

use Infobip\Configuration;
use Infobip\Api\SmsApi;
use Infobip\Model\SmsDestination;
use Infobip\Model\SmsTextualMessage;
use Infobip\Model\SmsAdvancedTextualRequest;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

session_start(); // Start the session
include('includes/configtwo.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);
file_put_contents('debug.log', print_r($_POST, true));

?>
