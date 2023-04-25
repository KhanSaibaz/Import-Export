<?php
session_start();
include 'phps/connection.php';


$results_per_page = 4;
$cart_count = '';
if (!empty($_SESSION["shopping_cart"])) {
  $cart_count = count(array_keys($_SESSION["shopping_cart"]));
}
if(!empty($_SESSION['temp'])){
  unset($_SESSION['temp']);
}
    $query = "SELECT * FROM `product`";
    $result = mysqli_query($conn, $query);
    $number_of_result = mysqli_num_rows($result);
    $number_of_page = ceil($number_of_result/$results_per_page);
    if (!isset($_GET['page'])){
      $page = 1;
    }else{
      $page = $_GET['page'];
    }
    $page_first_result = ($page -1 ) * $results_per_page;
    $query1 = "SELECT * FROM product LIMIT ".$page_first_result.",".$results_per_page;
    $result1 = mysqli_query($conn, $query1);
    echo "
    <!doctype html>
    <html lang='en'>
    <head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>IMPORT EXPORT</title>
    <link href='style.css' rel='stylesheet'>
    <link rel='icon' href='icon.ico' type='image/icon type'>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD' crossorigin='anonymous'>
    <link href='./css/style1.css' rel='stylesheet'>
    
    <style>
      @media screen and (max-width: 1199px ) {
      .myboxs{
      justify-content: center;
    
    }
      }
      @media screen and (max-width: 778px ) {

      .myboxs1{
        display:block;
        margin:auto;
        align:center;
        color:red;
      max-width:280px;
      margin:0px 30px;
      justify-content: center;

      }
    }
    
    </style>
          </head>
          <body>";
          // <img src="images/logo.png" style="width: 160px;" alt="Famous" class="img-fluid">
          echo '
          <header id="header" class="fixed-top">
          <div class="container d-flex align-items-center justify-content-between">
          
          <a href="index.php">
      <img src="images/logos.png" style="width: 160px;" alt="Famous" class="img-fluid">
      </a>
          
          
          <nav id="navbar" class="navbar ">
          
          <a class=" nav-link scrollto " href="phps/cart.php">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
              <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
              </svg>&nbsp
              <span>'.(($cart_count)?$cart_count: '0').'</span>
              </a>
              
              <i class="bi bi-list mobile-nav-toggle"></i>
              </nav>
              
              </div>
    </header>      
            
    <section id="hero" class="d-flex align-items-center myboxs mt-2">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 pt-5 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center">
        <h1>IMPORT EXPORT FRUITS  </h1>
        <h2> Import-export made simple.Your gateway to global trade!</h2>
        <div class="d-flex">
        <a href="about.php" class="btn-get-started scrollto text-decoration-none">About Us</a>
        <a href="phps/login.php" class="btn-get-started scrollto mx-3 text-decoration-none">Login </a>
        </div>
        </div>
        <div class="col-lg-6 order-1 order-lg-2 hero-img">
        <img src="images/hero-img.png" class="img-fluid animated" alt="">
        </div>
        </div>
        </div>
        
        </section>';
        if ($count = mysqli_num_rows($result1) > 0) {
          echo "  
          <div class='row row-cols-1 row-cols-md-4 m-0 myboxs'>";
        while($r = mysqli_fetch_assoc($result1)){
        $string =$r['discount'];
        $new_string = str_replace("%", "", $string);
        $discounts=($r['price']*$new_string)/100;
        $ds=$r['price']-$discounts;
        
          // $discount_price = ($r['price']*100)/$r['discount'] 
          echo "<form name='productitemlist' method='get' class='py-3' action='phps/product_details.php' style='min-width:300px;''>
                <input type='hidden' name='pid' value=' ".$r['pid']." '/>
                <button type='submit' class='btn myboxs'>";
          echo '
                  <div class="row row-cols-1 row-cols-md-1 myboxs1 " >
                    <div class="col">
                        <div class="card">
                            <img src=" '.$r['image'].' " class="card-img-top myimages" alt="..." style="min-width:250px;">
                            <div class="card-body">
                                <h5 class="card-title">'.$r['prod_name'].'</h5>
                                <h5 class="card-title text-secondary mb-1">Avaliable = '.$r['quantity'].'</h5>
                            </div>
                            <div class=" d-flex justify-content-around mb-2">
                              <h5> Price= '.$r["price"].'/Kg </h5>
                              <h5 class="text-danger"> '.$r["discount"].'Off </h5>
                            </div>  
                            <p class="card-title text-light mb-3 bg-dark py-1  w-50 mx-auto h-25  rounded-pill">View </p>

                        </div>
                    </div>
                  </div>
          </button>
        </form> ';

               

              }

                echo "
                </div>
                    <div class='container'>
                    <ul class='pagination justify-content-center'>
                    <li class='page-item ".(($page == 1)? 'disabled' : '')."'><a class='page-link' href='index.php?page=". (($page == 1)? '1' : $page - 1) ."'>Previous</a></li>
                    ";
                    for($page_no = 1; $page_no<= $number_of_page; $page_no++) {  
                     echo " <li class='page-item ".(($page == $page_no)? 'active' : '')."'><a class='page-link' href='index.php?page=". $page_no ."'>". $page_no ."</a></li>";
                    }  
                    echo "<li class='page-item ".(($page == $number_of_page || $number_of_result == $results_per_page)? 'disabled' : '')."'><a class='page-link' href='index.php?page=". (($page == $number_of_page || $number_of_result == $results_per_page)? '' : $page + 1)."'>Next</a></li>
                    </ul>
                  </div>
                ";
    }else{
      echo "<h1 class='text-center mt-4'>Sorry! There are no products currently.</h1>
      </div>";
    }

  mysqli_close($conn);
include 'phps/footer.php';

?>
    </div>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js' integrity='sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN' crossorigin='anonymous'></script>
  </body>
</html>

