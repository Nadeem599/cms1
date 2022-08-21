<?php
require_once('connection_db.php');
if(!isset($_SESSION['email']))
{
    header('Location:login.php');
} 


if(isset($_POST['data'])){
    $page_id = $_POST['data'];
    $record_limit_on_page = $page_id; 
    if($record_limit_on_page >= 2){
        $record_limit_on_page = $page_id + 1;
    }else{
        $record_limit_on_page = $page_id + 2;
    }
} 


$offset = 0;
        
        $data = array();
        $page_array1 = array();
        $main_data = array();
        $p_id = $_SESSION['relation_id']; 
        $sql2 =  "select * from complaints where p_id = '$p_id'";
        $result = $con->query($sql2); 
        $row = $result->fetch_assoc();
                  
        
        $sql = "SELECT * FROM complaints  where p_id = $p_id  limit {$offset}, {$record_limit_on_page}";
        $result1 = mysqli_query($con,$sql);

            $total_record = mysqli_num_rows($result);
        
            if($record_limit_on_page <= $total_record){
                $page_array1[] .= $record_limit_on_page;
                $main[]   = $page_array1;
            }
            
       while($row = mysqli_fetch_assoc($result1))
       {
           $data[] = $row;
       }
       
        $main[]  = $data;

        print_r(json_encode($main));
      
?>






