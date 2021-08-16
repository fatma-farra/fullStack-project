<?php
    session_unset();
    session_destroy();
    setcookie("token","",time()-(60*60),"/");
    $query = "DELETE FROM auth WHERE empID = '$empID'";
    if(mysqli_query($con,$query)){
        header("Location:loginEmp.php");
    }
?>