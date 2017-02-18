<!DOCTYPE html>
<?php
include "../bh2017.php";

session_start();

$conn = mysqli_connect($mysql_host, $mysql_username, $mysql_password) or die("MySQL error: " . mysqli_connect_error());
mysqli_select_db($conn, "bh2017") or die("MySQL error: " . mysqli_error($conn));
?>  
<html>

    <head>
        
        <link rel="stylesheet" type="text/css" href="style.css">
        
        <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
    </head>

    <body>
        <top class="topcontainer">
        
            <left class="leftcontainer">
            
            </left>
            
            <name>
                <a href="./">TITLE OF APP</a>
            </name>
            
            <right class="rightcontainer">
                <?php 
                if(empty($_SESSION['LoggedIn']) || empty($_SESSION['Username'])) 
                {
                    ?>
                        <div id="login" class="button">
                            <p><a href="login.php">Login</a></p>
                        </div>

                        <div id="signup" class="button">
                            <p><a href="register.php">Sign Up</a></p>
                        </div>
                    <?php
                }
                else
                {
                   ?>
                        <div id="dashboard" class="button">
                            <p>Dashboard</p>
                        </div>
                    <?php              
                }
                ?>
            </right>
        </top>