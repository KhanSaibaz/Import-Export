<?php
session_start();
include '../phps/connection.php';
include 'admin_navbar.php';

// $results_per_page = 12;
    $query = "SELECT * FROM `transaction`";
    $result = mysqli_query($conn, $query);
    $number_of_result = mysqli_num_rows($result);
    // $number_of_page = ceil($number_of_result/$results_per_page);
    // if (!isset($_GET['page'])){
    //   $page = 1;
    // }else{
    //   $page = $_GET['page'];
    // }
    // $page_first_result = ($page -1 ) * $results_per_page;
    $query1 = "SELECT * FROM `transaction` ORDER BY tid ASC ";
    // SELECT * FROM `transaction` ORDER BY `transaction`.`tid` 

    $result1 = mysqli_query($conn, $query1);

    
if($_SESSION["user"] == "admin"){
  echo "<!doctype html>
  <html lang='en'>
      <head>
          <meta charset='utf-8'>
          <meta name='viewport' content='width=device-width, initial-scale=1'>
          <title>Impoter</title>
          <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD' crossorigin='anonymous'>
          <style>
          body{
            background:#85686873;
          }
          </style>

      </head>
      <body>";

 
if ($count = mysqli_num_rows($result1) > 0) {
  echo "
  <div class='table-responsive-lg'>
  <table class='table table-striped ' id='myTable'  style=' width: 95%; margin: auto; '>
  <thead>
    <tr>
      <th scope='col'>Transaction ID</th>
      <th scope='col'>Customer Name</th>
      <th scope='col'>Mobile No</th>
      <th scope='col'>Address</th>
      <th scope='col'>Amount</th>
      <th scope='col'>Date</th>
      <th scope='col'>Status</th>
    </tr>
  </thead>
  <tbody>";
    while($r = mysqli_fetch_assoc($result1)){
      echo "
      <form action='product_verify.php' method='get'>
      <input type='hidden' name='tid' value='".$r['tid']."'>
   
  <tr>
      <th scope='row'><b>".$r['tid']."</th>
      <td><b>".$r['c_name']."</b></td>
      <td><b>".$r['mobile_no']."</b></td>
      <td><b>".$r['address']."</b></td>
      <td><b>".$r['amount']."RS</b></td>
      <td><b>".$r['date']."</b></td>
      <td><b><button type='submit' class='btn".(($r['status'] == 'pending' )? ' btn-danger' : ' btn-success')."'>".$r['status']."</button></td>
    </tr>
  </tbody>

      </form>";
    }
   
    }
 
}
if(!isset($_SESSION["user"])){
  echo "You are not Logged In";
  header('location:../admin/login.php');
}


mysqli_close($conn);
?>

<link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">

</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous" ></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js' integrity='sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN' crossorigin='anonymous'></script>

    <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" ></script>
    <script >
        $(document).ready(function () {
            $('#myTable').DataTable({
                columns:[
        { 'Transaction ID': true }, //col 1
        { 'Customer Name': true }, //col 2
        { 'Mobile No': true }, //col 5
        { 'Address': true },//col 5
        { 'Amount': true }, //col 5
        { 'Date': true }, //col 5
        { 'Status': true } //col 5
        ]
     
    });
            });
            
        </script>
</body>
</html>
