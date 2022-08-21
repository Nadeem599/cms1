<?php 
    require_once('connection_db.php');
    if(!isset($_SESSION['email']))
    {
        header('Location:login.php');
    }
    $bypass = '';
    $p_id =  $_SESSION['relation_id'];
    if(!empty($_POST["search"]))
    {
        $data = array();
        $request_search = mysqli_real_escape_string($con, trim($_POST['search']));
        $request_search = htmlentities($request_search,ENT_QUOTES);
        
$sql = " select * from complaints where ( t_name like '%{$request_search}%' or t_message like '%{$request_search}%') and p_id = $p_id ";
        $bypass++;
    } 
    else
    {
       echo 0;
       exit;
        
    }
    
    if(isset($bypass)){
    $result = mysqli_query($con,$sql);
    if(mysqli_num_rows($result)>0 )
    {
        while($row = mysqli_fetch_assoc($result))
        {
            $data[] = $row;
        }
      
     print_r(json_encode($data,JSON_PRETTY_PRINT));
    }
}
    

?>



