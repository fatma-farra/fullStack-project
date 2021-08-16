<?php
$empNotFound_msg=false;
$passNOTcorrect_pass = false;
include("db.php");
$empID='';
session_start();
 if(isset($_COOKIE['token'])){
    $token = $_COOKIE['token'];
    $query = "SELECT * FROM auth WHERE token ='$token'";
    if($result = mysqli_query($con,$query)){
        $row = mysqli_fetch_assoc($result);
            $empID = $row['empID'];
            $_SESSION['empID'] = $empID;
    }
}
if(isset($_SESSION['empID'])){
    header("Location:employee_profile.php");
}
if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = "SELECT * FROM employee WHERE username = '$username'";
    $result = mysqli_query($con,$query);
    $row = mysqli_fetch_assoc($result);
     if(mysqli_num_rows($result) > 0){
        $empID = $row['id'];
        $pass=$row['password'];
            if($password == $pass){
                $_SESSION['empID'] = $empID;
                if(isset($_POST['remmember'])){
                    $token = openssl_random_pseudo_bytes(8);
                    $token = bin2hex($token);
                    setcookie("token",$token,time()+(30*24*60*60),"/");
                    $query = "INSERT INTO auth(empID,token) VALUES('$empID','$token')";
                    if(mysqli_query($con,$query))
                        header("Location:employee_profile.php");
                    else
                    echo mysqli_error($con);
                }
                header("Location:employee_profile.php");
            }else{
                $passNOTcorrect_pass = true;            }
        }else{
        $empNotFound_msg =true; ;
     }
    }
?>
<!DOCTYPE html>
<html>
<head>
<title>Employee</title>
<link rel="stylesheet" href="loginEmp.css">
</head>
<body>
<h1> <center >Leave Managment System </center></h1> 

<form method="post" >
<label class="title">EMPLOYEE LOGIN</label> 

<?php if($empNotFound_msg)  echo '<span class="msg">This employee is not found!!</span>'; $write_msg=false;?>
<?php if($passNOTcorrect_pass)  echo '<span class="msg"> The password is not coorrect,try agin!!</span>';$error_pass=false; ?>

<div class="floating-label-group"> 
<input type="text" name="username" id="username" value=""  required>
  <label for="username" class="floating-label">Username</label>
</div> 
 <div class="floating-label-group"> 
  <input type="password"  name="password" id="password" value="" required>
  <label for="password" class="floating-label" >Password</label>
</div>
<div class="checkbox">
<input id="check" type="checkbox" name="remmember" checked />
  <label for="check" style="font-size:17px;font-weight: bold;">Remmember login? </label>
</div>
  <center><input name ="login" type="submit" id="submit" value="LOGIN" ></center>
</form> 
</body>
</html>
