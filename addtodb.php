

<?php

session_start();
require 'db.php';




$locs=array();

if (isset($_FILES['my_file'])) {
  $myFile = $_FILES['my_file'];
  $fileCount = count($myFile["name"]);

  for ($i = 0; $i < $fileCount; $i++) {

    $rand= uniqid();
    $info = pathinfo($myFile["name"][$i]);
    $ext = $info['extension']; 
    $newname = $rand.".".$ext;
    $target = 'uploads/productpics/'.$newname;
    move_uploaded_file( $_FILES['my_file']["tmp_name"][$i], $target);
    array_push($locs,$target);

  }
  
}

$LoggedUID= $_SESSION["LoggedUID"];


$q1="SELECT * FROM Userinfo WHERE U_ID='$LoggedUID'";

$res=mysqli_query($conn,$q1);
$user=mysqli_fetch_array($res, MYSQLI_ASSOC);

$profile_pic_url=$user["profilepic"];




$pic_url=$target;




if(isset($_POST["Product_name"],$_POST["description"],$_POST["quantity"],$_POST["Price"],$_POST["Category"]))

{

  $Product_name=$_POST["Product_name"];
  $description=$_POST["description"];
  $quantity=$_POST["quantity"];
  $price=$_POST["Price"];
  $Category=$_POST["Category"];
}




?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet">

  <style>

    body
    {
      font-family: Calibri, sans-serif;
    }
    .profilepic
    {
      width :40px;
      height:40px;
      border-radius: 50%;
      float: left;
    }

    .post_content{
      box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
      height:auto;
      width:400px;
      margin-top: 50px;
      margin-left: 500px;
    }
    .post_pic{

      height: 300px;

    }
    .carousel-inner{

      width: 400px;
      height: 300px;


    }


  </style>
  <nav class="navbar navbar-expand-lg navbar-light " style="background-color: #ffad33">

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
       <li class="nav-item">
        <a class="nav-link" href="profile.php"> <img src="<?php echo $profile_pic_url ?>" class="profilepic"></a>
      </li>
      &nbsp 
      <li class="nav-item">
        <a class="nav-link" href="seller_home.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="inventory.php">Inventory<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php">Log-out</a>
      </li>

    </ul>
  </div>
</nav>
</head>
<body>

  <div class="post_content">

    <div id="carouselExampleControls"  class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">

        <?php
        for ($i=0; $i <count($locs); $i++) { 


          ?>
          <?php if($i==0)
          { ?>
           <div class="carousel-item active post_pic">
            <img style="height: 300px;width: 400px;" alt="First slide" src=<?php echo $locs[$i]; ?>>
          </div>
          <?php
        } 
        else {?>
          <div class='carousel-item post_pic'>
            <img  style="height: 300px;width: 400px;" alt='First slide' src= <?php echo $locs[$i]; ?>>
          </div>

          <?php
        }
      }
      ?>
      <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>


    </div>
  </div>




  <?php
  $offer_values="";

  echo "<h1> $Product_name </h1>";
  echo "<h4>  $description </h4>";
  echo "<h4>  $Category </h4>";
//echo "<h2 'style='float:right;''>  ₹$price  </h2>";
  ?>
  <h2 ><?php echo"₹".$price  ?> </h2>


  <div class="accordion" id="accordionExample">

    <div class="card">
      <div class="card-header" id="headingOne">
        <h2 class="mb-0">
          <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
            Offers
          </button>
        </h2>
      </div>

      <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
        <div class="card-body">
          <?php

          if (isset($_POST["offers"]) && is_array($_POST["offers"]))
          { 


            $offers_array = array_filter($_POST["offers"]); 
            foreach($offers_array as $offer){
              $offer_values .= $offer.",";

              echo nl2br ("->"."$offer\n");

            }
          }
          ?>

        </div>
      </div>
    </div>



  </div>


</div>





<?php

$timestamp = date("m-d H:i");
$f=0;
$def_id=0;

$product_id= uniqid();  



$product_pictures=implode(",",$locs);

$q3="INSERT INTO inventory VALUES('$product_id','$Product_name','$description','$quantity','$price','$Category','$LoggedUID','$product_pictures','$offer_values')";




if(mysqli_query($conn, $q3))
{


  echo '<script>alert("Product added to Inventory!")</script>';
}


else
{

  echo "Error: " . $q3 . "<br>" . $conn->error;

}



?>





<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>