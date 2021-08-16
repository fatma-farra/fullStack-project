<?php 
include "config.php";
$user_id="";
$msg="";
 $username = "";
 if(!isset($_SESSION['username']) ){
     header("Location:loginAdmin.php");
 }else{
    $username = $_SESSION['username'];
 }
$emp_id =$_GET['id'];
        $user_empcod = $user_fname = $user_lname = $user_email = $user_mobile = $user_gender =
        $user_dob = $user_depart = $user_country = $user_city = $user_address = '';
$select_query = "SELECT * FROM employee WHERE id = '$emp_id'";
$select_result = mysqli_query($conn,$select_query);
    while($select_row = mysqli_fetch_assoc($select_result)){
        $user_empcod = $select_row['username'];
        $user_fname = $select_row['fName'];
        $user_lname = $select_row['lName'];
        $user_email = $select_row['email'];
        $user_mobile = $select_row['phone'];
        $user_gender = $select_row['gender'];
        $user_dob = $select_row['bod'];
        $user_depart = $select_row['dep'];
        $user_country = $select_row['country'];
        $user_city = $select_row['city'];
        $user_address = $select_row['address'];
    }

    if(isset($_POST['update'])){
        $username = $_POST['username'];
        $fname =$_POST['firstName'];
        $lname = $_POST['lastName'];
        $email = $_POST['email'];
        $mobile = $_POST['mobileno'];
        $gender = $_POST['gender'];
        $dob = $_POST['dob'];
        $depart = $_POST['department'];
        $country = $_POST['country'];
        $city = $_POST['city'];
        $address = $_POST['address'];
  
      $query = "UPDATE employee SET 
        username = '$username',
        fname ='$fname',
        lname = '$lname',
        email = '$email',
        phone = '$mobile',
        gender = '$gender',
        bod = '$dob',
        dep = '$depart',
        country = '$country',
        city = '$city',
        address = '$address'
      WHERE id=$emp_id";
      
      if(mysqli_query($conn,$query)){
        $msg= " Updated profile successfully ";
      }else{
        $msg= "error in updating profile".mysqli_error($conn);
      }
    }   
    
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="updateEmp.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.7/css/all.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300&display=swap" rel="stylesheet">
    <title>Update Employee</title>
</head>
<body>
<?php include 'sideBar.php';?>
<section>
  <span class="page-name" style="color: black;">
            UPDATE EMPLOYEE
    </span>
  <span id="msg"><?php echo $msg; ?></span>
    <form id="example-form" method="post" name="addemp">
    
<div class="left">
    <h2 style="color: #2aa72a; background-color: inherit; margin: 10px;">
        Update Employee Details
    </h2>
    
<div class="width-100">
  <label for="username">Employee Code</label>
<input  name="username" id="username" onBlur="checkAvailabilityEmpid()" type="text" autocomplete="off" required placeholder="Employee Code(Must be unique)"
value="<?php echo $user_empcod;?>">
<span id="empid-availability" style="font-size:12px;"></span> 
</div>
<div class="width-50">
  <label for="firstName">First Name</label>
<input id="firstName" name="firstName" type="text" required placeholder="First name" value="<?php echo $user_fname;?>">
</div>

<div class="width-50">
  <label for="lastName">Last Name</label>
<input id="lastName" name="lastName" type="text" autocomplete="off" required placeholder="Last name" value="<?php echo $user_lname;?>">
</div>

<div class="width-100">
  <label for="email">Email</label>
<input  name="email" type="email" id="email" onBlur="checkAvailabilityEmailid()" autocomplete="off" required placeholder="Email" 
value="<?php echo $user_email;?>">
<span id="emailid-availability" style="font-size:12px;"></span> 
</div>

<div class="width-100">
  <label for="phone">Mobile number</label>
    <input id="phone" name="mobileno" type="tel" maxlength="10" autocomplete="off" required placeholder="Mobile number"
    value="<?php echo $user_mobile;?>">
    </div>

</div>

                        
<div class="right" style="margin-top: 60px;">
<div class="width-50">
  <label for="sex">Gender</label>
<select  id="sex"  name="gender" autocomplete="off">
<option value="" disabled selected> Gender...</option>                                          
<option value="Male" <?php echo ($user_gender == 'Male')?'selected':''?>>Male</option>
<option value="Female" <?php echo ($user_gender == 'Female')?'selected':''?>>Female</option>
</select>
</div>

<div class="width-50">
<label for="birthdate">Birthdate</label><br>
<input id="birthdate" name="dob" type="date" class="datepicker" autocomplete="off" placeholder="Birthdate" value="<?php echo $user_dob;?>">
</div>

<div class="width-50">
  <label for="dep">Department</label><br>
<select id="dep" name="department" autocomplete="off">
<option value="" disabled selected> Department...</option>                                           
<option value="Information Technology" <?php echo ($user_depart == 'Information Technology')?'selected':''?>>Information Technology</option>
<option value="Operations" <?php echo ($user_depart == 'Operations')?'selected':''?>>Operations</option>
<option value="Human Resources" <?php echo ($user_depart == 'Human Resources')?'selected':''?>>Human Resources</option>
</select>
</div>

<div class="width-50">
  <label for="city">City</label><br>
<input id="city" name="city" type="text" autocomplete="off" required placeholder="City/Town" value="<?php echo $user_city;?>">
</div>

<div class="width-50">
  <label for="country">Country</label><br>
<input id="country" name="country" type="text" autocomplete="off" required placeholder="Country" value="<?php echo $user_country;?>">
</div>

<div class="width-50">
    <label for="address">Address</label><br>
    <input id="address" name="address" type="text" autocomplete="off" required placeholder="Address" value="<?php echo $user_address;?>">
    </div>

                            
<div class="width-100">
<input type="submit" value="UPDATE" name="update">
</div>

        </div>        
    </form>
</section>
</body>
</html>