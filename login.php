<!DOCTYPE html>
<?php
include "header.php";

function checktableuser($conn, $tablename, $username, $password)
{
    $query = sprintf("select * from %s where name='%s' and password='%s'", $tablename, $username, $password);
    echo $query;
    return mysqli_num_rows(mysqli_query($conn, $query));
}

if(!empty($_POST))
{
    if(!empty($_POST['username']) && !empty($_POST['password']))
    {
        $username = mysqli_escape_string($conn, $_POST['username']);
        $password = mysqli_escape_string($conn, $_POST['password']);

        $query = sprintf("select * from users where name = '%s' and password = '%s'", $username, $password);

        $roles = array('donors', 'teachers', 'principals');
        $role = '';
        foreach($roles as $r)
        {
            if(checktableuser($conn, $r, $username, $password) == 1)
            {
                $_SESSION['username'] = $username;
                $_SESSION['logged_in'] = 1;
                echo '<meta http-equiv="refresh" content="0;.">';
                break;
            }          
        }

        echo 'wrong username or password!';
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
            <div>
                <p>Login</p>
            </div>
            
            <div>
                <div>
                    <label for="username">Username</label>
                    <input name="username" type="text">
                </div>
                <div>
                    <label for="password">Password</label>
                    <input name="password" type="password">
                </div>
                <input value="Login" type="submit">
            </div>
        </form>
    </body>
    
</html>