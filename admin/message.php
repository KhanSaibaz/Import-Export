<?php
session_start();
include '../phps/connection.php';

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
    
include 'admin_navbar.php';

if($_SESSION["user"] == "admin"){

if ($count = mysqli_num_rows($result1) > 0) {
echo "
<div class='table-responsive-lg'>
<table class='table table-striped' id='myTable' style='width: 95%; margin: auto;'>
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
    <td>".$r['email']."</td>
    <td>".$r['subject']."</td>
    <td>".$r['message']."</td>
    </tr>";
  }

  }

}
if(!isset($_SESSION["user"])){
  echo "You are not Logged In";
  header('location:db.php');
}


mysqli_close($conn);
?>

</div>

</div>


</div>
<link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous" ></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js' integrity='sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN' crossorigin='anonymous'></script>

    <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" ></script>
    <script >
        $(document).ready(function () {
            $('#myTable').DataTable({
        columns:[
        { 'Message ID': true }, //col 1
        { 'Name': true }, //col 1
        { 'Subject': true }, //col 2
        { 'Email': true }, //col 5
        { 'Message': true } //col 5
        ]
     
    });
            });
            
        </script>
</body>
</html>
