<?php
session_start();
if(isset($_SESSION['email']))
{
unset($_SESSION['email']);
unset($_SESSION['name']);

header('Location:login.php');

}
else{
    header('Location:login.php');
}
?>