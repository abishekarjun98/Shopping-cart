

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

    body
    {
      font-family: Calibri, sans-serif;
    }


    .post{

      height:70px;
      width:400px;
      border-radius: 5px;
      box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
      margin-bottom: 25px;      
    }

    #count_box
    {
      width: 40px;

    }
    .everything
    {
      margin-top: 100px;
      margin-left: 500px;
    }
      .img
    {
    
    width: 300px;
    height: 300px;
    margin-left: 60px;
    }
    .product_pic
    {
      border-radius: 50px;
      width: 70px;
      height: 70px;
      float: left;
    }
    .remove
    {
      width:20px;
      height: 20px;
      float: right;
      margin-top: -25px;

    }
    .remove:hover{
      cursor: pointer;
    }
    #form_up
    {
      margin-left: 250px;
    }
    #txt
    {
      float: left;
      margin-left: 20px;
    }
    #txt2
    {
      margin-left: 100px;
    }
    #s_btn
    {
      margin-left: 150px;
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


  <?php 

  if(isset($_GET["add_id"]))

  {
    $id_to_be_added=$_GET["add_id"];
    $count=1;

    $q_add="INSERT INTO cart VALUES ('$LoggedUID','$id_to_be_added','$count')";


    if(mysqli_query($conn,$q_add))
    {
     header("Location: cart.php");
   }


 }

 ?>


 <div class="everything">
  <?php 

  $show_cart="SELECT* FROM cart WHERE U_ID='$LoggedUID'";

  $cart=give($show_cart);

  if(count($cart)==0)
  {
    ?>
    <h1 id="txt2">Empty Cart :( </h1>
    <img src="images/relax.png" class="img">

      <?php
    }
    else
    {
    foreach ($cart as $product) 


    {

      $id_of_prod =$product["Items"]; 
      $q_prod="SELECT* FROM inventory WHERE P_ID ='$id_of_prod'";
      $prod_details=give_unique($q_prod);

      $pics=$prod_details["Product_pic"];
      $pics_arr = explode (",", $pics); 
      $pic_link=$pics_arr[0];
      ?>

      <div class="post">


        <img src="<?php echo $pic_link; ?>" class="product_pic">

        <p id="txt"><?php echo $prod_details["Name"]; ?></p>

        <form action="cart.php" method="post" id="form_up">
          <input type="number" name="count" id="count_box" min="1" placeholder="<?php echo $product['Count']; ?>">
          <input type="hidden" id="pId" name="pId" value="<?php echo $prod_details['P_ID']; ?>">
          <input type="submit" name="submit" value="update">
        </form>

        <a href="cart.php?del=<?php echo $prod_details['P_ID']; ?>">
          <img src="images/remove.png" class="remove">
        </a>


      </div>

      <?php 
    }?>


    <form action="Summary.php" method="post" accept-charset="utf-8">
      <input type="hidden" name="submitflag" value="1" >
      <input type="submit" id="s_btn" class="btn btn-danger" value="Place Order">
    </form>
    
<?php
  }
    ?>

    
  </div>
  <?php


  if(isset($_GET["del"]))
  {

    $to_be_deleted=$_GET["del"];

    $show_cart="DELETE FROM cart WHERE U_ID='$LoggedUID' AND Items='$to_be_deleted' ";

    if (mysqli_query($conn,$show_cart)) {

     header("Location: cart.php");
   }

 }

 if(isset($_POST["count"],$_POST["pId"]))
 {
  $required_count=$_POST["count"];
  $id=$_POST["pId"];
  
  $update_count="UPDATE cart SET Count='$required_count' WHERE U_ID='$LoggedUID' AND Items='$id'";

  $prod_data="SELECT* FROM inventory WHERE P_ID='$id'";

  $prod=give_unique($prod_data);

  $available_count=$prod["Quantity"];

  
  if($available_count > $required_count)
  {
  

    if (mysqli_query($conn,$update_count)) 
    {


     header("Location: cart.php");

   }
 }
 else
 {
  echo "<script> alert('Insufficient Quantity, Please Enter Less Quantity') </script>";
}


} ?>







<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>