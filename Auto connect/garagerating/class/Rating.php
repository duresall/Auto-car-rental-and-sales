<?php


class Rating{
    Private $host="localhost";
    Private $databasename="carrental";
    private $username="root";
    private $password= "";
    private $userTable="tblusers";
    private $garageownerTable="garageowner";
    Private $garageRatingTable="garage_rating";
    private $dbconnection=false;

    public function __construct(){
        if(!$this->dbconnection){
            $conn= new mysqli($this->host,$this->username,$this->password,$this->databasename);

            if($conn->connect_error){
                die("Error faild to connect to the database " .$conn->connect_error);
            }else{
                $this->dbconnection= $conn;
            }
        }
    }
       //for this part i wrote it so yall can understand this is feteching data from the database 
       private function getData($sql){
        $result= mysqli_query($this->dbconnection,$sql);
        if(!$result){
            die("Error while feteching ".mysqli_error());
        }
            $date=array();
            while($row= mysqli_fetch_array($result)){
               $data[]=$row;
            
        }
        return $data;
       }
         //know lets fetech the number of rows its actually the same as the privouse one with some minor change
         private function getNumRow($sql){
            $result = mysqli_query($this->databasename,$sql);

            if(!$restult){
                die("query problem ". mysqli_error());
            }
            $numRows=mysqli_num_rows($result);
              return $numRows;
         }
        //now this part of the code is geting the list of garages 
        public function getGarageList(){
            $sql = "
                SELECT * FROM ".$this->garageownerTable;
            return  $this->getData($sql);	
        }
        
        public function getgarage($garageId){
            $sql = "
                SELECT * FROM ".$this->garageownerTable."
                WHERE id='".$garageId."'";
            return  $this->getData($sql);	
        }
        public function getGarageRating($garageId){
            $sql = "
                SELECT r.ratingId, r.ratingNumber, r.userId, r.garageId, u.FullName,  r.title, r.comments, r.created
                FROM ".$this->garageRatingTable." as r
                LEFT JOIN ".$this->userTable." as u ON (r.userId = u.id)
                WHERE r.garageId = '".$garageId."'";
            return  $this->getData($sql);		
        }
        public function getRatingAverage($garageId){
            $garageRating = $this->getGarageRating($garageId);
            $ratingNumber = 0;
            $count = 0;		
            foreach($garageRating as $garageRatingDetails){
                $ratingNumber+= $garageRatingDetails['ratingNumber'];
                $count += 1;			
            }
            $average = 0;
            if($ratingNumber && $count) {
                $average = $ratingNumber/$count;
            }
            return $average;	
        }
        public function saveRating($POST, $userID){		
            $insertRating = "INSERT INTO ".$this->garageRatingTable." (garageId, userId, ratingNumber, title, comments, created) VALUES ('".$POST['garageId']."', '".$userID."', '".$POST['rating']."', '".$POST['title']."', '".$POST["comment"]."', '".date("Y-m-d H:i:s")."')";
            mysqli_query($this->dbconnection, $insertRating);	
        }
}
?>