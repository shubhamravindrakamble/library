<?php
include "navbar.php";
include "connection.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>
  body{
        background-image: url("feedback1.jpg");
    }
    h1{
        color:white;
        padding: 20px;
        font-size:30px;
        /* text-align:center; */
        padding-top:30px;
    }
    .box_feedback{
        height:300px;
        width: 900px;
        background-color:black;
        align-item:auto;
        margin-left:8%;
        margin-top:40px;
        opacity: 0.7;
        border-radius:10px;
    }
    form{
        padding-left :75px;

    }
    button{
        margin-left:280px;
        margin-top:25px;
        background-color:white;
        border-radius:10px;
    }
    textarea{
        background-color:gray;
        color:black;  
        opacity: 0.7;
        border-radius:8px;

    }
    h1:hover{
        color:red;
    }
    button:hover{
        color:white;
        background-color:red;
    }

    .f-table table,tr,td{
    height: 40px;
    width: 600px; 
    text-align:left;
    color:white;
}
.f-table td{
    background-color:black;
    border-color:black;
}

.f-table{
    width:100%;
    height: 300px;
    overflow:auto; 
}
#feedim{
        background-image:url("bookim.jpg");
    }


    
</style>

<body id="feedim">
<div class="box_feedback">
    <h1>If you have any suggetion or question please comment down below.</h1>
    <form action="" method="post">
        <textarea name="comment" type="text" placeholder="write something.." style="background-color:white" id="textarea" cols="100" rows="5" required></textarea><br>
        <button name="submit" >SUBMIT</button>
        <br><br><br><br>
   
<div class="f-table">
    <?php
    if(isset($_POST['submit']))
    {
        $sql="INSERT INTO `comments` VALUES('','$_POST[comment]');";
        if(mysqli_query($db,$sql))
        {
            $q="SELECT * FROM `comments` ORDER BY `comments`.`id` DESC";
            $res=mysqli_query($db,$q);

            echo "<table >";
            while ($row=mysqli_fetch_assoc($res)) 
            {
                echo "<tr>";
                    echo "<td>"; echo $row['comment']; echo "</td>";
                echo "</tr>";
            }
        }

    }
        
			else
			{
				$q="SELECT * FROM `comments` ORDER BY `comments`.`id` DESC"; 
					$res=mysqli_query($db,$q);

					echo "<table>";
					while ($row=mysqli_fetch_assoc($res)) 
					{
						echo "<tr>";
							echo "<td>"; echo $row['comment']; echo "</td>";
						echo "</tr>";
					}
			}
         echo"</table>";
      
     ?>
  </div>
  </div>
</body>
</html>