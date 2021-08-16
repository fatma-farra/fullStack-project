<?php
$msg="";
$empID="";
 session_start();
 if(!isset($_SESSION['empID']) ){
  header("Location:loginEmp.php");
}else{
 $empID = $_SESSION['empID'];
}
include("db.php");

if(isset($_POST['sendLeave'])){
 $dateFrom= $_POST['Fdate'];
 $dateTo= $_POST['Tdate'];
 
$type= $_POST['type_leave'];
$status = "Waiting for approval";
$desc = $_POST['desc'];
$empID = $_SESSION['empID'];
 if($dateFrom>$dateTo){
   $msg = 'NOT Vailed date, the date(From) IS GREATER than date(To)';
 }
 else{
    $query = "INSERT INTO leavetab(type,fromDate,toDate,description,status,empID) VALUES ('$type','$dateFrom','$dateTo','$desc','$status','$empID')";
    if(mysqli_query($con,$query)){
        $msg = 'SUCCESSFULLY!!Applay leave is DONE ,waiting for admin';
    }
    else{
           echo "failed".mysqli_error($con);

    }


}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Employee | Apply leave</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="applyLeave.css">
</head>
<body>
<?php include("sideEmployee.php"); ?>
<div class="main">
<?php  echo "<span id='msg'>".$msg."</span>"; ?>
    <form method="post" class="form">
      <div class="date">
      <div class="floating-label-group">
    <input type="date" name="Fdate" required>
   <label class="floating-label">From Date:</label>
  </div>
  <div class="floating-label-group">
   <input type="date" name="Tdate" required>
   <label class="floating-label">To Date:</label>
   </div>
  </div>
  <select name="type_leave" > 
            <option value="Casual Leave">Casual Leave</option>
            <option value="medical leave">Medical Leave</option>
            <option value="restricted holiday">Restricted Holiday</option>
        </select>
        <div class="floating-label-group">
        <input type="text" name="desc" value="" >
        <label class="floating-label">Description</label>     
        </div>
        <div class="butn">
      <input name ="sendLeave" type="submit" id="submit" value="APPLY" >
    </div>
    </form>
      </div>
  </body>
  </html>