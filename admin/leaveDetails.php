<?php 
include("db.php");
session_start();
 $username = $empID="";
 $ok ="";
 if(!isset($_GET['id']) ){
  header("Location:dashboared.php");
}
 $id = $_GET['id'];
 if(!($id >= 1) )
   $id =1;
 if(!isset($_SESSION['username']) ){
     header("Location:loginAdmin.php");
 }

else{
    $username = $_SESSION['username'];
 }
 $querygetEmpID = "SELECT empID from leavetab where id='$id'";
  $result = mysqli_query($con,$querygetEmpID);
  $res = mysqli_fetch_assoc($result);
  $empID = $res['empID'];

 if(isset($_POST['change_status'])){
  $selected = $_POST['decision'];

      $queryUPdate = "UPDATE leavetab SET status='$selected' where id='$id'";
      if($row = mysqli_query($con,$queryUPdate))
       $ok= '<span id="msg"> Successfuly !! The Status Of This Employee Now is '.$selected."</span>";
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Admin | Leave Detatils</title>
<link rel="stylesheet" href="leaveDetails.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<?php include 'sideBar.php';?>
<div class="main">
<h1>LEAVE DETAILS</h1>
<table>

<tr> 
    <?php  echo $ok ; ?>
</tr>

<?php
$query = "SELECT * from employee WHERE id='$empID'";
$result = mysqli_query($con,$query);
$res = mysqli_fetch_assoc($result);
if($res != null){
$name = $res['fName']." ".$res['lName'];
$username = $res['username'];
$gender = $res['gender'];
$email = $res['email'];
$phone =$res['phone'];

$query2 = "SELECT * from leavetab WHERE id='$id'";
$result2 = mysqli_query($con,$query2);
$quary_res = mysqli_fetch_assoc($result2);
$leave_type = $quary_res['type'];
$from_leave_date = $quary_res['fromDate'];
$to_leave_date = $quary_res['toDate'];
$desc =$quary_res['description'];
$status =$quary_res['status'];
$post_date = $quary_res['postDate'];

}
echo "<tr> ";
    echo '<td >Employee Name:</td>';
    echo '<td class="emNa">'.$name.'</td>';
    echo '<td >Emp username:</td>';
    echo '<td>'.$username.'</td>';
    echo '<td >Gender:</td>';
    echo '<td>'.$gender.'</td>';
 echo "</tr>";
echo "<tr>"; 
    echo '<td >Employee Email:</td>';
    echo '<td>'.$email.'</td>';
    echo '<td >Emp contact No.:</td>';
    echo '<td>'.$phone.'</td>';
    echo '<td></td>';
    echo '<td></td>';

echo "</tr>";

echo "<tr>" ;
    echo '<td>Leave Type:</td>';
    echo '<td>'.$leave_type.'</td>';
    echo '<td>Leave Date:</td>';
    echo '<td>From '. $from_leave_date.' to '.$to_leave_date.'</td>';
    echo '<td>Posting Date</td>';
    echo '<td>'.$post_date.'</td>';

echo "</tr>";

echo "<tr>";
    echo '<td >Employee leave Decription:</td>';
    echo '<td >'.$desc.'</td>';
    echo '<td ></td>';
    echo '<td ></td>';
    echo '<td ></td>';
    echo '<td ></td>';
   
echo "</tr>";
echo "<tr>";
        $color = "";
        if($status[0] == 'w'|| $status[0] == 'W')
        $color ="blue";
        else if($status[0] == 'a' ||$status[0] == 'A')
        $color ="green";
        else
        $color ="red"; 
    echo '<td >leave status:</td>';
    echo '<td style ="color:'.$color.';">'.$status.'</td>';
    echo '<td></td>';
    echo '<td></td>';
    echo '<td></td> ';
    echo '<td></td>';
echo "</tr>";

?>
<?php 
$query3 = "SELECT * from leavetab WHERE id='$id'";
$result3 = mysqli_query($con,$query3);
$quary_res2 = mysqli_fetch_assoc($result3);
$status = $quary_res2['status'];
if ($status[0] == 'w'|| $status[0] == 'W'){
echo '<td ><button class ="viewDetails" name ="TAKE_ACTION" id="myBtn">TAKE ACTION</button>
<div id="myModal" class="modal">
  <div class="modal-content" >
    <span class="close">&times;</span>
    <div  style="margin-left:35px; padding-left:20px;color:green"> <h3>LEAVE TAKE ACTION</h3></div>
    <form method="post">
    <select name="decision"  style="width:100%; height:80px; border: 1px solid rgb(238,247,247);font-size: 20px;padding-left:20px">
    <option value="Approved">Approved</option>
    <option value="Not_Approved" >Not Approved</option>
    </select>
    <div style="padding-top:130px; padding-left:60px;">
   <input type="submit" name="change_status" id="submit" value="SUBMIT" >
   </form>
    </div>
  </div>
</div>';
}
?>
<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>



</td>
    
</tr>

</table>

</div>
</div>

</div>
</body>
</html>