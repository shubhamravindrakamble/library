<?php
include "connection.php";
include "navbar.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>books</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<style>
    .btn-s{
        background-color:black;
        color:white;
        width:120px;
        height:40px;
        border-radius:5px;
        margin-top:5px;

    }

    .btn-s:hover{
        background-color:green;
    }
    .s-form{
        margin:10px;
        margin-left:10px;
    }
    input{
        margin:0 10px;
    }
    .s-bar{
        padding-left:1000px;
    }


    /* ---------------------------sidenav-style----------------------------------------- */
    body {
  font-family: "Lato", sans-serif;
  transition: background-color .5s;
}

.sidenav {
  height: 100%;
  margin-top:110px;
  width: 0;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: black;
  overflow-x: hidden;
  transition: 0.5s;
  padding-top: 60px;
}

.sidenav a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 25px;
  color: #818181;
  display: block;
  transition: 0.3s;
}

.sidenav a:hover {
  color: #f1f1f1;
}

.sidenav .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
  margin-left: 50px;
}

#main {
  transition: margin-left .5s;
  padding: 16px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}

.b:hover
{
 width:200px;
 height: 50px;
 color:white;
 background-color:red;
}

input{
    margin-left:400px;
}

.book{
    margin:0 auto;
}



</style>

<body style="background-color:MediumBlue;">



<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="add.php">Add Books</a> 
  <a href="delete.php">Delete Books</a>
  <a href="#">Book Request</a>
  <a href="#">Issue Information</a>
</div>

<div id="main">
  
  <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; open</span>
<div style="background-color: red;height: 510px;width: 500px;margin:10px auto;border-radius:15px;text-align:center;">
  <h2 style="color:white;font-size:30px;text-align: center;padding-top: 20px;">Add Books</h2>
<form action="" method="post">
 <input type="text" name="bid" placeholder="Book id" required="" ><br><br>
 <input type="text" name="name" placeholder="Book Name"  required=""><br><br>
 <input type="text" name="authors" placeholder="Authors Name" required=""><br><br>
 <input type="text" name="edition" placeholder="Edition" required="" ><br><br>
 <input type="text" name="status" placeholder="Status" required="""><br><br>
 <input type="text" name="quantity" placeholder="Quantity" required=""><br><br>
 <input type="text" name="department" placeholder="Department Name" required=""><br><br>
 <button name="submit" style="background-color: black;color:white;">ADD</button>
 </form>
 </div>
<?php
if(isset($_POST['submit']))
{
  if(isset($_SESSION['login_user']))
  {
    mysqli_query($db,"INSERT INTO books VALUE ('$_POST[bid]','$_POST[name]','$_POST[authors]','$_POST[edition]','$_POST[status]','$_POST[quantity]','$_POST[department]') ;");
    ?>
   <script>
   alert("Book Added Successfully.");
   </script>
    <?php
  }
  else
  {
    ?>
    <script>
    alert("you need to login first.");
    </script>
    <?php
  }
}
?>
 </div>

<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "300px";
  document.getElementById("main").style.marginLeft = "300px";
  document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
  document.body.style.backgroundColor = "MediumBlue";
}
</script>
</body>
</html>