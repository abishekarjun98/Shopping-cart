<?php



include 'db.php';
session_start();

if($_SESSION["LoggedUID"]==0)
{
  
header("Location: index.php");

}

if(isset($_POST['name'])||isset($_POST["password"]))
{
  $name=$_POST['name'];
  $password=$_POST['password'];


  $query="SELECT * from Userinfo where name='$name' AND password='$password'";
 

  $result=mysqli_query($conn,$query);
  $rows=mysqli_num_rows($result);
  $user=mysqli_fetch_array($result, MYSQLI_NUM);


  if($rows==1)
  {
    
   printf ("%s", $user[0]);
   $_SESSION["LoggedUID"] = $user[0]; 
    
  
    
    if($user[6]==0)
    {

    header("Location: customer_home.php");
}
else if($user[6]==1)
{
header("Location: seller_home.php");
}

  }
  else
  {
    echo "Password combination invalid.";
  }
}


?>