<?php 


/*
  $cleardb_url = parse_url(getenv("Shopping_db_url"));

  $cleardb_server   = $cleardb_url["host"];
$cleardb_username = $cleardb_url["user"];
$cleardb_password = $cleardb_url["pass"];
$cleardb_db       = substr($cleardb_url["path"],1);
*/


$cleardb_server   = "us-cdbr-east-02.cleardb.com";
$cleardb_username = "b38dcdb7845a42";
$cleardb_password = "6ce0cc1b";
$cleardb_db       = "heroku_c2ad81d61707f5d";






$conn= mysqli_connect("$cleardb_server","$cleardb_username","$cleardb_password","$cleardb_db");

//$conn= mysqli_connect("localhost","chandler","chandler","Shopping");
$curr_date=date("d-m-Y");

function give($query)
{
//$conn= mysqli_connect("localhost","chandler","chandler","Shopping");
$conn= mysqli_connect("$cleardb_server","$cleardb_username","$cleardb_password","$cleardb_db");

 $res=mysqli_query($conn,$query);
 $list=mysqli_fetch_all($res, MYSQLI_ASSOC);
 
 return $list;

}

function give_unique($query)
{
	//$conn= mysqli_connect("localhost","chandler","chandler","Shopping");
	$conn= mysqli_connect("$cleardb_server","$cleardb_username","$cleardb_password","$cleardb_db");

 $res=mysqli_query($conn,$query);
 $list=mysqli_fetch_array($res, MYSQLI_ASSOC);
 
 return $list;

}
function give_product($id)
{
	//$conn= mysqli_connect("localhost","chandler","chandler","Shopping");
	$conn= mysqli_connect("$cleardb_server","$cleardb_username","$cleardb_password","$cleardb_db");

 	$q1="SELECT * FROM inventory WHERE P_ID='$id'";
	$res=mysqli_query($conn,$q1);
 	$prod=mysqli_fetch_array($res, MYSQLI_ASSOC);
 	
 
 return $prod;
}


function get_user($U_id)
{
	//$conn= mysqli_connect("localhost","chandler","chandler","Shopping");
	$conn= mysqli_connect("$cleardb_server","$cleardb_username","$cleardb_password","$cleardb_db");

 	$q1="SELECT * FROM Userinfo WHERE U_ID='$U_id'";
	$res_user=mysqli_query($conn,$q1);
 	$user=mysqli_fetch_array($res_user, MYSQLI_ASSOC);
 	
 
 return $user;

}






?>
