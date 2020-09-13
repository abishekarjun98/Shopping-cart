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


.box{
      
      height:200px;
      width:320px;
      border-radius: 12px;
      box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
     margin-bottom: 25px;   
     margin-left: 630px;
     margin-top: 80px;
     float: left;
     padding-left: 20px;
     font-size: 20px;
}
.rate
{
  float: right;
  margin-right: 40px;
}
.back
{
  margin-left: 70px;
  margin-top: 100px;
  float: left;
}

</style>
</head>
<body>
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
        <a class="nav-link" href="openpage.php">Home <span class="sr-only">(current)</span></a>
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


<h1 align="center">Order Summary</h1>
<div class="box">  
<h5>Product &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp Price </h5>
<?php
if(isset($_POST["submitflag"]))
{





$product_names=" ";
$product_quantities=" ";  
$Amount=0;

$timestamp = date("m-d-Y");

$recieved=0;
$order=array();

$getcart="SELECT * FROM cart WHERE U_ID='$LoggedUID'";

$full_cart=give($getcart);

foreach ($full_cart as $cart_item) {
  $order_id= uniqid();
  $item_id=$cart_item["Items"];

  $ordered_quantity=$cart_item["Count"];

  $product_data="SELECT* FROM inventory WHERE P_ID='$item_id'";

  $prods=give_unique($product_data);

  $available_num=$prods["Quantity"];

  $price=$prods["Price"];


$rate =$price * $ordered_quantity;

  $balance_num=$available_num - $ordered_quantity;

  $Amount+=$rate;

?>
<div class="content">

  <?php echo $prods["Name"]." X ".$ordered_quantity."   "."<div class='rate'>$rate</div>"?>

</div>
<?php
  $update_inventory="UPDATE inventory SET Quantity='$balance_num' WHERE P_ID='$item_id'";



  mysqli_query($conn,$update_inventory);
 
    
    $product_names= $product_names.",".$prods["P_ID"];
    $product_quantities=$product_quantities.",".$ordered_quantity;
    $pu_id=$prods["P_ID"];

$create_order="INSERT INTO  orders VALUES('$order_id','$pu_id','$ordered_quantity','$LoggedUID','$rate','$timestamp',
'$recieved')";

if(mysqli_query($conn,$create_order))
{

}
else
{
  echo "Error: " . $create_order . "<br>" . mysqli_error($conn);
}


}






  echo nl2br("\n");
  echo "Amount to Be Payed = "." ".$Amount;
}

 ?>
 <a href="customer_home.php" type="Button" class="btn btn-primary back">Back to Home</a>
</div>

</body>
</html>
