<?php

include_once('connection_db.php');
if(isset($_SESSION['email']))
{
  header('Location:index.php');
}
include_once('header.php');
?>

<div class="mt-5  text-center" style="font-size: 30px;">
  <i class="fa fa-stethoscope text-info"></i>
  <span>Complaints Management System</span>
</div>
<p style="font-size: 20px;" class=" mt-2 text-center">
  <i class="fa fa-user-secret text-danger"></i>
  Requester Area (demo)
</p>
<div class="row">
  <div class="col-md-4 offset-md-4 col-8 offset-2">
  <?php
if(isset($_SESSION['message2']))
{
?>
        <div class="alert alert-warning mt-2 alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>
<?php
    echo $_SESSION['message2'];
    unset($_SESSION['message2']);
?>
</div>
<?php
}
?>
  
  </div>
</div>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-4 offset-md-4 col-8 offset-2">
      <form action="" id="login_data" class="shadow shadow-lg p-4" method="POST">
        <div class="form-group">
          <i class="fa fa-user"></i>
          <label for="email">Email</label>
          <input type="email" class="form-control" name="email" id="email" placeholder="email">
          <small class="form-text">Do not share his email with anyone</small>
        </div>
        <div class="form-group">
          <i class="fa fa-key"></i>
          <label for="password">Password</label>
          <input type="password" class="form-control text-weight-bold" name="password" id="password"
            placeholder="password">
        </div>
        <div id="message"></div>
        <input type="submit"  role="button" id="click" name="login" class="btn btn-outline-danger btn-block shadow shadow-sm" value="Login">
      </form>
    </div>
  </div>
  <div class="text-center mt-2"><a href="../index.php" class="btn btn-info">Back to Home</a></div>
</div>
<div class="test"></div>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/popover.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
<script>
$(document).ready(function()
  {

   $('#click').click(function(event){
    event.preventDefault();
      var formData = $('#login_data').serialize()+'&login =login';

      $.ajax(
      {
        url : "login_check.php",
        type : "POST",
        data : formData,
        success : function(data)
        {
          
          if(data == 'true')
              {
                
              
                window.location = "index.php"
                
              }
              else if(data == 'false')
              {
                $("#message").html('<div class="alert false alert-warning mt-2 alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>Enter valid email and password</div>');

                setTimeout(function(){
                  $("div.false").hide('slow');
                }, 3000);
              } 
              else
              {
                $("#message").html('<div class="alert empty alert-warning mt-2 alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>All fields are required</div>'); 

                setTimeout(function(){
                  $("div.empty").hide('slow');
                }, 2000);
              }
        },
        error: function (params) {
          alert(params);
        }
      });
    });
    
    

    setTimeout(function(){
      $('#click').click(function(event){
      event.preventDefault();
      $('#password , #email').val('');
    });
    }, 5000);

  });
</script>
</body>
</html>
