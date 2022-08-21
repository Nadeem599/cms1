<?php 
    require_once('connection_db.php');
    if(!isset($_SESSION['email']))
    {
        header('Location:login.php');
    }
    if(!empty($_POST["path_key"]))
    {
        $request_id = mysqli_real_escape_string($con, trim($_POST['path_key']));
        $request_id = htmlentities($request_id,ENT_QUOTES);
        $sql = " delete from complaints where t_id = '$request_id' ";
    if(true == $con->query($sql))
    {
        echo 1;
        exit;
    }
    else
    {
        echo 0;
        exit;
    }
}
?>



