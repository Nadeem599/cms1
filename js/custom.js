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