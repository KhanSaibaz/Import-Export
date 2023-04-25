<?php
session_start();
include 'conn.php';
if($_SESSION["user"] == "admin"){
    if(isset($_POST['name'])){
      $pid = $_POST['pid'];
      $name= $_POST['name'];
      $price= $_POST['price'];
      $desc= $_POST['desc'];
      $image= $_POST['image'];
      $query = $mysqli->prepare("UPDATE `product` SET `name`=?,`price`=?,`image`=?,`description`=? WHERE `pid` = ?");
      $query->bind_param("sssss", $name, $price, $image, $desc, $pid);
      $result0 = $query->execute();
      if($result0){
        header("location:admin.php");
      }else{
        echo "There was some problem";
      }
      $query->close();
    }
    mysqli_close($conn);
}

if(!$_SESSION["user"] == "admin"){
  header('location:db.php');
}
  
  ?>