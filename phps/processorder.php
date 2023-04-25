<?php
session_start();
include 'connection.php';
$name = $_POST['name'];
$mobile = $_POST['mobile_no'];
$address = $_POST['address'];
$total_price = $_POST['total_price'];
$status = "pending";

if(isset($_POST['name'])){
    
$query = $mysqli->prepare("INSERT INTO `transaction`(`c_name`, `mobile_no`, `address`, `amount`, `status`) VALUES (?, ?, ?, ?, ?)");
$query->bind_param("sssss",$name, $mobile, $address, $total_price, $status);
$result = $query->execute();
$query->close();   
$query2 = $mysqli->prepare("INSERT INTO `transaction_product_details`(`tid`, `pid`, `quantity`, `weight`) VALUES (?,?,?,?)");
$last_id = $mysqli->insert_id;
foreach($_SESSION["shopping_cart"] as $p){
    $pid = $p['pid'];
    $quan = $p['quantity'];
    $weight = $p['weight'];
    $query2->bind_param("iiii",$last_id, $pid, $quan, $weight);
    $result2 = $query2->execute();
}


$sql="SELECT * FROM product WHERE pid='$pid'";
$res=mysqli_query($conn,$sql);
while($r = mysqli_fetch_assoc($res)){
    $up_quantity=$r['quantity'];
}
$new_quantity=$up_quantity-$weight;
$sql1="UPDATE product SET quantity='$new_quantity Kg' WHERE pid='$pid'";
$res1=mysqli_query($conn,$sql1);


if($result && $result2){
    echo $quan;
    session_destroy();
    header('location:thankyou.php');
    setcookie("Ordersuccessful", 1, time()+5);
}else{
    header('location:order.php');
}
$query2->close();
mysqli_close($conn);
}

include 'footer.php';


?>