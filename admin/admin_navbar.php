<?php
include '../phps/connection.php';
?>
<!doctype html>
    <html lang='en'>
      <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <title>Edit Product</title>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD' crossorigin='anonymous'>
      </head>
      <body>
        <style>
      body{
    background:#85686873;
    font-family: sans-serif;
    font-weight: 700;
  }
  </style>

      <!-- <nav class='navbar navbar-expand-lg bg-body-tertiary mb-3'> -->
      <nav class="navbar navbar-expand-lg mb-3  navbar-dark bg-dark">
        

      <div class='container-fluid'>
        <a class='navbar-brand' href='admin.php'>N N L P </a>
        <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarNavAltMarkup' aria-controls='navbarNavAltMarkup' aria-expanded='false' aria-label='Toggle navigation'>
          <span class='navbar-toggler-icon'></span>
        </button>
        <div class='collapse navbar-collapse justify-content-end' id='navbarNavAltMarkup'>
          <div class='navbar-nav'>
          <a class='nav-link active' aria-current='page' href='expoters.php'>Exporters</a>
          <a class='nav-link active' aria-current='page' href='impoters.php'>Impoters</a>
            <a class='nav-link active' aria-current='page' href='admin_products.php'>Products</a>
            <a class='nav-link active' href='deleteproduct.php'>Delete Product</a>
            <a class='nav-link active' href='editproduct.php'>Edit Product</a>
            <a class='nav-link active' href='message.php'>Message</a>
            <div class="btn-group">
              <button class="btn  dropdown-toggle" type="button" id="triggerId" data-bs-toggle="dropdown" aria-haspopup="true"
                  aria-expanded="false" style='background:black; color:white;'>
                  Welcome Admin 
              </button>
              <div class="dropdown-menu dropdown-menu-start" aria-labelledby="triggerId">
                <a class="text-danger dropdown-item" href="../phps/logout.php">Log out</a>
             
               
            </div>
          </div>
        </div>
      </div>
    </nav>
<?php
// echo "

?>