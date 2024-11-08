<?php
include('includes/configtwo.php');


if($_SERVER["REQUEST_METHOD"] == "POST"){
    $garage_id=$_POST["garage_id"];
    $selectPlace= $_POST["place"];
    $platenumber= $_POST["plate"];
    // Check if file was uploaded without errors
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        echo "File upload error: " . $_FILES["image"]["error"];
        $target_dir = "uploads/";
        $imagename=$_FILES["image"]["name"];
        $target_file = $target_dir .$imagename;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
        /*
        // Check file size
        if ($_FILES["image"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        */
        
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
        echo $garage_id;
    echo $selectPlace;
  
    echo $platenumber;
  
    $query = "SELECT * FROM account WHERE id=$garage_id";
    $result= mysqli_query($dbhh,$query);
    if($result){
        if(mysqli_num_rows($result)>0){
            while($row=mysqli_fetch_assoc($result)){
                echo "user ".$row["Role"];
            }
        }
        
    }
      //query for inserting the request in to a request table from which the garage can retrive from and respones
      $queryRequest= "INSERT INTO `request`( `seller_id`, `garage_id`, `message`, `recomandation`, `image`)
      VALUES ('2','$garage_id','$platenumber','$selectPlace',' $target_file')";
      if ($dbhh->query($queryRequest) === TRUE) {
        
         echo "New record created successfully";
         header("Location: index.php");
    exit();
     } else {
         echo "Error: " . $queryRequest . "<br>" . $dbhh->error;
     }
    } else {
        echo "No file uploaded or an error occurred while uploading.";
    }
} else {
    echo "Invalid request method.";
}

    
  
    
    // Close connection
    $dbhh->close();
?>