

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
  <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>

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
    .profilepic2
    {
      width :200px;
      height:200px;
      border-radius: 50%;
      margin-left:  100px;
      margin-top: 50px;
    }
    .everything
    {
      margin-top: 100px;
      margin-left: 400px;
    }


    .plot{
      width:500px;
      height:400px;
    }

    body .modal-dialog { 
      max-width: 100%;
      width: auto !important;
      display: inline-block;
    }

    .modal {
      z-index: -1;
      display: flex !important;
      justify-content: center;
      align-items: center;
    }

    .modal-open .modal {
     z-index: 1050;
   }

   .box{
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
    height:450px;
    width:400px;
    margin-top: 50px;
    margin-left: 500px;
  }

  .content{
    margin-left: 30px;
  }


  .boxy{

    height:auto;
    width:350px;
    border-radius: 6px;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
    margin-bottom: 25px;   
    margin-left: 520px;
    margin-top: 20px;
    float: left;
    padding-left: 20px;
    font-size: 20px;
  }

#txt
{
  margin-left: 590px;
  margin-top: 30px;
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

<div class="box">

  <img src="<?php echo $profile_pic_url; ?>" class="profilepic2">  

  
  <h3 align="center"><?php echo $profile["Name"]; ?> </h3>
  <h5 align="center">Seller</h5>
  <div class="content">
   <button type="button" class="btn btn-light" data-toggle="modal" data-target="#month_modal" id="b_btn">
    Month wise Data
  </button>

  <button type="button" class="btn btn-light" data-toggle="modal" data-target="#cat_modal" id="b_btn">
    Check Category wise data
  </button>

</div>
</div>


<div class="modal fade" id="month_modal" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="monthly_plot" class="plot"></div>
    </div>
  </div>
</div>

<div class="modal fade" id="cat_modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="cat_plot" class="plot"></div>

    </div>
  </div>
</div>


<h2 id="txt">Delivery History</h2>
<?php


$q_orders="SELECT * FROM orders ORDER BY Time DESC";
$orders=give($q_orders);

$months= array();
$cats =array();



foreach ($orders as $order) {

  $month_order=substr($order["Time"],0,2);

  $order_from=$order["U_ID"];
  $order_user=get_user($order_from);


  $product_id=$order["P_ID"];
  
  $prod_detail=give_product($product_id);

  if($prod_detail["Sold_By"]="$LoggedUID")
  {

    array_push($months, $order["Time"]);
    array_push($cats,$prod_detail["Category"]);

    ?>
    <div class="boxy">
      <?php
      $countflag=1;

      echo "<h3>Customer - " . $order_user["Name"]."</h3>";
      echo $prod_detail["Name"]."      -     ".$order["Quantities"];
      echo nl2br("\n");
      echo nl2br("Delivered to \n".$order_user["Address"]);
      echo nl2br("\n".$order["Time"]);
      ?>
    </div>

    <?php
  }

  
} ?>

<script>
  var month_objects = {'09' : 0, '10' : 5,'11':5 };

  var orders_month= <?php echo json_encode($months); ?>;


  orders_month.forEach(assign_months);


  function assign_months(item)
  {

    month_objects[item.substring(0,2)]++;

  }

  monthx=[];
  monthy=[];


  for (const [key, value] of Object.entries(month_objects)) 
  {
    monthx.push(key);
    monthy.push(value);
  }


  var monthly_data=[
  { 
    x:monthx ,
    y:monthy,
    name:"Months",
    type:'bar',
  }];



  monthly_plot = document.getElementById('monthly_plot');

  Plotly.newPlot( monthly_plot,monthly_data,{title:'Monthly Orders',xaxis:{title:{text:"Months"}}});




  var cat_objects={"Fashion":2 ,"Electronics":0,"Grocery":6,"Furniture":0,"Medicine":0,"Accessories":0};

  var Category= ["Fashion","Electronics","Grocery","Furniture","Medicine","Accessories"];

  var orders_cat= <?php echo json_encode($cats); ?>;

  orders_cat.forEach(assign_cats);



  function assign_cats(item)
  {
    cat_objects[item]++;

  }

  console.log(cat_objects);

  cat_values=[];


  for (const [key, value] of Object.entries(cat_objects)) 
  {
    cat_values.push(value);
  }



  console.log(cat_objects);


  var cat_data=[
  { 
    values:cat_values,
    labels:Category,
    type:'pie',
  }];



  cat_plot = document.getElementById('cat_plot');

  Plotly.newPlot(cat_plot,cat_data,{title:'Sales Based on Different Categories'});






</script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>