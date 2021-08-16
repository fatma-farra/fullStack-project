<?php
session_start();
$username = "";
if(!isset($_SESSION['username']) ){
    header("Location:loginAdmin.php");
}else{
   $username = $_SESSION['username'];
}
$print_message="";
$flag = -1;
include("db.php");

if(isset($_POST['CHANGE'])){
  $oldP = $_POST['oldP'];
  $newP = $_POST['newP'];
  $conP = $_POST['confirmP'];
  $query = "SELECT * from admin WHERE password='$oldP'";
  $result = mysqli_query($con,$query);
  if(mysqli_num_rows($result) > 0){
            if( $newP == $conP){
              $queryUP = "UPDATE admin SET password ='$conP' where password='$oldP'";
                  if(mysqli_query($con,$queryUP)) {
                    $flag = 1;
                  }
                
            }
            else {
              $flag=2;
            }
  }
  else {
    $flag=0;  
  }
 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Admin | Change Password</title>
<link rel="stylesheet" href="changePass.css">
<style>


</style>
</head>
<body>
<?php  include("sideBar.php");   ?>
<div class="main">
  <h3 style="">CHANGE PASSWARED</h3>
  <?php
  if ($flag == 1)
    echo '<span style="color:blue;">Password now is UPDATED</span>';

   else if ($flag == 0) 
   echo '<span style="color:red;">Old password is wrong,try again</span>';


   else if ($flag == 2) 
   echo '<span style="color:#ff9800;">New,confirm password IS NOT matching</span>';

?>
 <form class="form" method="post">
   <div class="floating-label-group">
        <input  type="password" name="oldP" required>
        <label class="floating-label">Enter old Password</label>
        </div>
        <div class="floating-label-group">
        <input type="password" name="newP" required> 
        <label class="floating-label">Enter new Password</label>
        </div>
        <div class="floating-label-group">
        <input type="password" name="confirmP" required>
        <label class="floating-label">Enter confirm Password</label>
        </div>
   <input type="submit" id="submit" value="CHANGE" name="CHANGE" >    
    </form>
  
</div>
   </body>
   </html>