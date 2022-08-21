<?php 
include_once('connection_db.php');
if(!isset($_SESSION['email']))
{
    header('Location:login.php');
}
include_once('header.php');
?>
<div>
<div class="container pt-2 mb-5" id="registration">
<button type="button" id="bt" class="btn btn-info btn-lg">See Complaints</button><br><br>
<a href="logout.php" class="btn btn-danger"><i class="fa fa-lock mr-1"></i>Logout</a>
<div class="row">
    <div class="col-sm-6 offset-sm-3">
<?php
if(isset($_SESSION['message']))
{
?>
<div class="alert alert-success mt-2 alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>
<?php
    echo $_SESSION['message'];
    unset($_SESSION['message']);
?>
</div>
<?php
}
?>
<h1 class="text-center p-2 bg-success text-white">Complaint Panel</h1>
<form action="" id="form_data" class="shadow p-4 shadow-lg" method="POST" >
    <div class="form-group">
        <i class="fa fa-user"></i>
        <label for="name" class="font-weight-bold">name</label>
        <input type="text" readonly  name="name" value="<?php 
        if(isset($_SESSION['name'])){ echo $_SESSION['name'];} 
        ?>" class="form-control" id="name" placeholder="name">
    </div>
    <div class="form-group">
        <i class="fa fa-envelope"></i>
        <label for="email" class="font-weight-bold">Email</label>
        <input type="email"  readonly name="email" value="<?php 
        if(isset($_SESSION['email'])){ echo $_SESSION['email'];} 
        ?>" class="form-control" id="email" placeholder="email">
        <small class="form-text">We will not share his email with any one </small>
    </div>
    <div class="form-group">
        <i class="fa fa-phone"></i>
        <label for="phone_number" class="font-weight-bold">Phone Number</label>
        <input type="text" name="phone_number" class="form-control" id="phone_number" placeholder="phone_number">
    </div>
    <div class="form-group">
        <i class="fa fa-map-pin"></i>
        <label for="address" class="font-weight-bold">Address</label>
        <input type="text" name="address" class="form-control" id="address" placeholder="address">
        <small class="form-text">We will not share his email with any one </small>
    </div>
    <div class="form-group">
        <i class="fa fa-file-text"></i>
        <label for="message" class="font-weight-bold">Message</label>
        <textarea rows="5" name="message" id="message" class="form-control" placeholder="message" cols="64"></textarea>
        <small class="form-text">We will not share his email with any one </small>
    </div>
    <div class="form-group">
        <i class="fa fa-file-image-o"></i>
        <label for="image" class="font-weight-bold">Upload Your Picture</label>
        <input type="file"  name="image" accept="image/*"  class="btn btn-primary " id="image">
    </div>
    <div id="res" ></div>
    <input type="submit" id="save-button" class="btn btn-danger btn-block shadow-sm" name="signup" value="SignUp">
    <small class="form-text">Lorem ipsum dolor sit amet.</small>
</form>
</div>
</div>
</div>
</div>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/popover.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
<script>
    $(document).ready(function(){
        $("#form_data").on("submit",function(e){
          e.preventDefault();
          var formData = new FormData(this);
        $.ajax({
            url : "addcomplaints.php",
            type : "POST",
            data : formData,
            contentType : false,
            processData : false,
            success : function(data)
            {
              var check_response = data;
                var answer = data;
                console.log(answer);

               
                  $("#res").show('slow');
               
                setTimeout(function(){
                  $("#res").hide('slow');
                }, 5000);
               
            
              if(answer == 3){
                $("#res").html('<div class="alert alert-warning mt-2 alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>image type is not good</div>'); 
                
              }
              else if(answer == 2){
                $("#res").html('<div class="alert alert-warning mt-2 alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>image size is not good</div>'); 
              } 
              else if(answer == 1)
              {
                $("#form_data")[0].reset();
                $("#res").html('<div class="alert alert-warning mt-2 alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>Complaint is created</div>');

              }
              else if(answer == 0)
              {
                $("#res").html('<div class="alert alert-warning mt-2 alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>Complaint is not created</div>');
              }
              else if(answer == 4)
              {
                $("#res").html('<div class="alert alert-warning mt-2 alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>All fields required</div>');
              }
              else
              {
                $("#res").html('<div class="alert alert-warning mt-2 alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>undefind error</div>'); 
              }
            }
        });
        });
        $("#bt").on("click", function(){
         window.location.href ="admin.php";
        });

        setTimeout(function(){
            $(".alert-success").hide('slow');
        }, 5000);
    });
</script>
</body>
</html>


