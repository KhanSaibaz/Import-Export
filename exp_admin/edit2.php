<?php
// if($_SESSION["user"] == "admin"){
include '../phps/connection.php';

if(isset($_POST['update'])){
  $pro_id=$_POST['pro_id'];
   $prod=$_POST['name'];
   $quantity=$_POST['quantity'];
   $price=$_POST['price'];
   $discount=$_POST['discount'];
   $desc=$_POST['desc'];
   $new_file=$_FILES['newfile'];
   $old_file=$_POST['oldfile'];



   if($new_file['name'] !=""){
    echo "ki434";

     $update_file_old=$_FILES['newfile'];
   
     $filename=$update_file_old['name'];
     $fileerror=$update_file_old['error'];
     $filetmp=$update_file_old['tmp_name'];
   
     $fileext=explode('.',$filename);
     $filecheck=strtolower(end($fileext));
     $file_ext_stored=array('png','jpg','jpeg');
     if(in_array($filecheck,$file_ext_stored)){
       $file_destination = '../uploads/'.$filename;
       move_uploaded_file($filetmp,$file_destination);
       $Database_destination = 'uploads/'.$filename;
         $query="UPDATE  product SET  prod_name= '$prod', quantity='$quantity' , price='$price', discount='$discount', image='$Database_destination' , description='$desc' WHERE pid='$pro_id'";
         $result = mysqli_query($conn, $query);
         if($result){
          echo 
          '<div class="alert alert-success" role="alert">
          Product Sucessfully Added
          </div>';
          header('location:products.php');
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
        echo "ki";
        $query1="UPDATE  product SET  prod_name= '$prod', quantity='$quantity' , price='$price', discount='$discount' , description='$desc' WHERE pid='$pro_id'";
        $result1 = mysqli_query($conn, $query1);
        if($result1){
          echo 
          '<div class="alert alert-success" role="alert">
          Product Sucessfully Added
          </div>';
          header('location:products.php');
        }
        else{
            echo 
          '<div class="alert alert-danger" role="alert">
            Product Was not Added
          </div>';
          }
        }


}

?>