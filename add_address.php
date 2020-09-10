<?php
session_start();
require 'db.php';

$LoggedUID= $_SESSION["LoggedUID"];


if(isset($_POST["addr"]))
{

$Addressi=$_POST["addr"];

$sql="UPDATE userinfo SET Address='$Addressi' WHERE U_ID='$LoggedUID'";

if (mysqli_query($conn, $sql)) {
  echo "Record updated successfully";

  header("Location:customer_home.php");

} else {
  echo "Error updating record: " . mysqli_error($conn);
}

}

?>