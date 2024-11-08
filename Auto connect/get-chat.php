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
// $output="";
// $sql="SELECT * FROM message 
// WHERE (outgoing_id = {$outgoing_id} AND incoming_id = {$incoming_id}) 
// OR (outgoing_id = {$incoming_id} AND incoming_id = {$outgoing_id}) ORDER BY messageId asc";
// $result=$dbhh->query($sql);
// if($result->num_rows> 0){
//     while($row=$result->fetch_assoc()){
//         if($row['outgoing_id']===$outgoing_id){
//             $output .= '<div class="chat outgoing">
//                        <div class="details">
//                           <p>'.$row['message'].'</p>
//                        </div>
//                        </div>';

//               }else{
//                   $output .= '<div class="chat incoming">
//             <img src="profile.png" alt="">
//             <div class="details">
//                 <p>'.$row['message'].'</p>
//             </div>
//         </div>';
//         }
       
//     }
//     echo $output;
// }else{
//     $output .= 'No messages are available.';
//     echo $output;
// }

// }

session_start();
error_reporting(0);
include('includes/configtwo.php');
if(strlen($_SESSION['login'])==0)
  { 
header('location:index.php');
}
else{

$outgoing_id=mysqli_real_escape_string($dbhh,$_POST['outgoing_id']);
$incoming_id=mysqli_real_escape_string($dbhh,$_POST['incoming_id']);
$output="";
$sql="SELECT * FROM message 
WHERE (outgoing_id = {$outgoing_id} AND incoming_id = {$incoming_id}) 
OR (outgoing_id = {$incoming_id} AND incoming_id = {$outgoing_id}) ORDER BY messageId asc";
$result=$dbhh->query($sql);
if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        if($row['outgoing_id'] === $outgoing_id){
            if(strtolower(pathinfo($row['message'], PATHINFO_EXTENSION)) === 'jpg' || strtolower(pathinfo($row['message'], PATHINFO_EXTENSION)) === 'png'){
                $output .= '<div class="chat outgoing">
                               <div class="details">
                                  <img src="'.$row['message'].'" alt="" class="full-screen-img" onclick="showFullScreen(this)">
                               </div>
                           </div>';
            } else if(strtolower(pathinfo($row['message'], PATHINFO_EXTENSION)) === 'pdf'){
                $output .= '<div class="chat outgoing">
                               <div class="details">
                                  <a href="'.$row['message'].'" target="_blank">View PDF</a>
                               </div>
                           </div>';
            } else {
                $output .= '<div class="chat outgoing">
                               <div class="details">
                                  <p>'.$row['message'].'</p>
                               </div>
                           </div>';
            }
        } else {
            $output .= '<div class="chat incoming">
                            <img src="profile.png" alt="">
                            <div class="details">
                                <p>'.$row['message'].'</p>
                            </div>
                        </div>';
        }
    }
    echo $output;
} else {
    $output .= 'No messages are available.';
    echo $output;
}


}


?>