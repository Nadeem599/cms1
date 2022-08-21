<?php
include_once('connection_db.php');
if(isset($_SESSION['email']))
{
  header('Location:index.php');
}
if(empty($_POST['name'])||empty($_POST['email'])||empty($_POST['password']))
{
    $msg = 'All fields are required';
    echo  $msg;
}
else
{
    $check_email = mysqli_real_escape_string($con,trim($_POST['email']));
    $check_email = htmlentities($check_email,ENT_QUOTES);
    $sql = "select * from registration where p_email = '$check_email'";
    $result = $con->query($sql);
    if ($result->num_rows > 0) 
    {
        $msg = 'already';
        echo  $msg;
    }    
    else
    {
        $name =mysqli_real_escape_string($con, trim($_POST['name']));
        $name = htmlentities($name,ENT_QUOTES);
        $password =mysqli_real_escape_string($con, trim($_POST['password']));
        $password = htmlentities($password,ENT_QUOTES);
        $password = password_hash($password,PASSWORD_BCRYPT);
        $email =mysqli_real_escape_string($con, trim($_POST['email']));
        $email = htmlentities($email,ENT_QUOTES);
        $sql = "insert into registration(p_name,p_email,p_password) values('$name','$email','$password')";
        if($con->query($sql)== true)
        {
            $_SESSION['message2'] = 'sccessfully account is created login to move';
            echo $msg = 'true';
        }
        else
        {
            echo $msg = 'false';
        }
    }
}
?>
