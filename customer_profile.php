

<?php

session_start();
require 'db.php';

$LoggedUID= $_SESSION["LoggedUID"];



$profile =get_user($LoggedUID);

$profile_pic_url=$profile["profilepic"];

?>



<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans&display=swap" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
.everything
{
  margin-top: 50px;
  margin-left: 400px;
}

.box{
      
      height:auto;
      width:400px;
      border-radius: 12px;
      box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
     margin-bottom: 25px;      
     margin-left: 500px;
     padding-bottom: 30px;
     margin-top: 100px;

}

.boxy{
      
      height:100px;
      width:400px;
      border-radius: 6px;
      box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
     margin-bottom: 10px;      
     margin-left: 100px;
     padding-bottom: 30px;
     

}
.pic_class{
    width: 70px;
    height: 70px;
    margin-top: -80px;
    float: right;
    border-radius: 6px;
    }

.profilepic2
{
width :200px;
 height:200px;
 border-radius: 50%;
    margin-left:  100px;
    margin-top: 50px;
}
.txt
{
  margin-left: 630px;
}
</style>
	<nav class="navbar navbar-expand-lg navbar-light " style="background-color: #ffad33">
  
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
    
     <li class="nav-item">
        <a class="nav-link" href="customer_profile.php"> <img src="<?php echo $profile_pic_url ?>" class="profilepic"></a>
      </li>
      &nbsp 
      <li class="nav-item">
        <a class="nav-link" href="customer_home.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="cart.php">Cart</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php">Log-out</a>
      </li>
        
    </ul>
  </div>
</nav>
<body>

 <div class="box">

    <img src="<?php echo $profile_pic_url; ?>" class="profilepic2">  

  
    <h3 align="center"><?php echo $profile["Name"]; ?> </h3>
    <h5 align="center">Customer</h5>
   <h6 align="center"><?php echo $profile["Address"]; ?></h6>


 </div>


<h3 class="txt"> Your Orders</h3>
<div class="everything">
  

<?php

$q_orders="SELECT* FROM orders WHERE U_ID='$LoggedUID'";
$order_list=give($q_orders);

foreach ($order_list as $order)  { ?>
  <div class="boxy">
  
  <?php
  
  $date=$order["Time"];

 

    

    $item= $order["P_ID"];
    $quantity= $order["Quantities"];
    $product=give_product($item);
    $product_pic_str =$product["Product_pic"];

    $product_pic_array=explode(",",$product_pic_str);

    $product_pic_url=$product_pic_array[0];

    echo '<h5>'.$product["Name"]." - ".$quantity.'</h5>';
    
     

     $rate= $product["Price"]*$quantity;



     echo '<h5>'."₹"." ".$rate.'</h5>';

     echo "<h6>You Placed an Order on"."  - ". $date. "</h6>";
    ?>

<img class="pic_class" src= <?php echo $product_pic_url; ?> >
</div>

<?php } ?>


</div>

</body>




<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>