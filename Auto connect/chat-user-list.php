<?php
session_start();
error_reporting(0);
include('includes/configtwo.php');
if(strlen($_SESSION['login'])==0)
{ 
    header('location:index.php');
}
else
{
    $loggedInUserId = $_SESSION['id'];
    
    $sql = "SELECT DISTINCT u.id, u.FullName, u.photo, m.message,u.status
    FROM tblusers u
    LEFT JOIN (
        SELECT CASE
                   WHEN incoming_id = $loggedInUserId THEN outgoing_id
                   ELSE incoming_id
               END AS user_id,
               MAX(messageId) AS last_message_id,
               message
        FROM message
        WHERE incoming_id = $loggedInUserId OR outgoing_id = $loggedInUserId
        GROUP BY CASE
                     WHEN incoming_id = $loggedInUserId THEN outgoing_id
                     ELSE incoming_id
                 END
    ) AS m ON u.id = m.user_id
    WHERE m.user_id IS NOT NULL
    ORDER BY m.last_message_id DESC;    
    ";
    
}

$result = $dbhh->query($sql);
$output = ''; 

if($result->num_rows == 0)
{
    $output = "You haven't chatted with anyone ". $loggedInUserId ;
}
else if($result->num_rows > 0)
{
    while($row = $result->fetch_assoc())
    {
        
        $sql2 = "SELECT * FROM message 
        WHERE 
        (incoming_id = {$row['id']} AND outgoing_id = {$loggedInUserId}) 
        OR 
        (incoming_id = {$loggedInUserId} AND outgoing_id = {$row['id']}) 
        ORDER BY messageId DESC LIMIT 1";
        $result2 = $dbhh->query($sql2);
        if($result2->num_rows > 0){
            $row2 = $result2->fetch_assoc();
            $message=$row2['message'];
        }
        $trim_message = (strlen($message) > 20) ? substr($message, 0, 20) . '...' : $message;
        $you = ($loggedInUserId == $row2['outgoing_id']) ? "You: " : "";
        $color = ($loggedInUserId == $row2['outgoing_id']) ? "color: green;" : "color: red";
        if ($row['status'] == "1") {
            $status = "online";
        } else {
            $status = ".offline";
        }
        
        
        $output .= '
            <a href="chat-area.php?user_id=' . $row['id'] . '">
            <div class="content">
                <img src="' . (isset($row['photo']) ? $row['photo'] : 'profile.png') . '" alt="User Image">
                <div class="details">
                    <span>' . $row['FullName'] . '</span>
                    <p style="' . $color . '">'. $you . $trim_message . '</p>
                </div>
            </div>
            <div class="status-dot ' . $status . '"><i class="fas fa-circle"></i></div>
            </a>
        ';
    }

}
echo $output;
?>
