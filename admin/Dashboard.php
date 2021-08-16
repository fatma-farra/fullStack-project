<?php
 session_start();
 $username = "";
 if(!isset($_SESSION['username']) ){
     header("Location:loginAdmin.php");
 }
else{
    $username = $_SESSION['username'];
 }
 $employee_num=0;
 $Department_num=0;
 $LEAVEAPP_NUM=0;

include("db.php");
  $queryEMP_NUM = "SELECT * from employee";
  $result = mysqli_query($con,$queryEMP_NUM);
  $employee_num = mysqli_num_rows($result);

  $queryDEP_NUM = "SELECT COUNT( DISTINCT dep)FROM employee";
  $result = mysqli_query($con,$queryDEP_NUM);
    $row = mysqli_fetch_assoc($result);
    $Department_num =$row['COUNT( DISTINCT dep)']; 
  $queryLEAVEAPP_NUM = "SELECT * from leavetab";
  $result = mysqli_query($con,$queryLEAVEAPP_NUM);
      $LEAVEAPP_NUM = mysqli_num_rows($result);
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Admin | Dashbord</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="Dashboard.css">
</head>
<body>
<?php include("sideBar.php");?>
<div class="main">
<div class="div-total">
<div  class="total"> TOTLE REGD EMPLOYEE <br/><br/> <?php echo '<span class="num" style="background-color:black;">'.$employee_num; ?></span></div>
  <div class="total"> TOTLE DEPARMENTS <br/><br/><span class="num" style="background-color:black;"><?php echo $Department_num;?></span></div>
  <div class="total" > TOTLE LEAVE APPLICATIONS <br/><br/><span class="num" style="background-color:black;"><?php echo $LEAVEAPP_NUM;?></span></div>
  </div >
  

 <table style="margin-top: 20px; background-color: white;  border-spacing: 15px; width:152.5vh"> 
 <caption id="title" style="background-color: white; color:green; text-align: left; padding: 10px;
    font-size: 20px;
    font-weight: bold;">LATEST LEAVE APPLICATIONS</caption>
<thead>
    <td   >SL no.</td>
    <td   >Employee Name</td>
    <td   >Leave Type</td>
    <td   >Posting Date</td>
    <td   >status</td>
    <td   >Action</td>
</thead>
  
<?php
    $sl_no=0;
    $cot=1;
    $queryLEAVE_info = "SELECT * FROM leavetab ORDER BY id DESC";
    $result = mysqli_query($con,$queryLEAVE_info);
        if(mysqli_num_rows($result) > 0){
            $id=$type=$empID=$name=$postDate=$status=$username='';
            while($row = mysqli_fetch_assoc($result)){
                  if($cot >6)
                        break;
                  $id =$row['id'] ;
                  $type =$row['type'] ;
                  $status =$row['status'] ;
                  $empID = $row['empID'] ;
    
              $queryInside = "SELECT * from employee WHERE id='$empID'";
              $res = mysqli_query($con,$queryInside);
              if(mysqli_num_rows($res) > 0){
                  $inside = mysqli_fetch_assoc($res);
                  $name =$inside['fName'].' '.$inside['lName'];
                  $username = $inside['username'];
                  $queryInside = "SELECT * from leavetab WHERE id='$id'";
                  $resl = mysqli_query($con,$queryInside);
                  $get = mysqli_fetch_assoc($resl);
                  $postDate =$get['postDate'];

              $color = "";
              if($status[0] == 'w'|| $status[0] == 'W')
              $color ="blue";
              else if($status[0] == 'a' ||$status[0] == 'A')
              $color ="green";
              else
              $color ="red";
              
              echo '<td>'.++$sl_no.'</td>';
              echo '<td  style ="color:blue;">'.$name.'<br>('.$username.')</td>';
              echo "<td>".$type."</td>";
              echo "<td>".$postDate."</td>";
              echo '<td style ="color:'.$color.';">'.$status.'</td>';
              

              echo '<form method ="POST">';
              echo '<td ><button class ="viewDetails">';
              echo '<a style="background:#4CAF50;color:white;" href="leaveDetails.php?id='. $id.'" target ="_self">View details</a>';
              echo '</button></td>';
              echo '</form>';
              echo"</tr>";
                                  }
          ++$cot;
                              }

                      
        }
?>
 </table>
</div>
</body>
</html>