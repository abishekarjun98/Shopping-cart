<?php


include 'db.php';

if(isset($_POST["name"]) || isset($_POST["email"])|| isset($_POST["password"])||isset($_POST["type"]))
{
    $name=$_POST["name"];
    $email=$_POST["email"];
    $password=$_POST["password"];
    if($_POST["type"]=="Seller")
    {
    	$type=1;
    }
    else
    {
    	$type=0;
    }

}




$sql="INSERT INTO Userinfo (U_ID,Name,Email,Password,Type) values(null,'$name','$email ','$password','$type')";



if ($conn->query($sql) === TRUE) 
{


  header("Location:index.php");


} 

else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}






$conn->close();
?>