<?php
session_start();
require 'db.php';

$LoggedUID= $_SESSION["LoggedUID"];


/*
if(isset($_GET["del"]))

{

$to_be_deleted=$_GET["del"].",";



$show_cart="SELECT * FROM cart WHERE U_ID='$LoggedUID'";
$cart=give_unique($show_cart);

$cart_items=$cart["Items"];

$cart_items= str_replace($to_be_deleted," ",$cart_items);


$q_add ="UPDATE cart SET Items='$cart_items' WHERE  U_ID='$LoggedUID'";

if (mysqli_query($conn,$q_add)) {

	echo "string";
}


}
*/

/*
if(isset($_POST["count"],$_POST["pId"]))
{
  $new_count=$_POST["count"];
  $id=$_POST["pId"];
  echo $new_count;

  $update_count="UPDATE cart SET Count='$new_count' WHERE U_ID='$LoggedUID' AND Items='$id'";

  if (mysqli_query($conn,$update_count)) {

 //header("Location: cart.php");
  	echo "string";
}
else {
  echo "Error: " . $update_count . "<br>" . $conn->error;
}

}

*/


if(isset($_POST["submitflag"]))
{

echo "string";
  $order=array();

$getcart="SELECT * FROM cart WHERE U_ID='$LoggedUID'";

$full_cart=give($getcart);

foreach ($full_cart as $cart_item) {
  $item_id=$cart_item["Items"];

  $ordered_quantity=$cart_item["Count"];

  $product_data="SELECT* FROM inventory WHERE P_ID='$item_id'";

  $prods=give_unique($prod_data);

  $available_num=$prods["Quantity"];

  $balance_num=$ordered_quantity-$available_num;

  $order[$prods["Name"]]=$ordered_quantity;

  $update_inventory="UPDATE inventory SET Quantity=$balance_num WHERE P_ID='$item_id'";

  if(mysqli_query($conn,$update_inventory))
  {
    echo "string";
    print_r($order);
  }

}
  
}


?>