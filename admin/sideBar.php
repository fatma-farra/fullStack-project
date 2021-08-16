<?php
if(isset($_POST['logout'])){
  session_unset();
  session_destroy();
  header("Location:../index.php");
}?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.7/css/all.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300&display=swap" rel="stylesheet">
    <title>Document</title>
    <style>
        *{
    background-color:#f4f4f4;
    margin: 0;
    padding: 0;
    font-family: 'Roboto Condensed';
    font-weight: bold;
}
.continer{
    display: grid;
    grid-template-columns: 21% auto;
    grid-template-rows: 101px auto;
    margin: 0;
    row-gap: 0;
    grid-template-areas: 'header header' 'side main';
}
.proj-name{
    grid-area: header;
    position: sticky;
    top: 0;
    width: 100%;
    height: 70px;
    background-color: rgb(114, 202, 253);
    color: white;
    padding:5px;
    margin: 0px;
    margin-bottom: 10px;
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 3;
}
h4{
    background-color: inherit;
    display: inline-block;
    font-size: 40px;
    font-family: 'Roboto Condensed';
    text-align: center;
}
aside{
    grid-area: side;
    position: sticky;
    top: 0;
    background-color: lightblue;
    width: 52%;
    height: 100vh;
    margin-top: 0;
    grid-row-start: 1;
    padding-top: 150px;
    padding-right: 25px;
    padding-left: 54px;
}
div.profile, h5{
    background-color: inherit;
}
img {
    border-radius: 50%;
    width: 50px;
    height: 50px;
  }
  ul{
    list-style: none; 
    margin-top: 20px;
    background-color: lightblue;
  }
  li,i{
    background-color: lightblue;
    margin-top: 20px;
  }
  .dropbtn {
    background-color: lightblue;
    font-size: 16px;
    border: none;
    cursor: pointer;
  }
  
  .dropbtn:hover, .dropbtn:focus {
    background-color: lightblue;
  }
  
  .dropdown {
    display: inline-block;
  }
  
  .dropdown-content {
    display: none;
    position: absolute;
    background-color: #f1f1f1;
    min-width: 160px;
    overflow: auto;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
  }
  
  .dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
  }
  
  .dropdown a:hover {background-color: #ddd;}
  
  .show {
      display: block;
}
.dropbtn2 {
    background-color: lightblue;
    font-size: 16px;
    border: none;
    cursor: pointer;
  }
  
  .dropbtn2:hover, .dropbtn2:focus {
    background-color: lightblue;
  }
  
  .dropdown2 {
    display: inline-block;
  }
  
  .dropdown2-content {
    display: none;
    position: absolute;
    background-color: #f1f1f1;
    min-width: 160px;
    overflow: auto;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
  }
  
  .dropdown2-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
  }
  
  .dropdown2 a:hover {
      background-color: #ddd;
    }
    .btn{
      background-color: lightblue;
    font-size: 16px;
    border: none;
    cursor: pointer;
    }
    .btn-link{
      background-color: lightblue;
    font-size: 16px;
    border: none;
    cursor: pointer;
    }
    a:visited,:active,:link{
      text-decoration: none;
      color:black;
    }
    </style>
</head>
<body>
    <div class="continer">
        <div class="proj-name">
           <h4>
            Employee Leave Managment System
        </h4>
        </div>
            <aside>
                <div class="profile">
                    <img src="admin.png" alt="Avatar">
                    <h5>
                        Admin
                    </h5>
                </div>
                <div class="dash">
                    <ul>
                        <li>
                            <button class="btn">
                              <i class="fas fa-tachometer-alt"></i>
                              <a href="Dashboard.php" class="btn-link">  Dashboard </a> 
                             </button>
                        </li>
                        <li>
                            <div class="dropdown">
      <button onclick="myFunction1()" class="dropbtn">
        <i class="fas fa-address-card"></i>
        Employees   
    </button>
      <div id="myDropdown" class="dropdown-content">
           <a href="addEmp.php">Add Employee</a> 
          <a href="mangEmp.php">Manage Employee</a>  
      </div>
    </div>
    
    <script>
    function myFunction1() {
      document.getElementById("myDropdown").classList.toggle("show");
    }
    window.onclick = function(event) {
      if (!event.target.matches('.dropbtn')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
          var openDropdown = dropdowns[i];
          if (openDropdown.classList.contains('show')) {
            openDropdown.classList.remove('show');
          }
        }
      }
    }
    </script>
                        </li>
                        <li>
                            <div class="dropdown2">
                                <button class="dropbtn2">
                                    <i class="fas fa-desktop"></i>
                                  Leave Managment   
                              </button>
                                <div id="myDropdown2" class="dropdown2-content">
                                  <a href="leaveHis.php">All Leave</a>
                                </div>
                              </div>
                              
                              <script>
                              var dropdown = document.getElementsByClassName("dropbtn2");
                                var i;
                                
                                for (i = 0; i < dropdown.length; i++) {
                                  dropdown[i].addEventListener("click", function() {
                                  this.classList.toggle("active");
                                  var dropdownContent = this.nextElementSibling;
                                  if (dropdownContent.style.display === "block") {
                                  dropdownContent.style.display = "none";
                                  } else {
                                  dropdownContent.style.display = "block";
                                  }
                                  });
                                }
                              </script>
                        </li>
                        <li>
                          <button class="btn">
                           <i class="fas fa-tachometer-alt"></i>
                           <a href="changePass.php" class="btn-link">  Change password </a> 
                          </button>
                            
                        </li>
                        <li>
                        <form method="post"  style="background-color: lightblue;" >
                          <i class="fas fa-sign-out-alt"  style="background-color: lightblue;"></i>
                          <button class="btn"  name ="logout" style="background-color: lightblue;">Logout</button>
                        </form>
                            
                        </li>
                    </ul>
                </div>
            </aside>
</body>
</html>