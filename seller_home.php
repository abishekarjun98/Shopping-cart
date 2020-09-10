

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
  
  .box{
      
      height:200px;
      width:320px;
      border-radius: 12px;
      box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
     margin-bottom: 25px;   
     margin-left: 550px;
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
  margin-left: 600px;
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
        <a class="nav-link" href="openpage.php">Home <span class="sr-only">(current)</span></a>
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

<a href="additem.php">
  <button class="btn btn-warning add_btn">Add item to inventory</button>
</a>


    
<h2 class="txt">Recieved Orders</h2>
<?php

$flag=0;
$q="SELECT * FROM orders WHERE Recieved='$flag'";
$orders=give($q);


foreach ($orders as $order) {
  ?>

  <div class="box">

  <?php

  $order_from=$order["U_ID"];
  $order_user=get_user($order_from);

  echo "<h3>Order From " . $order_user["Name"]."</h3>";
   
  
  $prod_str=$order["P_ID"];
  $prod_array=explode(",", $prod_str);

  $quant_str=$order["Quantities"];
  $quant_array=explode(",", $quant_str);



  for ($i=1; $i <count($prod_array) ; $i++) { 
    
    $product=give_product($prod_array[$i]);

    if($product["Sold_By"]="$LoggedUID")
    {
      echo $product["Name"]."      -     ".$quant_array[$i];

      echo nl2br("\n");

          }

  }

   echo nl2br("\n");
  echo nl2br("Delivery to \n ".$order_user["Address"]);

  

?>
<!--<a class="btn btn-success" type="button" href="seller_home.php?ID=<?php //echo $order['O_ID']; ?>">Accept</a>-->
</div>
<?php } 


/*
if(isset($_GET["ID"]))
{
  $order_id=$_GET["ID"];
  $reviewflag=1;
  $update="UPDATE orders SET Recieved='$reviewflag' WHERE "


}
*/

?>


<body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>