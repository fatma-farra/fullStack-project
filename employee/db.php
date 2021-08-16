<?php
$username ="root";
$host ="localhost";
$passwred ="";
$database = "project";
$con = mysqli_connect($host,$username,$passwred,$database);
if(!$con)
die("CONNECETION IS FAILED".mysqli_error($con));

?>