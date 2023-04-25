<?php
session_start();
include 'conn.php';
if($_SESSION["user"] == "admin"){
$tid = $_GET['tid'];
$query = "SELECT * FROM `transaction` WHERE tid = '$tid'";
$result = mysqli_query($conn,$query);
$r = mysqli_fetch_assoc($result);
if ($count = mysqli_num_rows($result) > 0) {
echo "
        <!doctype html>
        <html lang='en'>
            <head>
                <meta charset='utf-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1'>
                    <title>Transaction Details</title>
                <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD' crossorigin='anonymous'>
            </head>
            <body>

            <div class='container'>
            <h3 class='text-center'> Transaction Details</h3>
            <div class='container text-center'>
                <div class='row'>
                    <div class='col'>
                        <label>Transaction ID</label>
                    </div>
                    <div class='col'>
                        <p>".$r['tid']."</p>
                    </div>
                </div>
            </div>
                
            <div class='container text-center'>
                <div class='row'>
                    <div class='col'>
                        <label>Name</label>
                    </div>
                    <div class='col'>
                        <p>".$r['c_name']."</p>
                    </div>
                </div>
            </div>

            <div class='container text-center'>
                <div class='row'>
                    <div class='col'>
                        <label>Mobile No</label>
                    </div>
                    <div class='col'>
                        <p>".$r['mobile_no']."</p>
                    </div>
                </div>
            </div>

            <div class='container text-center'>
                <div class='row'>
                    <div class='col'>
                        <label>Address</label>
                    </div>
                    <div class='col'>
                        <p>".$r['address']."</p>
                    </div>
                </div>
            </div>

            <div class='container text-center'>
                <div class='row'>
                    <div class='col'>
                        <label>Amount</label>
                    </div>
                    <div class='col'>
                        <p>".$r['amount']."</p>
                    </div>
                </div>
            </div>

            <div class='container text-center'>
                <div class='row'>
                    <div class='col'>
                        <label>Date</label>
                    </div>
                    <div class='col'>
                        <p>".$r['date']."</p>
                    </div>
                </div>
            </div>


            <div class='container text-center'>
                <div class='row'>
                    <div class='col'>
                        <label>Status</label>
                    </div>
                    <div class='col'>
                        <a class='btn ".(($r['status'] == 'pending')? " btn-success' href='mark_complete.php?tid=$tid' > Mark Complete" : " btn-secondary' disabled > Completed")."</a>
                    </div>
                </div>
            </div>

            <div class='row mt-3'>
                ";
                $query1 = "SELECT * FROM `transaction_product_details` WHERE tid = '$tid'";
                $result2 = mysqli_query($conn,$query1);
                
                while ($row = mysqli_fetch_assoc($result2)){
                                    
                    echo "
                    <div class='col-sm-4 mb-3 mb-sm-0'>
                    <div class='card h-100' style='width: 18rem;'>";
                    $rpid = $row['pid'];
                    $query3 = "SELECT name, price, image FROM `product` WHERE pid = '$rpid'";
                    $result3 = mysqli_query($conn, $query3);
                    $d = mysqli_fetch_assoc($result3);
                    echo "
                    <img src='".$d['image']."' class='card-img-top'>
                    <div class='card-body'>
                    <h5 class='card-title'>Name : ".$d['name']."</h5>
                    <p class='cart-text'>Price : ".$d['price']."</p>
                    <p class='card-text'>Product ID : ".$row['pid']." Quantity : ".$row['quantity']."</p>
                    <p class='card-text'>Size : ".$row['size']."</p>
                    </div>
                    </div>
                    </div>";
                }
                echo "
                
            </div>

            </div>
                <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js' integrity='sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN' crossorigin='anonymous'></script>
            </body>
        </html>
";
}

}

if(!isset($_SESSION["user"])){
  echo "You are not Logged In";
  header('location:db.php');
}


mysqli_close($conn);
?>
