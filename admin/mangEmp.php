<?php
include "config.php";
 $username = "";
 if(!isset($_SESSION['username']) ){
     header("Location:loginAdmin.php");
 }else{
    $username = $_SESSION['username'];
 }
  if(isset($_POST['searchB'])){
    $DEPSeaech = $_POST['search'];
    $query = " SELECT *FROM employee WHERE LOWER (dep) LIKE LOWER('$DEPSeaech%')";
   $result = mysqli_query($conn, $query);
 }
else{
$query = " SELECT * FROM employee";
$result = mysqli_query($conn, $query);
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="mangEmp.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.7/css/all.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300&display=swap" rel="stylesheet">
    <title>Manage Employee</title>
    <style>
        
    </style>
</head>
<body>
<?php include 'sideBar.php';?>
     <table id="table" style="font-weight: bold;font-size:18px;">
        <form method="post">
            <caption>
                MANAGE EMPLOYEE
                <div class="search">
                <input id="search" name="search" type="text" placeholder="Search record(for Depatments)">
                <button id="searchB" type="submit" name="searchB"><i class="fas fa-search"></i></button>
             </div>
            </caption>
        </form>
            <thead style="color:red">
                <tr>
                <td>
                    SL no
                </td>
                <td>
                    Emp Id
                </td>
                <td>
                    Emp Name
                </td>
                <td>
                    Department
                </td>
                <td>
                    Status
                </td>
                <td>
                    Reg Date
                </td>
                <td>
                    Action
                </td>
                </tr>
            </thead>
            <?php 
            while($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo '<td>'.$row['id'].'</td>';
                echo '<td>'.$row['username'].'</td>';
                echo '<td>'.$row['fName'].' '.$row['lName'].'</td>';
                echo '<td>'.$row['dep'].'</td>';
                echo '<td>';
                $x=$row['status'];
                    if($x == "Active" || "ACTIVE")
                        echo "<span style=\"color:green; background-color: inherit;\">"."Active"."</span>";
                    else
                    echo "<span style=\"color:red;\">".$x."</span>";
                echo '</td>';
                echo '<td>'.$row['rgDate'].'</td>';
                echo '<td> 
                <button class="btn" style="background-color: white; font-size: 16px; border: none;
                cursor: pointer;">
                           <a href="updateEmp.php?id='.$row['id'].'" class="btn-link" style="background-color: white; font-size: 16px;
                           border: none; cursor: pointer;">
                           <i class="fas fa-pencil-alt" style="background-color:white; color:RGB(78, 175, 214);"></i></a> 
                        </button>

                        <form style="background-color:white; display: inline; " onsubmit = "event.preventDefault(); myFunction(this);"action="drop.php" method="GET">
                        <input type="hidden" name="id" value="'.$row['id'].'"/>
                        <input type="submit" value="&#10006" class="btn" style="background-color: white; font-size: 16px; border: none;cursor: pointer; color:RGB(78, 175, 214);" />
                        </form>
            </td>';
                echo "</tr>";

            }
                ?> 
        </table>
</div>
<script>
function myFunction(t) {
  var txt;
  var r = confirm("Are  you sure to delete this employee??");
  if(r)
   {
    t.submit();
          return true;
   }
   return false;
}
</script>
<script src="https://cdn.datatables.net/.../js/jquery.dataTables.min.js"> </script>
<script src="https://code.jquery.com/jquery-3.5.1.js"> </script>
<script>
$(document).ready(function() {
    $('#table').DataTable();
} )
</script>
</body>
</html>
 