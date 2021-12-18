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
    <title>Book Request</title>
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

}
th,td{
  width: 10%;
}

.scroll{
  width: 101%;
  height: 500px;
  overflow: auto;
}
</style>

<body style="background-color: CornflowerBlue;">


<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="books.php">Books</a> 
  <a href="request.php">Book Request</a>
  <a href="issue_info.php">Issue Information</a>
  <div><a href="expired.php">Expired List</a></div>
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
<div>
  <?php
  if(isset($_SESSION['login_user']))
  {
  ?>
    <div class="container-r" style="margin-left: 1100px;">

      <form action="" method="post">
        <input type="text" name="username" placeholder="Username" required><br><br>
        <input type="text" name="bid" placeholder="BID" required><br><br>
        <button name="submit" style="margin-left: 75px;background-color:blue;color:white;">Submit</button>
      </form>
    </div>
  <?php
  if(isset($_POST['submit']))
  {
    $var1 = '<p style="color:green;">RETURNED</P>';  
    mysqli_query($db,"UPDATE issue_book SET approve='$var1' where username='$_POST[username]' and bid='$_POST[bid]' ");
  }
  }
  ?>
<h2 style="text-align: center;">Date Expired List </h2>
<?php

$c=0;

if(isset($_SESSION['login_user']))
{
  
    $sql="SELECT student.username,roll,books.bid,name,authors,edition,approve,issue,issue_book.return FROM student INNER JOIN issue_book ON student.username = issue_book.username INNER JOIN books ON issue_book.bid=books.bid WHERE issue_book.approve !='' and issue_book.approve !='Yes' order by `issue_book`.`return` ASC ";
    $res=mysqli_query($db,$sql);

    
    echo "<table>";
    echo "<tr style='background-color: green;'>";
    //Table Header
    
    echo "<th>"; echo "Username"; echo "</th>";
    echo "<th>"; echo "Roll No"; echo "</th>";
    echo "<th>"; echo "BID"; echo "</th>";
    echo "<th>"; echo "Book Name"; echo "</th>";
    echo "<th>"; echo "Authors Name"; echo "</th>";
    echo "<th>"; echo "Edition"; echo "</th>";
    echo "<th>"; echo "Status"; echo "</th>";
    echo "<th>"; echo "Iuuse Date"; echo "</th>";
    echo "<th>"; echo "Return Date"; echo "</th>";

    echo "</tr>";
    echo "</table>";

    echo "<div class='scroll'>";
    echo "<table>";

    while($row=mysqli_fetch_assoc($res))
    {
  
        echo "<tr>";
        echo "<td>";  echo $row['username'];  echo "</td>";
        echo "<td>";  echo $row['roll'];  echo "</td>";
        echo "<td>";  echo $row['bid'];  echo "</td>";
        echo "<td>";  echo $row['name'];  echo "</td>";
        echo "<td>";  echo $row['authors'];  echo "</td>";
        echo "<td>";  echo $row['edition'];  echo "</td>";
        echo "<td>";  echo $row['approve'];  echo "</td>";
        echo "<td>";  echo $row['issue'];  echo "</td>";
        echo "<td>";  echo $row['return'];  echo "</td>";

        echo "</tr>";
    }
    
    echo "</table>";
    echo "</div>";
    
}
else
{
    ?>
    <h2 style="text-align: center;">Login to see Information of Borrowed Books</h2>
    <?php
}
?>
</div>
</div>
</body>
</html>