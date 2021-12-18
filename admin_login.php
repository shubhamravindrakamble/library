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
    <title>student-login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<section class="section_student_login">
<div class="login_img">
 <br>
 <div class="box1">
   <h1 style="size: 50px;font-size: 40px; padding-top: 10px;">Library Management System</h1>
   <h1 style="font-size: 30px;">User Login Form</h1><br>
   <form name="login" action="" method="post">
   <input type="text" name="username" placeholder="Username" required><br><br>
   <input type="password" name="password" placeholder="Password" required><br><br><br>
   <button type="submit" name="submit"><b>LOGIN</b></button>
   </form>
   <br>
   <p>
       <a style="color: white;text-decoration:none;" href="update_password.php">Forgot password?</a>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;
       <a style="color: white;text-decoration:none;" href="registration.php">Sign up</a>
   </p>
 </div>

<?php

if(isset($_POST['submit']))
{
    $count = 0;
$res = mysqli_query($db , "SELECT * FROM `admin` WHERE username ='$_POST[username]' && password = '$_POST[password]';");
$count = mysqli_num_rows($res);

if($count==0)
{
    ?>
   
    <div class ="msg1">
        <strong>The username and password doen't match.</strong>    
    </div>
    <?php
}
else
{
    $_SESSION['login_user']=$_POST['username'];
    
    ?>
    <script>
    window.location = "index1.php";
    </script>
    <?php
}
}

?>
</div>
</section>

</body>
</html>