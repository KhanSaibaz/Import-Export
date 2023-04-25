<?php
session_start();
include 'conn.php';

    $results_per_page = 12;
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
    $query1 = "SELECT * FROM message ORDER BY mid DESC LIMIT ".$page_first_result.",".$results_per_page;
    $result1 = mysqli_query($conn, $query1);
    
if($_SESSION["user"] == "admin"){
  echo "<!doctype html>
  <html lang='en'>
      <head>
          <meta charset='utf-8'>
          <meta name='viewport' content='width=device-width, initial-scale=1'>
          <title>Messages</title>
          <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD' crossorigin='anonymous'>
      </head>
      <body>";

  echo "<nav class='navbar navbar-expand-lg bg-body-tertiary'>
  <div class='container-fluid'>
    <a class='navbar-brand' href='admin.php'>Famous</a>
    <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarNavAltMarkup' aria-controls='navbarNavAltMarkup' aria-expanded='false' aria-label='Toggle navigation'>
      <span class='navbar-toggler-icon'></span>
    </button>
    <div class='collapse navbar-collapse justify-content-end' id='navbarNavAltMarkup'>
      <div class='navbar-nav'>
        <a class='nav-link' aria-current='page' href='admin.php'>Orders</a>
        <a class='nav-link active' aria-current='page' href='messages.php'>Messages</a>
        <a class='nav-link' aria-current='page' href='products.php'>Products</a>
        <a class='nav-link' href='addproduct.php'>Add Product</a>
        <a class='nav-link' href='deleteproduct.php'>Delete Product</a>
        <a class='nav-link' href='editproduct.php'>Edit Product</a>
        <a class='btn btn-danger' href='logout.php'>Log out</a>
      </div>
    </div>
  </div>
</nav>";

if ($count = mysqli_num_rows($result1) > 0) {
echo "
<div class='table-responsive-lg'>
<table class='table table-striped'>
<thead>
  <tr>
    <th scope='col'>Message ID</th>
    <th scope='col'>Name</th>
    <th scope='col'>Subject</th>
    <th scope='col'>Email</th>
    <th scope='col'>Message</th>
  </tr>
</thead>
<tbody>
  <tr>";
  while($r = mysqli_fetch_assoc($result1)){
    echo "
    <th scope='row'>".$r['mid']."</th>
    <td>".$r['name']."</td>
    <td>".$r['subject']."</td>
    <td>".$r['email']."</td>
    <td>".$r['message']."</td>
    </tr>";
  }
  echo "
    </tbody>
    </table>
    </div>
    <div class='container'>
    <ul class='pagination justify-content-center'>
    <li class='page-item ".(($page == 1)? 'disabled' : '')."'><a class='page-link' href='products.php?page=". (($page == 1)? '1' : $page - 1) ."'>Previous</a></li>";
    for($page_no = 1; $page_no<= $number_of_page; $page_no++) {  
      echo " <li class='page-item ".(($page == $page_no)? 'active' : '')."'><a class='page-link' href='products.php?page=". $page_no ."'>". $page_no ."</a></li>";
    }  
    echo "<li class='page-item ".(($page == $number_of_page || $page == 1)? 'disabled' : '')."'><a class='page-link' href='products.php?page=". (($page == $number_of_page || $page == 1)? '' : $page + 1)."'>Next</a></li>
    </ul>
    </div>";
  }

}
if(!isset($_SESSION["user"])){
  echo "You are not Logged In";
  header('location:db.php');
}


mysqli_close($conn);
?>

</div>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js' integrity='sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN' crossorigin='anonymous'></script>
  </body>
</html>
