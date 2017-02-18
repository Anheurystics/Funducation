<!DOCTYPE html>
<?php
include "header.php";

function checktableuser($conn, $tablename, $username)
{
    $query = sprintf("select * from %s where name='%s'", $tablename, $username);
    return mysqli_num_rows(mysqli_query($conn, $query));
}

if(!empty($_POST))
{
    if(!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirm']))
    {
        $roles = array("donors", "teachers", "principals");

        $email = mysqli_escape_string($conn, $_POST['email']);
        $username = mysqli_escape_string($conn, $_POST['username']);
        $password = mysqli_escape_string($conn, $_POST['password']);
        $confirm = mysqli_escape_string($conn, $_POST['confirm']);
        $role = $roles[$_POST['role']];
        
        if(checktableuser($conn, 'donors', $username) == 0 
        && checktableuser($conn, 'principals', $username) == 0
        && checktableuser($conn, 'teachers', $username) == 0)
        {
            if($password == $confirm)
            {
                $query = sprintf("insert into %s (name, email, password) values ('%s', '%s', '%s');", $role, $username, $email, $password);
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
           echo 'Username is already taken!';
        }
    }
    else
    {
        echo 'Empty fields!';
    }
}
else
{
    if(!empty($_SESSION['logged_in']) && $_SESSION['logged_in'])
    {
        header("Location: index.php");
        exit();
    }
}
?>
<html>
    <body>
            <form action="" method="post">
                <div style="text-align: center">

                    <div>
                        <p style="font-size:300%">Sign Up</p>
                    </div>                   
                    <div class="form-container">
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
                    </div>
                    <div>
                        <p>Registering as:</p>
                        <input type="radio" name="role" value="0" checked>Donor<br>
                        <input type="radio" name="role" value="1">Teacher<br>
                        <input type="radio" name="role" value="2">Principal<br> 
                    </div>

                    <div style="margin-top:40px">
                        <input value="Register" type="submit">
                    </div>
                </div>
            </form>
    </body>
</html>