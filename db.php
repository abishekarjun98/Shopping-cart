<?php 



  

$conn= mysqli_connect("localhost","chandler","chandler","Shopping");
$curr_date=date("d-m-Y");

function give($query)
{
$conn= mysqli_connect("localhost","chandler","chandler","Shopping");
 $res=mysqli_query($conn,$query);
 $list=mysqli_fetch_all($res, MYSQLI_ASSOC);
 
 return $list;

}

function give_unique($query)
{
	$conn= mysqli_connect("localhost","chandler","chandler","Shopping");
 $res=mysqli_query($conn,$query);
 $list=mysqli_fetch_array($res, MYSQLI_ASSOC);
 
 return $list;

}
function give_product($id)
{
	$conn= mysqli_connect("localhost","chandler","chandler","Shopping");
 	$q1="SELECT * FROM inventory WHERE P_ID='$id'";
	$res=mysqli_query($conn,$q1);
 	$prod=mysqli_fetch_array($res, MYSQLI_ASSOC);
 	
 
 return $prod;
}


function get_user($U_id)
{
	$conn= mysqli_connect("localhost","chandler","chandler","Shopping");
 	$q1="SELECT * FROM Userinfo WHERE U_ID='$U_id'";
	$res_user=mysqli_query($conn,$q1);
 	$user=mysqli_fetch_array($res_user, MYSQLI_ASSOC);
 	
 
 return $user;

}






?>
