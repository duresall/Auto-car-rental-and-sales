<?php
// session_start();
// error_reporting(0);
// include('includes/configtwo.php');
// if(strlen($_SESSION['login'])==0)
//   { 
// header('location:index.php');
// }
// else{

// $outgoing_id=mysqli_real_escape_string($dbhh,$_POST['outgoing_id']);
// $incoming_id=mysqli_real_escape_string($dbhh,$_POST['incoming_id']);
// $message=mysqli_real_escape_string($dbhh,$_POST['message']);
// if(!empty($message)){
//     $sql = "INSERT INTO message (outgoing_id, incoming_id, message) VALUES ({$outgoing_id}, {$incoming_id}, '{$message}')";
//     $result=$dbhh->query($sql);
// }
// }
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

include('includes/configtwo.php');

if(strlen($_SESSION['login']) == 0) { 
    header('location:index.php');
} else {
    $outgoing_id = isset($_POST['outgoing_id']) ? mysqli_real_escape_string($dbhh, $_POST['outgoing_id']) : null;
    $incoming_id = isset($_POST['incoming_id']) ? mysqli_real_escape_string($dbhh, $_POST['incoming_id']) : null;
    $message = isset($_POST['message']) ? mysqli_real_escape_string($dbhh, $_POST['message']) : null;

    // Check if file is uploaded
    if (!empty($_FILES['file']['name'])) {
        // Handle file upload
        $targetDir = "./users/folder/"; // Specify your target directory
        $fileName = basename($_FILES['file']['name']);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        // Allow certain file formats
        $allowedFormats = array("jpg", "jpeg", "png", "pdf"); // Add more formats as needed

        if (in_array(strtolower($fileType), $allowedFormats)) {
            // Move the file to the target directory
            if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)) {
                // File uploaded successfully, now save the message with file path
                $message = $targetFilePath;
            } else {
                echo "File upload failed.";
            }
        } else {
            echo "Invalid file format. Allowed formats: " . implode(", ", $allowedFormats);
        }
    }
    // Save the message to the database
    if ($outgoing_id !== null && $incoming_id !== null) {
        $sql = "INSERT INTO message (outgoing_id, incoming_id, message) VALUES ($outgoing_id, $incoming_id, '$message')";
        $result = $dbhh->query($sql);
    }
}

?>