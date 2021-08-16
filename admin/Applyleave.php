<?php
$msg="";
$empID="";
session_start();
if(isset($_COOKIE['token'])){
    $token = $_COOKIE['token'];
    $query = "SELECT * FROM auth WHERE token ='$token'";
    $result = mysqli_query($con,$query);
        $row = mysqli_fetch_assoc($result);
            $empID = $row['empID'];
            $_SESSION['empID'] = $user_id;
        
    }

if(!isset($_SESSION['empID'])){
    header("Location:loginAdmin.php");
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
$empID = 10;
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
<title>Employee | Apply leave</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body {
  font-family: Arial;
  background-color:rgb(238,238,238);
}

header {
  background-color:rgb(0,191,255);
  padding-top: 10px;
  text-align: center;
  font-size: 30px;
  height:100px;
  color: white;
}

a{
    width:300px;
    height:40px;
    border:none;
    font-size: 20px;
    font-weight:bold;

}
table{
    font-family: 'Arial';
    font-weight: bold;
      border:none;
      padding-top:80px;
      margin-top:50px;
      padding-left:30px;
      margin-left:400px;
      width:70%;
      height:90%;
      background-color:white;
  }
  tr,td{
    border:none;
    background-color:white; 
  }

  td{
      padding:20px;
      
  }
  
  input[type="text"],select{
    font-weight:bold;
    font-size: 15px;
    float:left; 
    border: none;
    border-bottom: 2px solid #ccc;
    width: 80%;
    padding: 10px 30px;
    margin:20px;
    background-color:white;
}
  input[type="submit"] {
          margin-bottom: 30px;
            height: 40px;
            width: 100px;
            margin-top: 10px;
            background-color: green;
            color: white;
            width: 70px;
            align-self: center;
            outline: none;
            border: none;
            border-radius:2px;
        }
        input[type=submit]:hover{
            background-color:lightseagreen;
            color:black;
            cursor:pointer;
        }
a:visited {
  color: black;
}
a:hover {
  color: black;

}
a { text-decoration: none;color:black; }

</style>
</head>
<body>
<header>
  <h3>Employee Leave Managment System</h3>
</header>
<?php include("sideEmployee.php"); ?>
<table>
    <form method="post">
    <tr>
        <td> <label style="padding-bottom:20px;border-bottom: 2px solid #ccc;">From Date:<input type="date" name="Fdate" required></label></td>
        <td> <label style="padding-bottom:20px; border-bottom: 2px solid #ccc;">To Date:<input type="date" name="Tdate" required></label></td>
    </tr>

    <tr>
        <td><select style="width:100%;font-weight:bold;" name="type_leave" > 
            <option  style="height:30px" value="Casual Leave">Casual Leave</option>
            <option value="medical leave">Medical Leave</option>
            <option value="restricted holiday">Restricted Holiday</option>
        </select></td>
    </tr>

    <tr>
        <td><input style="width:100%;" type="text" placeholder="Description" name="desc" ></td>
    </tr>

    <tr>
        <td><?php  echo $msg; ?></td>
        

        <td><input name ="sendLeave" type="submit" id="submit" value="APPLY" ></td>
    </tr>
</form>
</table>
  </body>