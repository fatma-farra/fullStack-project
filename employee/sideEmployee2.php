<?php
include("db.php");
$empID ="";
$empID =$_SESSION['empID'];
$name =$username='';
$query = "SELECT * FROM employee WHERE id = '$empID'";
    $result = mysqli_query($con,$query);
    if(mysqli_num_rows($result) > 0){
    $row = mysqli_fetch_assoc($result);
        $name = $row['fName'].' '.$row['lName'];
        $username=$row['username'];
      }
if(isset($_POST['logout'])){
    session_unset();
    session_destroy();
    setcookie("token","",time()-(60*60),"/");
    $query = "DELETE FROM auth WHERE empID = '$empID'";
    if(mysqli_query($con,$query)){
        header("Location:loginEmp.php");
    }
}
?>
<!DOCTYPE HTML>
<html>
<head>
  <link rel="stylesheet" href="sideEmployee.css">
<style>

.collapsible,.collapsiblel {
  cursor: pointer;
  padding: 18px;
  width: 100%;
  border: none;
  text-align: left;
  outline: none;
}
.active:after {
  content: "\2212";
}

.content {
  padding: 0 18px;
  max-height: 0;
  overflow: hidden;
  transition: max-height 0.2s ease-out;
  background-color: rgb(243,243,243);

}
a:visited {
  color: black;
}
a:hover {
  color: black;

}
</style>
</head>
<body>
<aside>
  <img src="employee.png" alt="no-icon" "/>
  <br/> <br/>
  <label style="padding: 30px;   font-size: 20px; font-weight:bold;"><?php echo ucwords($name); ?></label><br/>
  <label style="padding: 30px;   font-size: 15px; "><?php echo $username; ?></label>

  <div style="padding-top: 50px;padding-left:30px;">
  <a href="employee_profile.php" style="width:200px; height:50px;font-size: 20px;font-weight:bold;"> <i style="font-size:24px ;padding-right:30px;" class="fa">&#xf007;</i>My Profiles</a>
  </div>
  <div style="padding-top: 20px;">
  <div style="padding-top: 30px;">
  <a href ="changePasswordEmp.php"  style="width:200px; height:50px;font-size: 20px;font-weight:bold;" ><i style="padding-right:25px; padding-left:30px;" class="fa fa-dashboard"></i>Change passwared</a>
</div>
<div style="padding-left:30px;padding-top: 35px;">
<button class="collapsible" name="leaveManagment"  style="border:none; background-color:rgb(173,216,230);font-size: 20px;font-weight:bold;padding-left:5px"><i style="padding-right:30px;" class="fa fa-plus-square"></i>Leaves</button>
<div class="content">
<ul>
 <button  style ="font-size:10px;border:none; font-size: 20px;font-weight:bold;padding-left:10px" > <a href ="Applyleave.php" >Applay leaves</a> </button>
 <button  style ="font-size:10px;border:none; font-size: 20px;font-weight:bold;padding-left:10px ; padding-top : 20px;" > <a href ="leaveHistory.php">leave History</a> </button>
</ul>
</div>
<script>
var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.maxHeight){
      content.style.maxHeight = null;
    } else {
      content.style.maxHeight = content.scrollHeight + "px";
    } 
  });
}
</script>

<form method="post">

<div style=";padding-top: 35px;">
<button  name="logout"  style="border:none; background-color:rgb(173,216,230);font-size: 20px;font-weight:bold;padding-left:5px"><i style="padding-right:30px;" class="fa fa-sign-out"></i>Logout</button>
<div class="content">

  </form>
  </div>

</div>

</aside>
</body>
</html>