<?php
session_start();
$db_host = 'localhost';
$db_user = 'root';
$db_password = '';
$db_name = 'cms';
$con =  mysqli_connect($db_host,$db_user,$db_password,$db_name);
if(mysqli_connect_error($con))
{
    die('connection is failed').mysqli_connect_error($con);
}


?>