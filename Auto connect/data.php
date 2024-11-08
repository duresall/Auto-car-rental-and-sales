<?php

while($row = $result->fetch_assoc())
    {
        $sql2="SELECT * FROM message WHERE (incoming_id = {$row['id']} AND outgoing_id = {$loggedInUserId}) OR (incoming_id = {$loggedInUserId} AND outgoing_id = {$row['id']}) ORDER BY messageId DESC LIMIT 1";
        $result2 = $dbhh->query($sql2);
        if($result2->num_rows > 0){
            $row2 = $result2->fetch_assoc();
            $message=$row2['message'];
        }
       (strlen($message) > 20) ? $trim_message = substr($message, 0, 20) . '...' : $trim_message = $message;

       ($loggedInUserId == $row2['outgoing_id']) ? $you = "You: " : $you = "";
        $output .= '
            <a href="chat-area.php?user_id=' . $row['id'] . '">
                <div class="content">
                <img src="' . (isset($row['photo']) ? $row['photo'] : 'profile.png') . '" alt="User Image">
                    <div class="details">
                        <span>' . $row['FullName'] . '</span>
                        <p>'.$you . $trim_message . '</p>
                    </div>
                </div>
                <div class="status-dot online"><i class="fas fa-circle"></i></div>
            </a>
        ';
    }

?>