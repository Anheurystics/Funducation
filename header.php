<!DOCTYPE html>
<?php
// include file with db credentials
require("bh2017.php");

session_start();
// connect to mysql
$conn = mysqli_connect($mysql_host, $mysql_username, $mysql_password) or die("MySQL error: " . mysqli_connect_error());
mysqli_select_db($conn, "bh2017") or die("MySQL error: " . mysqli_error($conn));
?>  
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="./styles/style.css">
        <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
    </head>

    <body>
        <nav class="topcontainer">   
            <div class="site-title">
                <a href="./">FUNDUCATION</a>
            </div>
            <div class="rightcontainer" style="font-size:150%">
                <?php
                // show login and signup links if not logged in
                if(empty($_SESSION['logged_in']) || empty($_SESSION['username'])) 
                {
                    ?>
                        <div id="browse" class="button">
                            <p><a href="browse.php">Browse</a></p>
                        </div>
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
                        <div>
                            <p><?php echo 'Hello, '.$_SESSION['username'] ?></p>
                        </div>
                        <div id="dashboard" class="button">
                            <p><a href="dashboard.php">Dashboard</a></p>
                        </div>
                        <div id="browse" class="button">
                            <p><a href="browse.php">Browse</a></p>
                        </div>
                        <div id="signout" class="button">
                            <p><a href="logout.php">Sign Out</a></p>
                        </div>
                    <?php              
                }
                ?>
            </div>
        </nav>

        <div class="main-content">