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
<body style="background-color:LightSkyBlue;">


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




<div class="s-bar">

<form class="s-form" action="" method="post" name="form1" >
        <input type="text" name="search" placeholder="search books" >
        <button class="btn-s" name="submit">
        <span class="fa fa-search"></span>&nbsp;Search
        </button>

</div>

<!-- --------------------------------book-request----------------------------------- -->

<div class="s-bar">

&nbsp;<form class="s-form" action="" method="post" name="form1" >
        <input type="text" name="bid" placeholder="Enter Book Id" >
        <button class="btn-s" name="submit1">
        &nbsp;Request
        </button>

</div>



    <div id ='h'>
    <h2 style="font-size:30px; text-align:left;padding-left:70px;">LIST OF BOOKS</h2>
</div>

    <?php

    if(isset($_POST['submit']))
    {
        $q=mysqli_query($db,"SELECT * FROM books where name like '%$_POST[search]%' ");
        if(mysqli_num_rows($q)==0)
        {
            echo "Sorry! no book found. try search again.";
        }

        else{
            echo "<table>";
            echo "<tr style='background-color: green;'>";
            //Table Header
            echo "<th>"; echo "ID"; echo "</th>";
            echo "<th>"; echo "Book-Name"; echo "</th>";
            echo "<th>"; echo "Authors Name"; echo "</th>";
            echo "<th>"; echo "Edition"; echo "</th>";
            echo "<th>"; echo "Status"; echo "</th>";
            echo "<th>"; echo "Quantity"; echo "</th>";
            echo "<th>"; echo "Department"; echo "</th>";
       
            echo "</tr>";
       
            while($row=mysqli_fetch_assoc($q))
            {
                echo "<tr>";
       
                echo "<td>";  echo $row['bid'];  echo "</td>";
                echo "<td>";  echo $row['name'];  echo "</td>";
                echo "<td>";  echo $row['authors'];  echo "</td>";
                echo "<td>";  echo $row['edition'];  echo "</td>";
                echo "<td>";  echo $row['status'];  echo "</td>";
                echo "<td>";  echo $row['quantity'];  echo "</td>";
                echo "<td>";  echo $row['department'];  echo "</td>";
       
                echo "</tr>";
            }
            echo "</table>";

        }
    }
//    -----------------------if button is not pressed-------------
    else{
        $res=mysqli_query($db,"SELECT * FROM `books`;");

        echo "<table>";
        echo "<tr style='background-color: royalblue;'>";
        //Table Header
        echo "<th>"; echo "ID"; echo "</th>";
        echo "<th>"; echo "Book-Name"; echo "</th>";
        echo "<th>"; echo "Authors Name"; echo "</th>";
        echo "<th>"; echo "Edition"; echo "</th>";
        echo "<th>"; echo "Status"; echo "</th>";
        echo "<th>"; echo "Quantity"; echo "</th>";
        echo "<th>"; echo "Department"; echo "</th>";
   
        echo "</tr>";
   
        while($row=mysqli_fetch_assoc($res))
        {
            echo "<tr>";
   
            echo "<td>";  echo $row['bid'];  echo "</td>";
            echo "<td>";  echo $row['name'];  echo "</td>";
            echo "<td>";  echo $row['authors'];  echo "</td>";
            echo "<td>";  echo $row['edition'];  echo "</td>";
            echo "<td>";  echo $row['status'];  echo "</td>";
            echo "<td>";  echo $row['quantity'];  echo "</td>";
            echo "<td>";  echo $row['department'];  echo "</td>";
   
            echo "</tr>";
        }
        echo "</table>";
   
    }


    if(isset($_POST['submit1']))
    {
        if(isset($_SESSION['login_user']))
        {
            mysqli_query($db,"INSERT INTO issue_book Values('$_SESSION[login_user]','$_POST[bid]','','','');");
            ?>
            <script>
            window.location="request.php"
            </script>
            <?php
        }
        else
        {
            ?>
            <script>
            alert("You must login to Request a book.");
            </script>
            <?php
        }
    }
?>
    
</body>
</html>