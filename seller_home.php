

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


    .box{

      height:auto;
      width:320px;
      border-radius: 6px;
      box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
      margin-bottom: 25px;   
      margin-left: 600px;
      margin-top: 40px;
      float: left;
      padding-left: 20px;
      font-size: 20px;
    }
    .profilepic
    {
      width :40px;
      height:40px;
      border-radius: 50%;
      float: left;
    }

    .add_btn
    {
      margin-top: 40px;
      margin-left: 680px;
      margin-bottom: 40px;
    }

    .add_btn:hover
    {
      transform: scale(1.1);
    } 
    .txt
    {
      margin-left: 570px ;
    }
    #a_btn
    {
      float: right;
    }
    .img
    {
    margin-left: 600px;
    width: 300px;
    height: 300px;
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
        <a class="nav-link" href="seller_profile.php"> <img src="<?php echo $profile_pic_url ?>" class="profilepic"></a>
      </li>
      &nbsp 
      <li class="nav-item">
        <a class="nav-link" href="seller_home.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="inventory.php">Inventory</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php">Log-out</a>
      </li>

    </ul>
  </div>
</nav>


<a href="additem.php">
  <button class="btn btn-warning add_btn">Add item to inventory</button>
</a>



<h2 align="center">Recieved Orders</h2>
<?php

$flag=0;
$countflag=0;

$q="SELECT * FROM orders WHERE Recieved='$flag'";
$orders=give($q);


foreach ($orders as $order) {

  $order_from=$order["U_ID"];
  $order_user=get_user($order_from);


  $product=give_product($order["P_ID"]);

  if($product["Sold_By"]=="$LoggedUID")
  {
    ?>
    <div class="box">
      <?php
      $countflag=1;
      echo "<h3>Order From " . $order_user["Name"]."</h3>";
      echo $product["Name"]."      -     ".$order["Quantities"];

      echo nl2br("\n");

      echo nl2br("Delivery to \n ".$order_user["Address"]);
      echo nl2br("\n");
      ?>
      <a class="btn btn-success" type="button" id="a_btn" href="seller_home.php?ID=<?php echo $order['O_ID']; ?>">Accept</a>
    </div>
  <?php   } 




  } 

  if($countflag==0)
  {
    echo "<h5 align='center'>"."No Orders Relax!"."</h5>";
    ?>
<img src="images/relax.png" class="img">

    <?php
  }


if(isset($_GET["ID"]))
{
  $order_id=$_GET["ID"];
  $reviewflag=1;
  $update="UPDATE orders SET Recieved='$reviewflag' WHERE O_ID='$order_id'";
  if(mysqli_query($conn, $update))
  {
    header("Location: seller_home.php");
  }


}


?>


  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>