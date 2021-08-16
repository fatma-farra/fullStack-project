<?php
include("db.php");
$id=$_GET['id'];
$delete_query = "DELETE from employee where id='$id'";
if(mysqli_query($con,$delete_query))
header("location:mangEmp.php?ok=1");
?>