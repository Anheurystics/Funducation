<?php
// redirects to respective dashboards
require('header.php');
if($_SESSION['logged_in'] == 0)
{
    header("Location: index.php");
}
require('dashboard_'.$_SESSION["role"].'.php');
?>