<?php
   
    // Database conn
    include 'connection.php';
    
    // Error & success messages
    global $success_msg, $email_exist, $emptyError1,$emptyError2,  $emptyError3, $emptyError4, $emptyError5,$emptyError6,$emptyError7;
    
    // if($_SERVER['REQUEST_METHOD']=='POST') {
  if(isset($_POST['submit'])){
        $name       = $_POST["name"];
        $email      = $_POST["email"];
        $address      = $_POST["address"];
        $mobile     = $_POST["mobile"];
        $password   = $_POST["password"];
        $cpassword  = $_POST["cpassword"];
        // verify if email exists
        // PHP validation
        if(!empty($name) && !empty($email) && !empty($address) && !empty($mobile) && !empty($password) && !empty($cpassword) && $password==$cpassword){
            $sql1="SELECT * FROM users WHERE email = '$email'";
            $result1=mysqli_query($conn,$sql1);
            $rowCount =mysqli_num_rows($result1);
 
            // check if user email already exist
            if($rowCount > 0) {
                echo '
                <div class="alert alert-danger" role="alert">
                User with email already exist!
                </div>';
            } 
            else {
                    $password_hash = password_hash($password, PASSWORD_BCRYPT);
                    $sql = $conn->query("INSERT INTO `users` (`name`, `mobile`, `address`, `email`, `password`, `Date`) VALUES ('{$name}', '{$mobile}','{$address}', '{$email}', '{$password_hash}', current_timestamp())");
                        // if(!$sql){
                        //     die("MySQL query failed!" . mysqli_error($conn));
                        // }
                        // else{
                        //     echo '<div class="alert alert-success">
                        //             User registered successfully!
                        //         </div>';
                        // }   
                                header('location:login.php');
                    
                }
        } 
        else {
                if(empty($name)){
                    $emptyError1 = '<div class="text-danger">
                         Name is required.
                    </div>';
                }
            
                if(empty($address)){
                    $emptyError2 = '<div class="text-danger">
                        Mobile number  is required.
                        </div>';
                    }
                    if(empty($mobile)){
                    $emptyError3 = '<div class="text-danger">
                    Address is required.
                    </div>';
                }
                if(empty($email)){
                    $emptyError4 = '<div class="text-danger">
                    Email is required.
                    </div>';
                }
                if(empty($password)){
                    $emptyError5 = '<div class="text-danger">
                    Password is required.
                    </div>';
                } 
                if(empty($cpassword)){
                    $emptyError6 = '<div class="text-danger">
                    Confirm  Password is required.
                    </div>';
                } 
                if($password!=$cpassword){
                    echo '<div class="alert alert-danger">
                    Confirm password and password do not match .</div>';

                }           
            }

    }
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <title> Registration </title>
    <!-- jQuery + Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>

<body>
    <style>
        body{
        background-color:#e6e6e671;
        font-family: sans-serif;
        font-weight: 700;
        }
    </style>
    <div class="container mt-3 mb-2" style="max-width: 750px">
    <div class="container input-box">
        <h2 class="text-center mb-2 f-bold"> REGISTER HERE ! </h2>
        <hr>
        <form action="" method="post" style='box-shadow:2px 3px 6px black;padding:2rem;'>
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="name" id="name" />
                <?php
                echo $emptyError1;
                ?>
            </div>

            <div class="form-group input-box">
                <label>Mobile</label>
                <input type="text" class="form-control" name="mobile" id="mobilenumber" />
                <?php
                echo $emptyError2;
                ?>
            </div>

            <div class="form-group input-box">
                <label>Address</label>
                <input type="text" class="form-control" name="address" id="address" />
                <?php
                echo $emptyError3;
                ?>
            </div>

            <div class="form-group input-box">
                <label>Email</label>
                <input type="email" class="form-control" name="email" id="email" />
                <?php
                echo $emptyError4;
                ?>
            </div>

            <div class="form-group input-box">
                <label>password</label>
                <input type="password" class="form-control" name="password" id="password" />
                <?php
                echo $emptyError5;
                ?>
            </div>

            <div class="form-group input-box">
                <label>Confirm password</label>
                <input type="password" class="form-control" name="cpassword" id="password" />
                <?php
                echo $emptyError6;
                ?>
            </div>

            <button type="submit" name="submit" id="submit" class="btn btn-primary btn-lg btn-block w-25 m-auto ">
                Register
            </button>
               <a href="login.php" class="mt-3">Already Have Account Click Here to login</a> 
        </form>
    </div>
    </div>
    <main class="flex-grow-1">
  </main>
  <footer class=" text-center py-3 mt-4 bg-black" style="background: black;">
    <div class="container">
      <span class="text-muted">CopyRight © 2023 N&I Sales | All Right Reserved</span>
    </div>
  </footer>

</body>

</html>

<?php
// include '../phps/footer.php';

?>