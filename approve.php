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
    <title>Approve Request</title>
</head>
<style>

.s-bar{
        padding-left:1000px;
    }

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



</style>

<body style="background-color: CornflowerBlue;">


<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="books.php">Books</a> 
  <a href="request.php">Book Request</a>
  <a href="issue_info.php">Issue Information</a>
</div>

<div id="main">
  
  <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; open</span>


<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "300px";
  document.getElementById("main").style.marginLeft = "300px";
  document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
  document.body.style.backgroundColor = "aqua";
}
</script>
<div class="container" style="height: 320px;width: 400px;background-color: black;margin: 0 auto;border-radius:20px;opacity: 0.7;">
<h3 style="text-align: center;color: white;padding-top: 30px;">Approve Request</h3>
<br>
<form action="" method="post" style="text-align: center;">
<input type="text" name="approve" placeholder="Approve or not" required><br><br>
<input type="text" name="issue" placeholder="Issue date yyyy-mm-dd" required><br><br>
<input type="text" name="return" placeholder="Return date yyyy-mm-dd" required><br><br>
<button name="submit" style="background-color: blue;color: white;margin-top: 5px;">Approve</button>
</form>
</div>
</div>
<?php
if(isset($_POST['submit']))
{
    mysqli_query($db,"UPDATE `issue_book` SET `approve` ='$_POST[approve]',`issue` = '$_POST[issue]',`return` = '$_POST[return]' where username='$_SESSION[name]' and bid='$_SESSION[bid]';");

    mysqli_query($db,"UPDATE books SET quantity = quantity - 1 where bid='$_SESSION[bid]';");

    mysqli_query($db,"SELECT quantity from books where bid='$_SESSION[bid]'; ");

    while($row=mysqli_fetch_assoc($res))
    {
        if($row['quantity']==0)
        {
            mysqli_query($db,"UPDATE books SET status='not-available' where bid='$_SESSION[bid]';");
        }
    }
    ?>
     <script>
    alert("Updated Successfully.");
    window.location="request.php";
    </script>
    <?php

}
?>
</body>
</html>