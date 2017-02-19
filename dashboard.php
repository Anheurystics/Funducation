<?php
// redirects to respective dashboards
include 'header.php';
if($_SESSION['logged_in'] == 0)
{
    header("Location: index.php");
}
include 'dashboard_'.$_SESSION['role'].'.php';
?>