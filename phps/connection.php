<?php
// include 'credentials.php';
// <?php
$servername = "localhost";
$username = "root";
$password = "";
$database="mydata";


$conn = mysqli_connect($servername, $username, $password, $database);
// echo $conn;
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli($servername, $username, $password, $database);

?>