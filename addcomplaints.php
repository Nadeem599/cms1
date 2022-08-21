<?php 

include_once('connection_db.php');
if(!isset($_SESSION['email']))
{
    header('Location:login.php');
}
if(!empty($_POST))
{
    $image1 = $_FILES['image'];
    $image_type1 = $image1['name'];
    
    if(empty($_POST['name'])||empty($_POST['email'])||empty($_POST['phone_number'])||empty($_POST['address'])||empty($_POST['message'])||empty($_FILES['image'])||empty($image_type1))
    {
       echo 4;
    }
    else
    {
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
        $image_name = $image['name'];
        $image_size = $image['size'];
        $image_tmp_name = $image['tmp_name'];
        $image_type = $image['type'];
        if($image_type=="image/jpeg"||$image_type=="image/png"||$image_type=="image/jpg")
        {
            if($image_size<=2097152)
            { 
                $email_session = $_SESSION['email'];
                $sql2 =  "select * from registration where p_email = '$email_session'";
                $result = $con->query($sql2); 
                $row = $result->fetch_assoc();
                $p_id = $row['p_id'];
                $sql = "insert into complaints(t_name,t_email,t_phone,t_address,t_message,t_img_name,p_id) values('$name','$email','$phone_number','$address','$message','$image_name','$p_id')";
                if($con->query($sql) == true)
                {
                    move_uploaded_file($image_tmp_name,"image/".$image_name);
                    echo 1;
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

