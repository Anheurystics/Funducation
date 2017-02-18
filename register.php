<!DOCTYPE html>
<?php
include "header.php";

if(!empty($_POST))
{
    if(!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirm']))
    {
        $email = mysqli_escape_string($conn, $_POST['email']);
        $username = mysqli_escape_string($conn, $_POST['username']);
        $password = mysqli_escape_string($conn, $_POST['password']);
        $confirm = mysqli_escape_string($conn, $_POST['confirm']);
        $role = $_POST['role'];

        $query = "select * from users where name = '" . $username . "'";
        if(mysqli_num_rows(mysqli_query($conn, $query)) == 0)
        {
            if($password == $confirm)
            {
                $query = sprintf("insert into users (name, email, password, role_id) values (%s, %s, %s, %d);", $username, $email, $password, $role);
                $user_insert = mysqli_query($conn, $query) or die(mysqli_error($conn)); 
                echo "Registered successfully!";
            }
            else
            {
                echo 'Passwords do not match!';
            }
        }
        else
        {
           
        }
    }
    else
    {
        echo 'Empty fields!';
    }
}
else
{
    if($_SESSION['logged_in'])
    {
        echo '<meta http-equiv="refresh" content="0;.">';
    }
}
?>
<html>
    <body>
        <div>
            <p>Sign Up</p>
        </div>
        <div>
            <form action="" method="post">
                <div>
                    <label for="username">Username</label>
                    <input name="username" type="text">
                </div>
                <div>
                    <label for="email">E-mail</label>
                    <input name="email" type="text">
                </div>
                <div>
                    <label for="password">Password</label>
                    <input name="password" type="password">
                </div>
                <div>
                    <label for="confirm">Confirm Password</label>
                    <input name="confirm" type="password">
                </div>
                <div>
                    <p>Registering as:</p>
                    <input type="radio" name="role" value="0" checked>Donor<br>
                    <input type="radio" name="role" value="1">Teacher<br>
                    <input type="radio" name="role" value="2">Principal<br> 
                </div>
                
                <div>
                    <input value="Register" type="submit">
                </div>
            </form>
        </div>
    </body>
</html>