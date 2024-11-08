<?php
session_start(); 
include('includes/configtwo.php');

if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
    $loggedInUserId = $_SESSION['id'];
    $sql = "UPDATE tblusers SET status = 0 WHERE id = $loggedInUserId";
    $result = $dbhh->query($sql);
}
$_SESSION = array();
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 60*60,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
unset($_SESSION['login']);
session_destroy();
header("location:index.php"); 
?>


