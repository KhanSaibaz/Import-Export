<?php
session_start();
include '../phps/connection.php';
global $success_msg, $product_exist, $emptyError1,$emptyError2,  $emptyError3, $emptyError4, $emptyError5,$emptyError6,$emptyError7;


if($_SESSION["user"] == "admin"){
  if(isset($_POST['submit'])){
      $expoter_id=$_SESSION['ids'];
        $name = $_POST['name'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];
        $discount = $_POST['discount'];
        $image = $_FILES['file'];
        $desc = $_POST['desc'];

        $filename=$image['name'];
        $fileerror=$image['error'];
        $filetmp=$image['tmp_name'];

        $fileext=explode('.',$filename);
        $filecheck=strtolower(end($fileext));

        $file_ext_stored=array('png','jpg','jpeg');

        if(in_array($filecheck,$file_ext_stored)){
          $file_destination = '../uploads/'.$filename;
          move_uploaded_file($filetmp,$file_destination);
          $Database_destination = 'uploads/'.$filename;
          if(!empty($name)){
            $sql1="SELECT * FROM product WHERE prod_name = '$name'";
            $result1=mysqli_query($conn,$sql1);
            $rowCount =mysqli_num_rows($result1);
            if($rowCount > 0) {
                echo '
                <div class="alert alert-danger" role="alert">
                product with name already exist!
                </div>';
            }
            else{
              $query="INSERT INTO `product`(`expoter_id`,`prod_name`, `quantity`, `price`, `discount`,`image`, `description`) VALUES ('$expoter_id','$name', '$quantity','$price','$discount', '$Database_destination', '$desc')";
              $result2 = mysqli_query($conn, $query);
              if($result2){
                echo 
                '<div class="alert alert-success" role="alert">
                Product Sucessfully Added
                </div>';
              }
              else{
                  echo 
                '<div class="alert alert-danger" role="alert">
                  Product Was not Added
                </div>';
                }
            }
         }
        else{
          echo 
          '<div class="alert alert-danger" role="alert">
            Product Was not Added
          </div>';
        }
      }
        else{
          echo 
          '<div class="alert alert-danger" role="alert">
           File Format will be only ("png","jpg","jpeg")
          </div>';
          // exit;
        }
        // mysqli_close();
}
include 'admin_navbar.php';
?>
   
<style>
  body{
    background:#85686873;
    font-family: sans-serif;
    font-weight: 700;
  }
</style>
   
   <div class='text-center mt-3'>
        <div class='col-sm-8 m-auto '>
        <h1 class='text-center my-3'>ENTER PRODUCTS DETAILS</h1>
        <hr>
        <form action='./addproduct.php' method='POST' enctype='multipart/form-data' style='background: #c0b7b787; padding: 10px; border-radius: 10px; box-shadow: 2px 5px 8px black;'>  
          <div class='container text-center'>
            <div class='row mt-2'>
              <div class='col-sm-4'>
                <label class='form-label'>Product Name</label>
              </div>
              <div class='col-sm-8'>
                <input type='text' class='form-control'required name='name' placeholder='Product Name'>
              </div>
            </div>
          </div>
     
          <div class='container text-center'>
            <div class='row mt-2'>
              <div class='col-sm-4'>
                <label class='form-label'> Quantity</label>
              </div>
              <div class='col-sm-8'>
                <input type='text' class='form-control' required name='quantity' placeholder='eg(1kg , 100kg 1000kg) '>
              </div>
            </div>
          </div>
     
        
     
     
          <div class='container text-center'>
            <div class='row mt-2'>
                <div class='col-sm-4'>
                  <label class='form-label'>Product price</label>
                </div>
                <div class='col-sm-8'>
                  <input type='number' class='form-control'required name='price' placeholder='Enter product price per Kg'>
                </div>
            </div>
          </div>
     
          
        <div class='container text-center'>
          <div class='row mt-2'>
          <div class='col-sm-4'>
          <label class='form-label'>Product Discount</label>
          </div>
          <div class='col-sm-8'>
          <input type='text' class='form-control'required name='discount'  placeholder='eg(20  40)'>
          </div>
          </div>
          </div>  

     
      <div class='container text-center'>
        <div class='row mt-2'>
            <div class='col-sm-4'>
              <label class='form-label'>Image</label>
            </div>
            <div class='col-sm-8'>
              <input type='file' class='form-control'  name='file' placeholder='' aria-describedby='fileHelpId'>
            </div>
          </div>
        </div>
        <div class='container text-center'>
          <div class='row mt-2'>
            <div class='col-sm-4'>
              <label class='form-label'>Description</label>
            </div>
            <div class='col-sm-8'>
              <textarea class='form-control'  name='desc' required rows='3' placeholder='Enter Description'></textarea>
            </div>
          </div>
        </div>
        <button type='submit' name='submit'  class='btn btn-dark mt-3'>Add Products</button>
      </div>
      </div>
      </form>
    </div>
          <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js' integrity='sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN' crossorigin='anonymous'></script>
        </body>
        </html>
    <?php    
          mysqli_close($conn);
        }
        
        if(!isset($_SESSION["user"])){
          echo "You are not Logged In";
          header('location:db.php');
        }

        ?>