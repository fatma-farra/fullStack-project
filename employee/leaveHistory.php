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
   $msg = '<center style="color:red;background:yellow;font-size=20px;"><br><center><b>NOT Vailed date</b>, the date(From) IS GREATER than date(To)<br></center>';
 }
 else{
    $query = "INSERT INTO leavetab(type,fromDate,toDate,description,status,empID) VALUES ('$type','$dateFrom','$dateTo','$desc','$status','$empID')";
    if(mysqli_query($con,$query)){
        $msg = '<center style="color:green;background:yellow;font-size=20px;"><br><center><b>SUCCESSFULLY!! </b>Applay leave is DONE ,waiting for admin<br></center>';
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
<title>Employee | Leave History</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="leaveHistory.css">
</head>
<?php include("sideEmployee.php"); ?>
<div class="main">
<h2>LEAVE HISTORY </h2>
<form method="post">
 <div class="search"> 
      <input id="searchT" name="search" type="text" placeholder="Search record (for status)">
      <input id="searchB" name="searchB" type="submit" value="Search">
  </div>
  </form>
 <table>
<tr style="border-bottom: 1px solid rgb(223,223,223);"> 
    <th >SL No.</th>
    <th >TypeOfLeave</th>
    <th>From</th>
    <th>To</th>
    <th>Description</th>
    <th>Posting Date</th>
    <th>status</th>
</tr>
    <?php
$slNO=0;
if(isset($_POST['searchB'])){
  $StatusSeaech = $_POST['search'];
  $query = "SELECT * from leavetab WHERE status='$StatusSeaech' and empID='$empID'";
  $result = mysqli_query($con, $query);
}
else{
$queryLEAVE_info = "SELECT * from leavetab WHERE empID='$empID'";
$result = mysqli_query($con,$queryLEAVE_info);
}
$slNO=$type=$from=$to=$desc=$status=$postDate='';
     if(mysqli_num_rows($result) > 0){
       while($row = mysqli_fetch_assoc($result)){
        $type = $row['type'];
        $from = $row['fromDate'];
        $to = $row['toDate'];
        $desc = $row['description'];
        $status = $row['status'];
        $postDate = $row['postDate'];        
   
    $color = "";
    if($status[0] == 'w'|| $status[0] == 'W')
    $color ="blue";
    else if($status[0] == 'a' ||$status[0] == 'A')
    $color ="green";
    else
    $color ="red";
    
    echo '<td>'.++$slNO.'</td>';
    echo "<td>".$type."</td>";
    echo "<td>".$from."</td>";
    echo "<td>".$to."</td>";
    echo "<td>".$desc."</td>";
    echo "<td>".$postDate."</td>";
    echo '<td style ="color:'.$color.';">'.$status.'</td>';
    echo '</tr>';
     }
    }
?>
 </table>
 </div>
</body>
</html>
