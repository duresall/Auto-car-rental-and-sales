<?php
// DB credentials.
define('DATABASEHOST','localhost');
define('DATABASEUSER','root');
define('PASSWORD','');
define('DATABASENAME','carrental');

// Establish database connection.
$dbhh = new mysqli(DATABASEHOST, DATABASEUSER, PASSWORD, DATABASENAME);

// Check connection
if ($dbhh->connect_error) {
    die("Connection failed: " . $dbhh->connect_error);
}
// Set the character set
$dbhh->set_charset("utf8");
?>
