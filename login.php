<!DOCTYPE html>
<?php
include "header.php";

if(!empty($_POST))
{
    if(!empty($_POST['username']) && !empty($_POST['password']))
    {
        $username = mysqli_escape_string($conn, $_POST['username']);
        $password = mysqli_escape_string($conn, $_POST['password']);

        $query = sprintf("select * from users where name = '%s' and password = '%s'", $username, $password);
        if(mysqli_num_rows(mysqli_query($conn, $query)) == 1)
        {
            $_SESSION['username'] = $username;
            $_SESSION['logged_in'] = 1;
            echo '<meta http-equiv="refresh" content="0;.">';
        }
        else
        {
            echo 'wrong username or password!';
        }
    }
    else
    {
        echo 'Empty username or password!';
    }
}
else
{
    if(!empty($_SESSION['logged_in']) && $_SESSION['logged_in'])
    {
        echo '<meta http-equiv="refresh" content="0;.">';
    }
}
?>
<html>
    <body>
        <form action="" method="post">
            <div style="display:flex; flex-direction: column;align-items: center;">
                
                <div>
                    <p style="font-size: 300%">Login</p>
                </div>
            
                <div>
                    <label for="username">Username</label>
                    <input name="username" type="text">
                </div>
                <div>
                    <label for="password">Password</label>
                    <input name="password" type="password">
                </div>
                <div style="margin-top:40px;">
                
                    <input value="Login" type="submit">
                </div>
            </div>
        </form>
    </body>
    
</html>