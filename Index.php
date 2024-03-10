<?php

$host = "localhost:3307";
$username = "root";
$password = "";
$database = "logindb";

$connections = mysqli_connect("localhost:3307", "root", "", "logindb"); 

    $Email=$Password="";
    $Emailerr=$passworderr="";
    

    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        if(empty($_POST["Email"]))
        {
            $Emailerr="Email is Required";
        }
        else
        {
            $Email=$_POST["Email"];
        }
        
        if(empty($_POST["Password"]))
        {
            $passworderr="Password is Required";
        }
        else
        {
            $Password = $_POST["Password"];
        }

        if($Email && $Password)
        {
            include("Connection.php");

            $check_email = mysqli_query($connections, "SELECT * FROM login_tbl WHERE email= '$Email'");
            $check_email_row = mysqli_num_rows($check_email);
                
            if($check_email_row>0)
            {
                while($row=mysqli_fetch_assoc($check_email))
                {
                    $db_password=$row["Password"];
                    $db_account_type=$row["Account_type"];

                    if($db_password == $Password)
                    {
                        if($db_account_type=="1")
                        {
                            echo"<script>window.location.href='adminhome.php';</script>";
                        }
                        else
                        {
                            echo"<script>window.location.href='userhome.php';</script>";
                        }
                    }
                    else
                    {
                        $passworderr = "Password is incorrect";
                    }
                }
            
            }
            else
            {
                $Emailerr="Email is not registered!";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"  rel="stylesheet"/>
    <link href="index.css" rel="stylesheet"/>
    <title>Application Management</title>
</head>
<body>
    <div class="form">
        <form action="" method="POST">
            <h1>Application Management</h1>
            <div class="input-box">
                <input name="Email" type="text" placeholder="Email" required>
                <i class="bx bxs-user"></i>
            </div>

            <div class="input-box">
                <input name="Password" type="password" placeholder="Password" required>
                <i class="bx bxs-lock-alt"></i>
            </div>

            <button type="Submit" value="Submit" class="btn">Login</button>

        </form>
    </div>
</body>
</html>


