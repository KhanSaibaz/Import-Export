<?php
session_start();
include '../phps/connection.php';

echo "<!doctype html>
<html lang='en'>
    <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <title>Delete Product</title>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD' crossorigin='anonymous'>
    </head>
    <body>";

if($_SESSION["user"] == "admin"){
    include 'admin_navbar.php';
  

    echo  "<div class='col-sm-5 m-auto'>
    <h1 class='text-center my-2'>DELETE AN ITEM</h1>
    <hr>";
    ?>
  <form  action='<?php $_SERVER['PHP_SELF']?>' method='POST'>
      <?php
echo

    "<div class='container text-center'  style='background: #c0b7b787; padding: 10px; border-radius: 10px; box-shadow: 2px 5px 8px black;'>
                <div class='row my-4'>
                  <div class='col-sm-4'>
                    <label class='form-label'>Product ID</label>
                  </div>
                  <div class='col-sm-8'>
                    <input type='text' class='form-control'  name='pid' placeholder='Enter Product ID'>
                  </div>
                </div>
                <div class='text-center mt-2'>
                <button type='submit' name='delete' class='btn btn-dark mb-2'>Show Data</button>
              </div>
              </div>


    </form>
  </div>
  </div>";  
}

if(isset($_POST['delete']))
{
  $pid = $_POST['pid'];
  $query = "SELECT * FROM `product` WHERE pid = '$pid'";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_assoc($result);  
  $count = mysqli_num_rows($result);

  if ($count == 1) {
    echo "
    <div class='card mt-5 mb-3 w-75 justify-content-center' style='background: #c0b7b787; padding: 10px; border-radius: 10px; box-shadow: 2px 5px 8px black; margin: auto;'>

    <div class='row g-0 mt-4'>
    <div class='col-md-4 mt-4'>
    <img src='../".$row['image']."' class='img-fluid rounded-start h-75 mt-4 mx-5'>
    </div>
    <div class='container col-sm-6'>
    <h1 class='text-center mb-2 fw-semibold'>Confirm Details</h1>
    <form action='deleteconfirm.php' method='get'>


    <div class='container text-center'>
            <div class='row mt-2'>
                  <div class='col-sm-4'>
                    <label for='FormControlInput1' class='form-label '>Product ID</label>
                  </div>
                <div class='col-sm-8'>
                  <input type='text' class='form-control text-center' readonly value='".$row['pid']."' id='FormControlInput1' name='pid'>
                </div>
              </div>
      </div>

                  
      
      <div class='container text-center'>
        <div class='row mt-2'>
          <div class='col-sm-4'>
            <label for='FormControlInput2' class='form-label'>Product Name</label>
           </div>
                <div class='col-sm-8'>
                  <input type='text' class='form-control text-center' readonly  value='".$row['prod_name']."' id='FormControlInput2' name='pname' >
                </div>
        </div>
      </div>
      
      <div class='container text-center'>
              <div class='row mt-2'>
                <div class='col-sm-4'>
                  <label for='FormControlInput6' class='form-label'>Price</label>
                </div>
                <div class='col-sm-8'>
                  <input type='text' class='form-control text-center' readonly  value='".$row['price']."' id='FormControlInput6' name='' >
                </div>
                </div>
                </div>
      
            <div class='container text-center'>
              <div class='row mt-2'>
                <div class='col-sm-4'>
                  <label for='FormControlInput7' class='form-label '>Description</label>
                </div>
                <div class='col-sm-8'>
                  <textarea class='form-control text-center' rows='5' readonly >".$row['description']."</textarea>
                </div>
              </div>
            </div>
          <div class='text-center mt-3 mb-3 '>
              <button type='submit' class='btn btn-danger'>Delete</button>
              <a class='btn btn-light' href='admin_products.php'>Cancel</a>
        </div>
      </form>
      </div>
      </div>
      </div>";
  }else{
    echo  "<h2 class='text-center mt-4'> There is no matching item for that Product ID <h2>";
  }
}
if(!isset($_SESSION["user"])){
    echo "You are not Logged In";
    header('location:index.php');
  }
  
  mysqli_close($conn);

?>