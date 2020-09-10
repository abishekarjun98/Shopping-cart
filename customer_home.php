

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
  
.profilepic
{
width :40px;
 height:40px;
 border-radius: 50%;
    float: left;
}
.everything
{
  margin-top: 100px;
  margin-left: 400px;
  width: 800px;
  background-color: #eee;
}
.btn_grp
{
  margin-left: 450px;
  margin-top: 50px;
}

.post{
      
      height:280px;
      width:200px;
      border-radius: 4px;
      box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
     margin-bottom: 25px;
     float: left;
     margin-left: 30px;
      
}
.post_pic{
    width: 200px;
    height: 197px;
    border-radius: 3px;
    }
    #address
    {
      height: 80px;
      width: 250px;
      margin-left: 550px;
      margin-top: 50px;
    }
</style>
</head>
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
        <a class="nav-link" href="openpage.php">Home <span class="sr-only">(current)</span></a>
      </li>
           <li class="nav-item">
        <a class="nav-link" href="friends.php">Search</a>
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


<?php if(is_null($profile["Address"])) { ?>
<form action="add_address.php" method="POST">

<input type="text" name="addr" id="address" placeholder="Enter your Delivery Address">
<input type="submit" name="Submit"  class="btn btn-success">

</form>

<?php } ?>

<div class="btn_grp">
  

<?php

$cats=array("All","Grocery","Fashion","Furniture","Medicine","Accessories","Electronics");


foreach ($cats as $cat) { ?>
  <a  class="btn btn-warning"  type="button" data-placement="top" href="customer_home.php?CAT=<?php echo $cat; ?>">

  <?php echo $cat;?>

  </a>

<?php } ?>

</div>

<div class="everything">
  

<?php


if(isset($_GET["CAT"]))
{
  $category=$_GET["CAT"];

if($category!="All")
{
$q3="SELECT * FROM inventory WHERE Category='$category'";

}
else
{
  $q3="SELECT * FROM inventory";
}


$list=give($q3);

foreach ($list as $item) {
  
  $pics=$item["Product_pic"];
  $pics_arr = explode (",", $pics); 
  $pic_link=$pics_arr[0];
  ?>

<div class="post">

  <img class="post_pic" src=<?php echo $pic_link; ?>>
  <?php echo $item["Name"];?>
  <br>
  <?php echo $item["Price"];?>
<br>
  <a href="display_product.php?P_ID=<?php echo $item["P_ID"];?>">
View Product
  </a>

</div>

  <?php
}
}
?>
</div>



</body>




<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>