<?php
session_start();
include 'connection.php';

if(!empty($_SESSION['temp'])){
  unset($_SESSION['temp']);
}

if(!isset($_SESSION["user"])){
  if(isset($_POST['submit'])){
    
    $email = $_POST['email'];
    $password = $_POST['password'];
    $email = stripcslashes($email);
    $password = stripcslashes($password);
   
    $sql = "SELECT * FROM users where email='$email' ";
    $result = mysqli_query($conn, $sql);
    // $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
    $count = mysqli_num_rows($result);  
    if($count == 1){  
        while($data=mysqli_fetch_assoc($result))
        if(password_verify($password,$data['password'])){
            echo '<div class="alert alert-danger" role="alert">Login sucess.!</div>';  
            $_SESSION["user"] = "admin";
            $_SESSION["ids"] = $data['sno'];
            header('location:../exp_admin/products.php');
        }
        else{  
            echo '<div class="alert alert-danger" role="alert">Login failed. Invalid email or password.!</div>';  
        }     
    }  
    
  }
}
if (isset($_SESSION["user"])){
  header('location:../exp_admin/products.php');
}
mysqli_close($conn);
?>




<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel='icon' href='icon.ico' type='image/icon type'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <style>
    body {
    color: #000;
    overflow-x: hidden;
    height: 100%;
    background-color: #B0BEC5;
    background-repeat: no-repeat;
}

.card0 {
    box-shadow: 0px 4px 8px 0px #757575;
    border-radius: 0px;
}

.card2 {
    margin: 0px 40px;
}

.logo {
    width: 300px;
    height: 100px;
    margin-top: 20px;
    margin-left: 35px;
}

.image {
    width: 520px;
    height: 430px;
}

.border-line {
    border-right: 1px solid #EEEEEE;
}

.facebook {
    background-color: #3b5998;
    color: #fff;
    font-size: 18px;
    padding-top: 5px;
    border-radius: 50%;
    width: 35px;
    height: 35px;
    cursor: pointer;
}

.twitter {
    background-color: #1DA1F2;
    color: #fff;
    font-size: 18px;
    padding-top: 5px;
    border-radius: 50%;
    width: 35px;
    height: 35px;
    cursor: pointer;
}

.linkedin {
    background-color: #2867B2;
    color: #fff;
    font-size: 18px;
    padding-top: 5px;
    border-radius: 50%;
    width: 35px;
    height: 35px;
    cursor: pointer;
}

.line {
    height: 1px;
    width: 45%;
    background-color: #E0E0E0;
    margin-top: 10px;
}

.or {
    width: 10%;
    font-weight: bold;
}

.text-sm {
    font-size: 14px !important;
}

::placeholder {
    color: #BDBDBD;
    opacity: 1;
    font-weight: 300
}

:-ms-input-placeholder {
    color: #BDBDBD;
    font-weight: 300
}

::-ms-input-placeholder {
    color: #BDBDBD;
    font-weight: 300
}

input, textarea {
    padding: 10px 12px 10px 12px;
    border: 1px solid lightgrey;
    border-radius: 2px;
    margin-bottom: 5px;
    margin-top: 2px;
    width: 100%;
    box-sizing: border-box;
    color: #2C3E50;
    font-size: 14px;
    letter-spacing: 1px;
}

input:focus, textarea:focus {
    -moz-box-shadow: none !important;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
    border: 1px solid #304FFE;
    outline-width: 0;
}

button:focus {
    -moz-box-shadow: none !important;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
    outline-width: 0;
}

a {
    color: inherit;
    cursor: pointer;
}

.btn-blue {
    background-color: #1A237E;
    width: 150px;
    color: #fff;
    border-radius: 2px;
}

.btn-blue:hover {
    background-color: #000;
    cursor: pointer;
}

.bg-blue {
    color: #fff;
    background-color: #1A237E;
}

@media screen and (max-width: 991px) {
    .logo {
        margin-left: 0px;
    }

    .image {
        width: 300px;
        height: 220px;
    }

    .border-line {
        border-right: none;
    }

    .card2 {
        border-top: 1px solid #EEEEEE !important;
        margin: 0px 15px;
    }
}
    </style>
  </head>
  <body>
  <div class="container-fluid px-1 px-md-5 px-lg-1 px-xl-5 py-5 mx-auto">
    <div class="card card0 border-0">
        <div class="row d-flex">
            <div class="col-lg-6">
                <div class="card1 pb-5">
                    <div class="row">
                        <!-- <img src="logo.png" class="logo"> -->
                    </div>
                    <div class="row px-3 justify-content-center mt-4 mb-5 border-line">
                        <img src="../images/img5.jpeg" class="image">
                        <!-- <img src="../images/img5.jpeg'" class="image img-fluid h-100 w-100" style="border-radius: 1rem 0 0 1rem;" /> -->

                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card2 card border-0 px-4 py-5">
                  <div class="row mb-4 px-3">
                    <h4>Login As Exporter </h4>
                  </div>
                  <form method="post">
                    <div class="row px-3">
                        <label class="mb-1"><h6 class="mb-0 text-sm">Email Address</h6></label>
                        <input class="mb-4" type="email" name="email" placeholder="Enter username">
                    </div>
                    <div class="row px-3">
                        <label class="mb-1"><h6 class="mb-0 text-sm">Password</h6></label>
                        <input type="password" name="password" placeholder="Enter password">
                    </div>
                    <div class="row mb-1 px-3 mt-3  ">
                        <button type="submit" name="submit" class="btn btn-blue text-center">Login</button>
                    </div>
                    <p class=" pb-lg-2" style="color: #393f81;">Click Here <a href="../index.php"
                    style="color: #393f81;">Back to Shop </a></p>
                    <a class="small text-muted" href="#!">Forgot password?</a>
                    <p class="" style="color: #393f81;">Don't have an account? <a href="../phps/register.php"
                        style="color: #393f81;">Register here</a></p>
                  </form>
                  </div>
                </div>
                </div>
                <div class="bg-blue py-4">
                        <div class="row px-3">
                              <small class="ml-4 ml-sm-5 mb-2 my-2">Copyright &copy; 2023. All rights reserved.</small>
                              
                            </div>
                        </div>
                    </div>
                </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>