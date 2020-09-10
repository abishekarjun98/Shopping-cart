

<?php

session_start();
require 'db.php';

$LoggedUID= $_SESSION["LoggedUID"];



$profile =get_user($LoggedUID);

$profile_pic_url=$profile["profilepic"];

if(isset($_GET["P_ID"]))
{
  $id_to_disp=$_GET["P_ID"];
}


?>



<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <script src="https://kit.fontawesome.com/ffbc884c21.js" crossorigin="anonymous"></script>
<link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet">
<style>
  
  body
  {
    font-family: 'Ubuntu', sans-serif;
  }
.profilepic
{
width :40px;
 height:40px;
 border-radius: 50%;
    float: left;
}

.post_pic
{
  width: 100px;
  height: 100px;
  border-radius: 3px;

}

#big_img
{
  width: 400px;
  height: 400px;
  margin-top: 40px;
  margin-left: 100px;
}
.img_btn
{
    margin-top: 50px;
  border-style: hidden;
  background-color: white;
  float: left;
}
.content
{
  float: left;
  margin-top: -300px;
  margin-left: 400px;
}
.img_grp
{
  margin-left: 40px;
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
        <a class="nav-link" href="customer_home.php">Home <span class="sr-only">(current)</span></a>
      </li>
           <li class="nav-item">
        <a class="nav-link" href="friends.php">Search</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php">Log-out</a>
      </li>
        
    </ul>
  </div>
</nav>
</head>
<body>

  

<?php

$product_disp="SELECT* FROM inventory WHERE P_ID='$id_to_disp'";


$prod=give_unique($product_disp);

$pics=$prod["Product_pic"];

$pics_arr = explode (",", $pics); 

$offers_arr= explode(",", $prod["Offers"]);

$pic_link=$pics_arr[0];


?>
<img id="big_img" src="<?php echo $pic_link; ?>">
<br>
<div class="img_grp">

<?php

  $pics_array = explode (",", $pics);
         $array = array_filter($pics_array);
         
       foreach($array as $pic){ ?>

<button onclick="getpic('<?php echo $pic; ?>')" class="img_btn">
  <img class="post_pic"  src= "<?php echo $pic;?>">
</button>

     <?php }?>
</div>

<div class="content">
  

<h1> <?php echo $prod['Name'];?> </h1>

<h2> <?php echo $prod['Description'];?> </h2>

<!--<h2> <?php //echo $prod['Category'];?> </h2>-->

<h2> <?php echo "₹".$prod['Price'];?> </h2>

<h3> Offers!!!</h3>
<?php 
foreach ($offers_arr as $offer) {
  
  echo nl2br($offer."\n");
}


$q_checkproduct="SELECT * FROM cart WHERE U_ID='$LoggedUID' AND Items='$id_to_disp'";

$res=give($q_checkproduct);
if(count($res)==1)
{?>
<button class="btn btn-primary" disabled><i class="fas fa-money-bill"></i> Product already in the cart </button>

<a href="cart.php" type="button" class="btn btn-primary">
    
    <i class="fas fa-cart-plus"></i> &nbsp &nbsp Buy  Now!
  </a>

<?php
}

else{

?>


  
  <a href="cart.php?add_id=<?php echo $id_to_disp; ?>" type="button" class="btn btn-success">
    
    <i class="fas fa-cart-plus"></i> &nbsp &nbspAdd to Cart
  </a>

  <button class="btn btn-primary"><i class="fas fa-money-bill"></i> &nbsp &nbsp  Buy Now!! </button>

<?php }?>
</div>

<div class="btn_grp">
</div>



<script type="text/javascript" src="showpic.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>