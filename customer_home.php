

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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans&display=swap" rel="stylesheet">

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
    #everything
    {
      margin-top: 40px;
      width: 800px;
       margin-left: 360px;
       
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
    .nav_btn
    {
      margin-left: -9px;
      background-color: #ffad33;
    }
   

    #List_of_Products
    {
      margin-left: 300px;
      width: 600px;
      list-style-type:none;
    }

    .Prod_class{
      border: 1px solid #ddd;
      margin-top: -1px; 
      padding: 12px;
      height: 150px;
      font-size: 18px;
      color: black;
      display: block;
      margin-top: 10px;
      border-radius: 10px;
      margin-left: 150px;
    }

    .prod_pic_class
    {
      height: 100px;
      width:100px;
      border-radius: 6px;
    }
    .c_linkclass{
      float: right;
    }

    #searchbar{
      background-image: url('images/search.png');
      background-position: 10px 12px;
      background-repeat: no-repeat;
      width: 30%;
      font-size: 16px;
      padding: 12px 20px 12px 40px;
      border: 1px solid #ddd;
      margin-left: 500px;
      margin-top: 40px;


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



  <?php if(is_null($profile["Address"])) { ?>
    <form action="add_address.php" method="POST">

      <input type="text" name="addr" id="address" placeholder="Enter your Delivery Address">
      <input type="submit" name="Submit"  class="btn btn-success">

    </form>

  <?php } ?>
 <input id="searchbar" onkeyup="search_product()" onkeydown="search_product()" onkeypress="search_product()" type="text" name="search" placeholder="Search Products......"> 
 
  <div class="btn_grp">
    <a  class="btn btn-warning nav_btn"  type="button" data-placement="top" href="customer_home.php">All</a>
    <?php

    $cats=array("Grocery","Fashion","Furniture","Medicine","Accessories","Electronics");


    foreach ($cats as $cat) { ?>
      <a  class="btn btn-warning nav_btn"  type="button" data-placement="top" href="customer_home.php?CAT=<?php echo $cat; ?>">

        <?php echo $cat;?>

      </a>

    <?php } ?>
  </div>


 

  <ul id="List_of_Products"></ul>


  <div id="everything">

    <?php



    $q3="SELECT * FROM inventory";
    if(isset($_GET["CAT"]))
    {

      $category=$_GET["CAT"];


      $q3="SELECT * FROM inventory WHERE Category='$category'";


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

//header("Location: customer_home.php");
    ?>
  </div>




  <?php


  $q_prod="SELECT* FROM inventory ";
  $list_prod=give($q_prod);


  foreach ($list_prod as $prod) 
  {  

    $id=$prod["P_ID"];
    $pics_str=$prod["Product_pic"];
    $pics_arr=explode(",",$pics_str);
    $pic_url=$pics_arr[0];

    ?>


    <script type="text/javascript">


      var prod_node=document.createElement("LI");
      prod_node.setAttribute("class","Prod_class");

      var pimg = document.createElement("IMG");
      pimg.setAttribute("src","<?php echo $pic_url?>");
      pimg.setAttribute("class","prod_pic_class");
      prod_node.appendChild(pimg);


      var textnode2 = document.createTextNode("<?php echo " ".$prod['Name']; ?>");        

      prod_node.appendChild(textnode2);

      var c= document.createElement('a');
      var link_post = document.createTextNode("View Product");
      c.title="View Product";
      c.appendChild(link_post);   
      c.href = "display_product.php?P_ID=<?php echo $prod["P_ID"];?>";
      c.setAttribute("class","c_linkclass");
      prod_node.appendChild(c);  



      document.getElementById("List_of_Products").appendChild(prod_node);


    </script>

    <?php
  }
  ?>
  <script type="text/javascript">



    $("#List_of_Products").hide();

    function search_product() 
    { 
      $("#everything").hide();
      let input = document.getElementById('searchbar').value ;
      input=input.toLowerCase(); 

      let x = $(".Prod_class");

      if(input.length ==0)
      {
        $("#List_of_Products").hide();
        $("#everything").show();

      }

      else
      {
        for (i = 0; i < x.length; i++) {  
          if (!x[i].innerHTML.toLowerCase().includes(input)) { 
            x[i].style.display="none"; 
          } 

          else { 
            $("#List_of_Products").show();


            x[i].style.display="list-item";                  
          } 
        } 

      }

    } 
  </script>
</body>




<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>