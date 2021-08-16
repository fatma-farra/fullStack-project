<?php
 include("db.php");
 session_start();
 $username = "";
 if(!isset($_SESSION['username']) ){
     header("Location:loginAdmin.php");
 }else{
    $username = $_SESSION['username'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="leaveHis.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.7/css/all.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300&display=swap" rel="stylesheet">
    <title>Admin | leave History</title>
</head>
<body>
<?php include 'sideBar.php';?>
        <table>
            <caption style="color: green; text-align: left; font-weight: bold; padding-bottom: 15px; word-spacing: 8px;">
                LEAVE HISTORY
            </caption>
            <thead style="color:red;">
                <tr>
                <td>
                    SL no
                </td>
                <td>
                    Emp Name
                </td>
                <td>
                    Leave type
                </td>
                <td>
                    Posting date
                </td>
                <td>
                    Status
                </td>
                <td>
                    Action
                </td>
                </tr>
            </thead>
            <?php
    $sl_no =0;
    $queryLEAVE_info = "SELECT * from leavetab ORDER BY id DESC";
    $result = mysqli_query($con,$queryLEAVE_info);
    if(mysqli_num_rows($result) > 0){
      while($row=mysqli_fetch_assoc($result)){     
        echo "<tr>";
        $id =  $row['id'];
        $emp_id = $row['empID'];
        $leave_type= $row['type'];
        $status = $row['status'] ;
        $post_date = $row['postDate'];

        $queryInside = "SELECT * from employee WHERE id='$emp_id'";
        $res = mysqli_query($con,$queryInside);
        $inside = mysqli_fetch_assoc($res);
        $fname = $inside['fName'];
        $username = $inside['username'];
        
        $color = "";
        if($status[0] == 'w'|| $status[0] == 'W')
        $color ="blue";
        else if($status[0] == 'a' ||$status[0] == 'A')
        $color ="green";
        else
        $color ="red";
      
        echo '<td>'.++$sl_no.'</td>';
        echo '<td  style ="color:blue;">'.$fname.'<br>('.$username.')</td>';
        echo "<td>".$leave_type."</td>";
        echo "<td>".$post_date."</td>";
        echo '<td style ="color:'.$color.';">'.$status.'</td>';
        

        echo '<form method ="post">';
        echo '<td ><button class ="viewDetails" name ="view">';
        echo '<a style="background:#4CAF50;color:white;" href="leaveDetails.php?id='. $id.'">View details</a>';
        echo '</button></td>';
        echo '</form>';
        echo"</tr>";
      }   
 }
    
    ?>
</table>
</body>
</html>