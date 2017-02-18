<?php
include 'header.php';
if($_SESSION['logged_in'] == 0)
{
    echo '<meta http-equiv="refresh" content="0;index.php">';
}
include 'dashboard_'.$_SESSION['role'].'.php';
?>