<?php
session_start();
include '../phps/connection.php';
if ($_SESSION["user"] == "admin") {

    $pid = $_GET['pid'];
    $query = "DELETE FROM `product` WHERE pid = '$pid'";
    $result = mysqli_query($conn, $query);
    if($result){
            header("location:admin_products.php");
    }else{
        echo "<h2> There was some problem</h2>";
    }

    if(!$_SESSION["user"] == "admin"){
        header('location:index.php');
    }
    mysqli_close($conn);
}
?> 