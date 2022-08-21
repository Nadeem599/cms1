<?php
require_once('connection_db.php');
if(!isset($_SESSION['email']))
{
    header('Location:login.php');
} 

$record_limit_on_page = 2;
if(isset($_POST['data'])){
    $page_id = $_POST['data']; 
} 


$offset = ((int)(($page_id - 1)*$record_limit_on_page));
        
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
        
        $toal_page_link = $total_record/$record_limit_on_page;

        for($i=1; $i <= $toal_page_link; $i++ ){
            $active = "";
            if( $page_id == $i){
                $active = 'active';
            }
            $page_array1[] .= "<a class='pagination_link {$active}' id='{$i}'  href='#'>{$i}</a>";
        }
        $main[]   = $page_array1;



       while($row = mysqli_fetch_assoc($result1))
       {
           $data[] = $row;
       }
       
        $main[]  = $data;
        print_r(json_encode($main));
      
?>






