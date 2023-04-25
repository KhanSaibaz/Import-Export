<?php
session_start();
include '../phps/connection.php';
$cart_count = '';
$status = '';
$pid = $_GET['pid'];

if (!empty($_SESSION["shopping_cart"])) {
  $cart_count = count(array_keys($_SESSION["shopping_cart"]));
}


if (isset($_POST["action"]) and $_POST["action"] == "cart") {
  $pid = $_POST['pid'];
  $name = $_POST['name'];
  $price = $_POST['price'];
  $image = $_POST['image'];
  $weight = $_POST['weight'];
  $discount = $_POST['discount'];
  $cartArray = array(
    $pid => array(
      'pid' => $pid,
      'image' => $image,
      'name' => $name,
      'price' => $price,
      'quantity' => 1,
      'weight' => $weight,
      'discount' => $discount
      )
    );
    if (empty($_SESSION["shopping_cart"])) {
      $_SESSION["shopping_cart"] = $cartArray;
      $status = "<div class='box'>New Product is added to your cart!</div>";
    } else {
      $array_keys = array_keys($_SESSION["shopping_cart"]);
      if (in_array($pid, $array_keys) ) {
                $status = "<div class='box' style='color:red;'>
                Product is already added to your cart!</div>";
      } else {
        $_SESSION["shopping_cart"] = array_merge($_SESSION["shopping_cart"], $cartArray);
        $status = "<div class='box'>Product is added to your cart!</div>";
      }
    }
    if (!empty($_SESSION["shopping_cart"])) {
      $cart_count = count(array_keys($_SESSION["shopping_cart"]));
    }
  }

          echo '<!doctype html>
          <html lang="en">
            <head>
              <meta charset="utf-8">
              <meta name="viewport" content="width=device-width, initial-scale=1">
              <title>Product</title>
              <link rel="stylesheet" href="style.css">
              <link rel="icon" href="icon.ico" type="image/icon type">
              <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
            </head>
            <body>
            <header id="header" class="fixed-top">
      <div class="container d-flex align-items-center justify-content-between">
      <a href="index.php">
      <img src="../images/logos.png" style="width: 160px;" alt="Famous" class="img-fluid">
      </a>      
  


  
        <nav id="navbar" class="navbar">
         <a class=" nav-link scrollto " href="cart.php">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
              <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
              </svg>&nbsp
              <span>'.(($cart_count)?$cart_count: '0').'</span>
            </a>
          <i class="bi bi-list mobile-nav-toggle"></i>
        </nav>
  
      </div>
    </header>
    <section>
            <div class="container text-center">'.(($status)?$status:'').'</div>
            <div class="card" >
              <div class="row g-0">
                  <div class="col-md-4">';
                
            $sql = "SELECT * FROM `product` WHERE pid = $pid";
            $result = mysqli_query($conn, $sql);
            $row_count = mysqli_num_rows($result);
            $row = mysqli_fetch_assoc($result);
            $r = $row;
            echo "
            <img src='../".$r['image']."' width='250'  height='150' class='img-fluid rounded-start  mt-5 mx-5'>
            </div>
            <div class='col-md-8 align-items-center d-flex justify-content-center'>
            <div class='card-body align-items-center'>
            <h2 class='card-title mb-0'><b>".$r['prod_name']."</b></h2>
            <p class='card-text'>
            <h5>About This Item:</h5>
            <ul>";
              $string =$r['discount'];
              $new_string = str_replace("%", "", $string);
              $discounts=($r['price']*$new_string)/100;
              $ds=$r['price']-$discounts;
            echo "<li>";
            echo $r['description'];
            echo "</li></ul>";
            echo "
            
            <div class='d-flex align-items-center'>
            <h5><strike>Original Price : </h5> <h3>&#8377;".$r['price']."/KG</strike></h3>
            </div>
            <div class='d-flex align-items-center'>
            <h5>New Price : </h5> <h3>&#8377;".$ds."/KG</h3>
            </div>
            
            <form method='post' action=''>
              <input type='hidden' value='cart' name='action' />
              <input type='hidden' value='".$r['pid']."' name='pid' />
              <input type='hidden' value='".$r['prod_name']."' name='name' />
              <input type='hidden' value='".$r['price']."' name='price' />
              <input type='hidden' value='".$r['image']."' name='image' />
              <input type='hidden' value= '".$ds."' name='discount' />
              <div class='d-flex'>
                <p class=' my-auto col-sm-1'>kilogram </p>
              <div class='col-sm-3'>
              <input class='form-control' type='text' name='weight' required placeholder='Kgs'>
              </div>
              </div>
              <div class='container-fluid'>
                <button type='submit' class='btn btn-warning w-100 m-2' >Add to Cart</button>
                <a class='btn btn-light w-100 m-2' href='../index.php'>Go back</a>
            </form>
                </p>
                </div>
                </div>
                </div>
                </div>
                </section>
                            ";
                            
                            mysqli_close($conn);
include 'footer.php';

                          ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>