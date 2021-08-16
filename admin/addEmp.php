<?php 
include "config.php";
 $username = "";
 if(!isset($_SESSION['username']) ){
     header("Location:loginAdmin.php");
 }
else{
    $username = $_SESSION['username'];
 }
$msg="";
if(isset($_POST['add'])){
    $username=$_POST['username'];
    $firstName = $_POST['firstName'];
    $lastName= $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $conPassword = $_POST['conPassword'];
    $gender = $_POST['gender'];
    $bod = $_POST['dob'];
    $department = $_POST['department'];
    $city = $_POST['city'];
    $country = $_POST['country'];
    $address = $_POST['address'];
    $mobile = $_POST['mobile'];
    $status="Active";

    $slquery = "SELECT * FROM employee WHERE username  = '$username'";
    $selectresult = mysqli_query($conn,$slquery);
    if(mysqli_num_rows($selectresult)>0)
    {
         $msg = 'This employee exist!!';
    }
    elseif($password != $conPassword){
         $msg = "Passwords doesn't match";
    }
    else{
        $query = " INSERT INTO 
        employee (username,password,fName,lName,gender,email,bod,dep,status,phone,country,city,address) 
        VALUES ('$username','$password','$firstName','$lastName','$gender',
        '$email','$bod','$department','$status','$mobile','$country','$city','$address')";
        if(mysqli_query($conn,$query)){
            $msg = "Add Successfully";
        }else{
            $msg = "Wrong adding".mysqli_error($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="addEmp.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.7/css/all.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300&display=swap" rel="stylesheet">
    <title>Add Employee</title>
</head>
<body>
  <?php include 'sideBar.php';?>
<section>
    <span class="page-name" style="display: inline;">
        ADD EMPLOYEE
    </span>
    <span style="display: block; color: red; margin-top:5px; margin-bottom:-15px; font-size: 16px;"><?php echo $msg; ?></span>
    <form class="example-form" method="post" name="addemp"> 
<div class="left">
<div class="width-100 floating-label-group ">
<input  name="username" id="empcode" onBlur="checkAvailabilityEmpid()" type="text" autocomplete="off" required >
<label for="empcode" class="floating-label">Employee Code(Must be unique)</label>
</div>
<div class="width-50 floating-label-group">
<input id="firstName" name="firstName" type="text" required >
<label class="floating-label">First Name</label>
</div>

<div class="width-50 floating-label-group">
<input id="lastName" name="lastName" type="text" autocomplete="off" required>
<label class="floating-label">Last Name</label>
</div>

<div class="width-100 floating-label-group">
<input  name="email" type="email" id="email" onBlur="checkAvailabilityEmailid()" autocomplete="off" required>
<span id="emailid-availability" style="font-size:12px;"></span> 
<label class="floating-label">Email</label>
</div>

<div class="width-100 floating-label-group">
<input id="password" name="password" type="password" autocomplete="off" required>
<label class="floating-label">Password</label>
</div>

<div class="width-100 floating-label-group">
<input id="confirm" name="conPassword" type="password" autocomplete="off" required>
<label class="floating-label">Confirm Password</label>
</div>
</div>

                        
<div class="right">
<div class="width-50 ">
<select  name="gender" autocomplete="off">
<option value="" disabled selected>Gender...</option>                                          
<option value="Male">Male</option>
<option value="Female">Female</option>
<option value="Other">Other</option>
</select>
</div>

<div class="width-50">
<input id="birthdate" name="dob" type="date" class="datepicker" autocomplete="off" placeholder="Birthdate">
</div>

<div class="width-50">
<select  name="department" autocomplete="off" required>
<option value="" disabled selected>Department...</option>                                           
<option value="Information Technology">Information Technology</option>
<option value="Operations">Operations</option>
<option value="Human Resources">Human Resources</option>
</select>
</div>

<div class="width-50 floating-label-group">
<input id="city" name="city" type="text" autocomplete="off" required>
<label class="floating-label">City/Town</label>
</div>

<div class="width-50 floating-label-group">
<input id="country" name="country" type="text" autocomplete="off" required >
<label class="floating-label">Country</label>
</div>

<div class="width-50 floating-label-group">
<input id="address" name="address" type="text" autocomplete="off" required >
<label class="floating-label">Address</label>
</div>

<div class="width-100 floating-label-group">
<input id="phone" name="mobile" type="tel" maxlength="10" autocomplete="off" required >
<label class="floating-label">Mobile number</label>
</div>

                            
<div class="width-100">
<input type="submit" value="ADD" name="add">
</div>

        </div>        
    </form>
</section>
</body>
</html>