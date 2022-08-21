<?php
require_once('connection_db.php');
if(!isset($_SESSION['email']))
{
    header('Location:login.php');
}
if(!empty($_POST["cid_key"]))
    {
        
        $row1 = array();
        $request_id = mysqli_real_escape_string($con, trim($_POST['cid_key']));
        $request_id = htmlentities($request_id,ENT_QUOTES);
        $sql = " select * from complaints where t_id = '$request_id'";
        $result = $con->query($sql);
        if($result->num_rows> 0)
        {
            $row = $result->fetch_assoc();
            $row1 = $row;
            echo json_encode($row1);
        }
}    
        
?>
        
