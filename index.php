<?php
$write_msg=false;
$error_pass = false;
 session_start();
include("db.php");
if(isset($_POST['submit'])){
    $user_name = $_POST['username'];
    if(!isset($_SESSION['username']))
    $_SESSION['username'] = $user_name;
    $query = "SELECT * from admin WHERE username='$user_name'";
    $result = mysqli_query($con,$query);
    if(mysqli_num_rows($result) > 0){
        $arr_res = mysqli_fetch_assoc($result);
        if($_POST['password'] == $arr_res['password'])
        header("Location:Dashboard.php");
        else
            $error_pass=true; 
        
    }
    else{
        $write_msg=true;
    }
}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="loginAdmin.css">
<title>Admin</title>
</head>
<body>
<h1> <center > Admin login </center></h1> 
<div  class ="login">
<form method="post" >
<?php if($write_msg)  echo '<center class="message">This user is not found!!</center>'; ?>
<?php if($error_pass)  echo '<center class="message">The password is not coorrect,try agin!!</center>'; ?>
<div class="floating-label-group"> 
<input type="text" name="username" id="username" value=""  required>
  <label for="username" class="floating-label">Username</label>
</div> 
 <div class="floating-label-group"> 
  <input type="password"  name="password" id="password" value="" required>
  <label for="password" class="floating-label" >Password</label>
</div>
  <center><input name ="submit" type="submit" id="submit" value="LOGIN" ></center>

</div>
</form>
</body>
</html>