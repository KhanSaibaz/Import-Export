<?php
session_start();
include '../phps/connection.php';

if($_SESSION["user"] == "admin"){
include 'admin_navbar.php';


echo " <div class='col-sm-7 m-auto'>
          <h1 class='text-center mt-2'>EDIT AN ITEM </h1>
          <hr>";
          ?>

<form  action='<?php $_SERVER['PHP_SELF']?>' method='POST'>
<?php
              echo"<div class='container text-center ' style='background: #c0b7b787; padding: 10px; border-radius: 10px; box-shadow: 2px 5px 8px black;'>
                <div class='row my-4'>
                  <div class='col-sm-4'>
                    <label class='form-label'>Product ID</label>
                  </div>
                  <div class='col-sm-8'>
                    <input type='text' class='form-control'  name='pid' placeholder='Enter Product ID'>
                    </div>
                    <div class='text-center'>
                      <button type='submit' name='submits' class='btn btn-dark mt-3 '>SHOW DATA</button>
                    </div>
                </div>
              </div>  
          </form>
      </div>";
      if(isset($_POST['submits']))
      
      {
       $pro_id=$_POST['pid']; 
        $sql="SELECT * FROM product where pid='$pro_id'";
        $res=mysqli_query($conn,$sql);
        $num=mysqli_num_rows($res);
        if($num>=0){
          while($row = mysqli_fetch_assoc($res)){
            $string = $row['image'];
         echo "
         <div class='col-sm-7 m-auto mt-5'>
         <form action='./edit2.php' method='POST' enctype='multipart/form-data' style='background: #c0b7b787; padding: 10px; border-radius: 10px; box-shadow: 2px 5px 8px black;'>  
         <input type='hidden' class='form-control'required name='pro_id' value ='".$row['pid']."' vaplaceholder='Product Name'>
          <div class='container text-center'>
            <div class='row mt-2'>
              <div class='col-sm-4'>
                <label class='form-label'>Product Name</label>
              </div>
              <div class='col-sm-8'>
                <input type='text' class='form-control'required name='name' value ='".$row['prod_name']."' vaplaceholder='Product Name'>
              </div>
            </div>
          </div>
     
          <div class='container text-center'>
            <div class='row mt-2'>
              <div class='col-sm-4'>
                <label class='form-label'> Quantity</label>
              </div>
              <div class='col-sm-8'>
                <input type='text' class='form-control' required name='quantity' value='".$row['quantity']."' placeholder='eg(1kg , 100kg 1000kg) '>
              </div>
            </div>
          </div>

          <div class='container text-center'>
            <div class='row mt-2'>
                <div class='col-sm-4'>
                  <label class='form-label'>Product price</label>
                </div>
                <div class='col-sm-8'>
                  <input type='number' class='form-control'required name='price' value='".$row['price']."' placeholder='Enter price'>
                </div>
            </div>
          </div>
     
          <div class='container text-center'>
            <div class='row mt-2'>
              <div class='col-sm-4'>
                <label class='form-label'>Product Discount</label>
              </div>
              <div class='col-sm-8'>
                <input type='text' class='form-control'required name='discount' value='".$row['discount']."'  placeholder='eg(20  40)'>
              </div>
            </div>
          </div>  
     
          <div class='container text-center'>
            <div class='row mt-2'>
              <div class='col-sm-4'>
                <label class='form-label'>Image</label>
              </div>
              <div class='col-sm-8'>
                <input type='file' class='form-control'  name='newfile'  placeholder='' aria-describedby='fileHelpId'>
                <input type='hidden' name='oldfile' value ='". $row['image']."'>
              </div>
            </div>
          </div>
  
          <div class='container text-center'>
            <div class='row mt-2'>
              <div class='col-sm-4'>
                <label class='form-label'>Description</label>
              </div>
              <div class='col-sm-8'>
                <input class='form-control'  name='desc' required rows='3' value='".$row['description']."' placeholder='Enter Description'></input>

              </div>
            </div>
          </div>

          <div class='text-center'>
          <button type='submit' name='update' class='btn btn-dark mt-2'>Update DATA</button>
        </div>
      
      </form>
    </div>
          <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js' integrity='sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN' crossorigin='anonymous'></script>
        </body>
        </html>
          ";
        }
    
      }
      elseif($num<=0){
        echo '
        <div class="alert alert-danger" role="alert">
        User with email already exist!
        </div>';
  
      }
    }


    if(!isset($_SESSION["user"])){
      echo "You are not Logged In";
      header('location:db.php');
    }
    mysqli_close($conn);
}
?>
