<?php
include_once('connection_db.php');
if(isset($_SESSION['email']))
{
  header('Location:index.php');
}
if(empty($_POST['email'])||empty($_POST['password']))
{
  $msg = 'All fields are required';
  echo  $msg;
}
else
{
  $password =mysqli_real_escape_string($con, trim($_POST['password']));
  $password = htmlentities($password,ENT_QUOTES);
// $password = password_hash($password,PASSWORD_BCRYPT);
  $email =mysqli_real_escape_string($con, trim($_POST['email']));
  $email = htmlentities($email,ENT_QUOTES);
  $sql = "select * from registration where p_email= '$email'";
  $result = mysqli_query($con , $sql); 
  $row = mysqli_fetch_assoc($result);
  $pass = $row['p_password'];
  if(mysqli_num_rows($result)> 0 && (password_verify($password,$pass)))
  {
  $_SESSION['email'] = $row['p_email'];
  $_SESSION['name'] = $row['p_name'];
  $_SESSION['relation_id'] = $row['p_id'];
  $_SESSION['message'] = 'Successfully ligin';
  echo  $msg = 'true';
  }
  else{
    echo $msg = "false";
  }
  
}

?>