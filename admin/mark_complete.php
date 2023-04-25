<?php 
session_start();
include '../phps/connection.php';


if($_SESSION["user"] == "admin"){
    $tid = $_GET['tid'];
    $query = $mysqli->prepare("UPDATE `transaction` SET `status`='completed' WHERE `tid`= ?");
    $query->bind_param("s",$tid);
    $result = $query->execute();
    $query->close();
    if($result){
     header('location:impoters.php');
    }
    else{
        echo "Please Try Again";
    }
}


if(!isset($_SESSION["user"])){
    echo "You are not Logged In";
    header('location:db.php');
  }
  
mysqli_close($conn);
?>
