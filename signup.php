
<?php 
include_once('connection_db.php');
if(isset($_SESSION['email']))
{
  header('Location:index.php');
}
include_once('header.php');
?>
<div class="container pt-5 mb-5" id="registration">
    <h2 class="text-center">Create an Account</h2>
    <div class="row">
        <div class="col-sm-6 offset-sm-3">
            <div id="message"></div>
        </div>
    </div>
    <div class="row">
    <div class="col-sm-6 offset-sm-3">
        <form action="" id="signup_data" class="shadow p-4 shadow-lg" method="POST">
            <div class="form-group">
                <i class="fa fa-user"></i>
                <label for="name" class="font-weight-bold">name</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="name">
            </div>
            <div class="form-group">
                <i class="fa fa-user"></i>
                <label for="email" class="font-weight-bold">Email</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="email">
                <small class="form-text">We will not share his email with any one </small>
            </div>
            <div class="form-group">
                <i class="fa fa-key"></i>
                <label for="pass" class="font-weight-bold">New Password</label>
                <input type="password" name="password" class="form-control" id="pass" placeholder="password">
            </div>
            <input type="submit" class="btn btn-danger btn-block shadow-sm" name="signup" value="SignUp">
            <small class="form-text">Lorem ipsum dolor sit amet.</small>
        </form>
    </div>
    </div>
</div>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/popover.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
    $("#signup_data").on("submit",function(e){
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
        url : "signup_check.php",
        type : "POST",
        data : formData,
        contentType : false,
        processData : false,
        success : function(data){
            var data2 = data;
            if(data2 == 'true')
              {
                window.location = "login.php"
              }
            else if(data2 == 'false')
              {
                $("#message").html('<div class="alert alert-warning mt-2 alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>Account is not created</div>');
              }
              else if(data2 == 'already'){
                $("#message").html('<div class="alert alert-warning mt-2 alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>Email is already used</div>'); 
              } 
            else
              {
                $("#message").html('<div class="alert alert-warning mt-2 alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>All fields are required</div>'); 
              }
        }
            });
        });
    });
</script>
</body>
</html>
