

<?php

session_start();
require 'db.php';

$LoggedUID= $_SESSION["LoggedUID"];


$user=get_user($LoggedUID);

 $profile_pic_url=$user["profilepic"];



?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
  .everything
{
  margin-left: 300px;
  margin-top: 100px;
}
.profilepic
{
width :40px;
 height:40px;
 border-radius: 50%;
    float: left;
}


.post{
      
      height:280px;
      width:700px;
      border-radius: 12px;
      box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
     margin-bottom: 25px;      
}
.post_pic{
    width: 200px;
    height: 197px;
    border-radius: 6px;
    }
.content{
  font-size: 18px;
}

.carousel-inner{

    width: 200px;
    height: 197px;
    float: left;
    margin-right: 30px;
    margin-left: 30px;

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
        <a class="nav-link" href="friends.php">Search</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php">Log-out</a>
      </li>
    </ul>
  </div>
</nav>


<div class="everything">
<?php

$q3="SELECT * FROM inventory WHERE Sold_By='$LoggedUID'";

$list=give($q3);

foreach ($list as $item) {




 $pics=$item["Product_pic"];

$pics_arr = explode (",", $pics); 

$pic_link=$pics_arr[0];

 ?>

<div class="post"> 


  <div id="carouselExampleControls"  class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
<div class="carousel-item active">
      <img class="post_pic" src=<?php echo $pic_link; ?>>
    </div>
<?php 

  $pics_array = explode (",", $pics);
         $array = array_filter($pics_array);
         
       foreach($array as $pic){
        

        ?>
        <div class='carousel-item'>
    <img class="post_pic" src= <?php echo $pic; ?>>
    </div>

     <?php 
     }?>

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

<br>


  
<h3>
<?php
 echo nl2br($item["Name"]."\n");
 ?>
  </h3>
  
<span class="content">
<?php
 echo nl2br($item["Description"]."\n");

echo nl2br($item["Category"]."\n");

 echo nl2br("₹".$item["Price"]."\n");

  echo nl2br("Available Quantity :". $item["Quantity"]."\n");

?>

</span>
<br><br><br>

</div>

 <?php

} ?>


</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>


