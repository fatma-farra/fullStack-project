<?php
include("db.php");
session_start();
$username =$fName=$lName=$dob=$dep=$gender=$email=$city=$country=$phone= "";
$msg='';
if(isset($_COOKIE['token'])){
    $token = $_COOKIE['token'];
    $query = "SELECT * FROM auth WHERE token ='$token'";
    if($result = mysqli_query($con,$query)){
        $row = mysqli_fetch_assoc($result);
        $empID = $row['empID'];
        $_SESSION['empID'] = $empID;
    }
}
if(!isset($_SESSION['empID']) ){
    header("Location:loginEmp.php");
}else{
   $empID = $_SESSION['empID'];
}
$query = "SELECT * FROM employee WHERE id='$empID'";
if($result = mysqli_query($con,$query)){
        $info = mysqli_fetch_assoc($result);
        $username= $info['username'];
        $fName= $info['fName'];
        $lName= $info['lName'];
        $dob= $info['bod'];
        $dep= $info['dep'];
        $gender= $info['gender'];
        $email= $info['email'];
        $city= $info['city'];
        $country= $info['country'];
        $address= $info['address'];
        $phone= $info['phone'];
}
if(isset($_POST['update'])){
       
        if(!empty(trim($_POST['fName'])))
        $fName= $_POST['fName'];
        if(!empty(trim($_POST['lName'])))
        $lName= $_POST['lName'];
        if(!empty(trim($_POST['bod'])))
        $dob= $_POST['bod'];
        if(!empty(trim($_POST['dep'])))
        $dep= $_POST['dep'];
        if(!empty(trim($_POST['gender'])))
        $gender= $_POST['gender'];
        if(!empty(trim($_POST['email'])))
        $email= $_POST['email'];
        if(!empty(trim($_POST['city'])))
        $city= $_POST['city'];
        if(!empty(trim($_POST['country'])))
        $country= $_POST['country'];
        if(!empty(trim($_POST['address'])))
        $country= $_POST['address'];
        if(!empty(trim($_POST['phone'])))
        $phone= $_POST['phone'];

        
        $query = "UPDATE employee SET
            username ='$username',
            fName ='$fName',
            lName ='$lName',
            bod ='$dob',
            dep ='$dep',
            gender ='$gender',
            email ='$email',
            country ='$country',
            city ='$city',
            address ='$address',
            phone ='$phone'
            where id='$empID'";
        
           if(mysqli_query($con,$query)){
              $msg = 'SUCCESSFULLY!! Updated is DONE';
           }
           else{
                $msg = 'Updated dose not done';
           }
      }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="empPro.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.7/css/all.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300&display=swap" rel="stylesheet">
    <title>Update Employee</title>
</head>
<body>
<?php include 'sideEmployee.php';?>
<section>
  <span class="page-name" style="color: black;">
            UPDATE EMPLOYEE DETAILS 
    </span>
  <span id="msg"><?php echo $msg; ?></span>
    <form class="form" method="post" name="addemp">
    
<div class="left">    
<div class="width-100">
  <label for="username">Employee Code</label>
<input  name="username" id="username" onBlur="checkAvailabilityEmpid()" type="text" autocomplete="off" required placeholder="Employee Code(Must be unique)"
disabled value="<?php echo $username;?>">
<span id="empid-availability" style="font-size:12px;"></span> 
</div>
<div class="width-50">
  <label for="firstName">First Name</label>
<input id="firstName" name="fName" type="text" required placeholder="First name" value="<?php echo $fName;?>">
</div>

<div class="width-50">
  <label for="lastName">Last Name</label>
<input id="lastName" name="lName" type="text" autocomplete="off" required placeholder="Last name" value="<?php echo $lName;?>">
</div>

<div class="width-100">
  <label for="email">Email</label>
<input  name="email" type="email" id="email" onBlur="checkAvailabilityEmailid()" autocomplete="off" required placeholder="Email" 
value="<?php echo $email;?>">
<span id="emailid-availability" style="font-size:12px;"></span> 
</div>

<div class="width-100">
  <label for="phone">Mobile number</label>
    <input id="phone" name="phone" type="tel" maxlength="10" autocomplete="off" required placeholder="Mobile number"
    value="<?php echo $phone;?>">
    </div>

</div>

                        
<div class="right" style="margin-top: 60px;">
<div class="width-50">
  <label for="sex">Gender</label>
<select  id="sex"  name="gender" autocomplete="off">
<option value="" disabled selected> Gender...</option>                                          
<option value="Male" <?php echo ($gender == 'Male')?'selected':''?>>Male</option>
<option value="Female" <?php echo ($gender == 'Female')?'selected':''?>>Female</option>
</select>
</div>

<div class="width-50">
<label for="birthdate">Birthdate</label><br>
<input id="birthdate" name="bod" type="date" class="datepicker" autocomplete="off" placeholder="Birthdate" value="<?php echo $dob;?>">
</div>

<div class="width-50">
  <label for="dep">Department</label><br>
<select id="dep" name="dep" autocomplete="off">
<option value="" disabled selected> Department...</option>                                           
<option value="Information Technology" <?php echo ($dep == 'Information Technology')?'selected':''?>>Information Technology</option>
<option value="Operations" <?php echo ($dep == 'Operations')?'selected':''?>>Operations</option>
<option value="Human Resources" <?php echo ($dep == 'Human Resources')?'selected':''?>>Human Resources</option>
</select>
</div>

<div class="width-50">
  <label for="city">City</label><br>
<input id="city" name="city" type="text" autocomplete="off" required placeholder="City/Town" value="<?php echo $city;?>">
</div>

<div class="width-50">
  <label for="country">Country</label><br>
<input id="country" name="country" type="text" autocomplete="off" required placeholder="Country" value="<?php echo $country;?>">
</div>

<div class="width-50">
    <label for="address">Address</label><br>
    <input id="address" name="address" type="text" autocomplete="off" required placeholder="Address" value="<?php echo $address;?>">
    </div>

                            
<div class="width-100">
<input type="submit" value="UPDATE" name="update">
</div>
</div>        
</form>
</section>
</body>
</html>