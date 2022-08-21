<?php
require_once('connection_db.php');
if(!isset($_SESSION['email']))
{
    header('Location:login.php');
}
if(!empty($_POST['id']))
{
$image2 = $_FILES['image'];
$image_type2 = $image2['name'];


if(empty($_POST['id'])||empty($_POST['name'])||empty($_POST['email'])||empty($_POST['phone_number'])||empty($_POST['address'])||empty($_POST['message'])||empty($image_type2))
{
    echo 4;
    exit();
}
else
{
        $id =mysqli_real_escape_string($con, trim($_POST['id']));
        $id = htmlentities($id,ENT_QUOTES);
        $name =mysqli_real_escape_string($con, trim($_POST['name']));
        $name = htmlentities($name,ENT_QUOTES);
        $email =mysqli_real_escape_string($con, trim($_POST['email']));
        $email = htmlentities($email,ENT_QUOTES);
        $phone_number =mysqli_real_escape_string($con, trim($_POST['phone_number']));
        $phone_number = htmlentities($phone_number,ENT_QUOTES);
        $address =mysqli_real_escape_string($con, trim($_POST['address']));
        $address = htmlentities($address,ENT_QUOTES);
        $message =mysqli_real_escape_string($con, trim($_POST['message']));
        $message = htmlentities($message,ENT_QUOTES);
        $image = $_FILES['image'];
        $image_name_up = $image['name'];
        $image_size = $image['size'];
        $image_tmp_name = $image['tmp_name'];
        $image_type = $image['type'];
        if($image_type=="image/jpeg"||$image_type=="image/png"||$image_type=="image/jpg")
        {
            if($image_size<=2097152)
            { 
                move_uploaded_file($image_tmp_name,"image/".$image_name_up);  
                

                $sql = "update  complaints set t_name = '$name', t_email = '$email', t_phone = '$phone_number', t_address = '$address', t_message = '$message', t_img_name = '$image_name_up'  where t_id = '$id'";
                
               
            
                if($con->query($sql) == true)
                {
                    $records = array();
                    $sql10 = "select * from complaints where t_id = '$id'";
                    $result = $con->query($sql10);
                    if(mysqli_num_rows($result)> 0)
                    {
                        while($row = $result->fetch_assoc())
                        {
                        
                           $records = $row;
                         
                        }
                    echo json_encode($records);
                    }
                    else{
                        echo 1;
                    }

                }
                else
                {
                    echo 0;
                }
            }
            else
            {
                echo 2;
            }
        }
        else
        {
            echo 3;
        }
    }  
}
?>


