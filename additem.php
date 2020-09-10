

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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
  
.profilepic
{
width :40px;
 height:40px;
 border-radius: 50%;
    float: left;
}
#myform
  {
    margin-left: 500px;
    margin-top: 20px;
    background-color: #eee;
    width: 400px;
    border-radius: 8px;
    padding-left: 60px;
    padding-top: 30px;
    margin-bottom: 300px: 
  }
  #quantity
  {
    width: 50px;
  }
  input[type="file"] {
    display: none;
}

.camera_btn{
width: 40px;
height: 40px;
margin-bottom: 20px; 
}
.camera_btn:hover
        {
            
            cursor: pointer;
            transform: scale(1.1);
        }

        .box
        {
          border-radius: 3px;
          border-style: none;
          width: 250px;
          height: 40px;
          margin-bottom: 20px;

        }
        #descp
        {
          height: 70px;
        }
 .remove_offer
  {
    width:20px;
    height: 20px;
  }
  .remove_offer:hover{
    cursor: pointer;
  }
  #s_btn
  {
   margin-left: 400px;
    margin-top: -600px ;
    width: 200px;
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
<form method="POST" action="addtodb.php" id="myform" enctype="multipart/form-data">

  <label class="custom-file-upload">
    <input type="file" name="my_file[]" multiple>
    <img src="images/camera.png" class="camera_btn">
    <span>Add Pics</span>
</label>
<br>
  <input type="text" name="Product_name" class="box" placeholder="Product_name">
  <br><br>
  
  <input type="text" name="description"class="box" id="descp" placeholder="Description">

    <br><br>
  <label for="quantity">Quantity</label>
  <input type="number" id="quantity" name="quantity" class="box" min="1">
    <br><br>
    <input type="text" name="Price"class="box"  placeholder="Price">
    <br><br>

          <label for id="Category">Category</label>

          <select id="Category" name="Category"class="box">
            <option value="Electronics">Electronics</option>
            <option value="Grocery">Grocery</option>
            <option value="Fashion">Fashion</option>
            <option value="Furniture">Furniture</option>
            <option value="Medicine">Medicine</option>
            <option value="Books">Books</option>
            <option value="Accessories">Accessories</option>
          </select>
<br><br>
  <button id='create_offers' type="button" class="btn btn-info">+ Offers
</button>
<div class="offers">
  </div>
          
          <button type="submit" class="btn btn-success" id="s_btn">Sell This Item</button>
          </form>
        
          
<script>


var i = 0; 
function increment_offer(){
i += 1; 
}
  $("#create_offers").click(function(){
increment_offer();
  

$(".offers").append([
    $('<div/>',{ "id": "offer_"+i }).append([
         
         $('<input>',{ "name":"offers[]","placeholder":"enter offers","class":"box"}),
        $("<img>",{"src":"images/remove.png","class":"remove_offer"}),


    ])
])
});



 $(".offers").on("click",".remove_offer", function(e){ 
        e.preventDefault();
 $(this).parent('div').remove(); 
 i--;
    })
</script>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>