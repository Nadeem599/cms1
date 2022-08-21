<?php
require_once('connection_db.php');
if(!isset($_SESSION['email']))
{
  header('Location:login.php');
}
include_once('header.php');
?>

<div class=" mb-5 mt-1 mx-2">
<h1 class="text-center p-2 bg-success text-white">Admin Panel</h1>
<a href="logout.php" class="btn btn-danger"><i class="fa fa-lock mr-1"></i>Logout</a>
<input type="text" name="search"  id="search" placeholder="search">
<div id="message"></div>
<p class="bg-danger text-center text-white mt-3 p-2 mb-0">All Product details</p>
<div id="table">
<table class="table bg-light table-bordered table-hover table-sm  table-striped">
  <thead>
    <tr>
    <th>Sr no.</th><th>Name</th><th>Email</th><th>Phone no.</th><th>Address</th><th>Message</th><th>Picture Name</th><th>Picture</th><th>Action</th>
    </tr>
  </thead>
  <tbody id="intable"></tbody>
</table>
<div class="pagination" id="pagination">
  
</div>
<div><a href="" id="" data-value="0"  class="btn btn-danger btn-large load_data">Load More</a></div>
</div>
<!-- Modal -->
<div id="myModal"  role="dialog">
  <div class="modal-dialog">
<!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title">Update the Complaint</h4>
        <button type="button"  class="close" data-dismiss="">&times;</button>
     </div>
      <div  class="modal-body">
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
    <input type="text" name="id" class="form-control" id="hidden" placeholder="hidden">
    <div class="form-group">
        <i class="fa fa-phone"></i>
        <label for="phone_number" class="font-weight-bold">Phone Number</label>
        <input type="text" name="phone_number" class="form-control" id="phone_number" placeholder="phone_number">
    </div>
    <div class="form-group">
        <i class="fa fa-map-pin"></i>
        <label for="address" class="font-weight-bold">Address</label>
        <input type="text" name="address" class="form-control" id="address" placeholder="address">
    </div>
    <div class="form-group">
        <i class="fa fa-file-text"></i>
        <label for="message" class="font-weight-bold">Message</label>
        <textarea rows="5" name="message" id="message" class="form-control" placeholder="message" cols="64"></textarea>
    </div>
    <div class="form-group">
        <i class="fa fa-file-image-o"></i>
        <img src="" id="dif" height="100px" widght="100px"  alt="image" />
        <label for="image" class="font-weight-bold">Upload Your Picture</label>
        <input type="file"  name="image" accept="image/*"  class="btn btn-primary " id="image">
    </div>
    <div id="res" ></div>
    <input type="button" id="save-button" class="btn btn-danger btn-block shadow-sm" name="signup" value="SignUp">
    
</form>
      <div id="res"></div>
      </div>
      <div class="modal-footer">
        <button type="button" id="close_btn" class="btn close btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</div>

<div class="row">
  <div class="col-md-4">
    <div class="thumbnail imgs">
        <img src="image/testimonial-1.png" class="pop" alt="Lights" style="width:50% height:50%">
        <div class="caption">
        </div>
      </a>
    </div>
  </div>
  <div class="col-md-4">
    <div class="thumbnail imgs">
        <img src="image/testimonial-2.png" class="pop" alt="Nature" style="width:50% height:50%">
        <div class="caption">
        </div>
      </a>
    </div>
  </div>
  <div class="col-md-4">
    <div class="thumbnail imgs">
        <img src="image/testimonial-1.png" class="pop" alt="Fjords" style="width:50% height:50%">
        <div class="caption">
        </div>
      </a>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" style="width: 100%;" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <a class="nex" href="#" > Next </a> <a class="pre" href="#" > Pre </a>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body carousel-inner" id="">
      <img src="" class="imagepreview" id="modal_image" style="width: 100%;">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/popover.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script>
        var id;
        $('.thumbnail').on('click', function() {
          var idx = $(this).parent().index();
          id = parseInt(idx);
          //console.log(id);
          $('.imagepreview').attr('src', $(this).find('img').attr('src'));
          $('#imagemodal').modal('show');
          $(".carousel-inner").attr('id', id); // slide carousel to selected
        });

        $('.nex').on('click', function() {
          var id = $(".carousel-inner").attr('id');
          console.log(id);
          id++; //increment
          console.log(id);
          //console.log($('.imgs').length);
          if (id < $('.imgs').length) {
            //get id find src
            $('.pre').attr("disabled","disabled").css("background-color","green");
            var next_image = $('.imgs').eq(id).find('img').attr('src');
            $('.imagepreview').attr('src', next_image); //add same
            $(".carousel-inner").attr('id', id);
          }
          else{
            $('.nex').attr("disabled","disabled").css("background-color","red");
          }
        });
        $('.pre').on('click', function() {
          var id = $(".carousel-inner").attr('id');
          console.log(id);
          id--; //increment
          console.log(id);
          if (id >=0) {
            $('.nex').attr("disabled","disabled").css("background-color","green");
            var next_image = $('.imgs').eq(id).find('img').attr('src');
            $('.imagepreview').attr('src', next_image); //add same
            $(".carousel-inner").attr('id', id);;
          }
          else{
            $('.pre').attr("disabled","disabled").css("background-color","red");
          }
        });

    $(document).ready(function(){
     load_data();
       function load_data(data = 1){
          $.ajax({
            url : 'selectcomplaints.php',
            type : 'POST',
            data: {data : data},
            success: function(data){
            //  console.log(data);
             var res = jQuery.parseJSON(data);
            var  res1 = res['0'];
            var  res2 = res['1'];

             var current_record = "";
              $.each(res1 , function(index, value){
                if(res1.length > index){
                  current_record  += value;
                }
                $('#pagination').html(current_record);
                
              });

              
              if(res2){
                $('#intable').empty();
                $.each(res2 ,function(i, value){
                 data = '<tr><td>' +value.t_id+'</td><td>' +value.t_name+'</td><td>' +value.t_email+'</td><td>' +value.t_phone+'</td><td>' +value.t_address+'</td><td>' +value.t_message+'</td><td>' +value.t_img_name+'</td><td><img height="100px" width="100px" src="image/'+value.t_img_name +'" /></td><td><input type="button" data-id ="'+ value.t_id +'" value="Delete" name ="delete" class="btn btn-danger"  id="delete"><input data-id ="'+ value.t_id +'" type="button" name ="edit" class="btn btn-info" value="edit" id="edit"></td><tr>';
                 $('#intable').append(data);
                });
              }
            }
          });
        }
       
        load_more();
        function load_more(data = 0){
          $.ajax({
            url : 'load_more.php',
            type : 'POST',
            data: {data : data},
            success: function(data){
              
             var res = jQuery.parseJSON(data);
            var  res1 = res['0'];
            var  res2 = res['1'];

             var current_record = "";
              $.each(res1 , function(index, value){
               // console.log(value);
                $('.load_data').attr('id', value);
              });

              
              if(res2){
                $('#intable').empty();
                $.each(res2 ,function(i, value){
                 data = '<tr><td>' +value.t_id+'</td><td>' +value.t_name+'</td><td>' +value.t_email+'</td><td>' +value.t_phone+'</td><td>' +value.t_address+'</td><td>' +value.t_message+'</td><td>' +value.t_img_name+'</td><td><img height="100px" width="100px" src="image/'+value.t_img_name +'" /></td><td><input type="button" data-id ="'+ value.t_id +'" value="Delete" name ="delete" class="btn btn-danger"  id="delete"><input data-id ="'+ value.t_id +'" type="button" name ="edit" class="btn btn-info" value="edit" id="edit"></td><tr>';
                 $('#intable').append(data);
                });
              }
            }
          });
        }











       $(document).on('click','#delete',function(){
          if(confirm('Do you want to delete data ?')){
            var data = $(this).data('id');
          var el = this;
          $.ajax({
            url: 'deletecomplaint.php',
            type : 'POST',
            data : {path_key : data},
            success : function(data){
             // console.log(data);
              if(1 == data){
                $(el).closest('tr').fadeOut();
              }
              else{
               
                }
              
            }
          })
          }
       });

       $(document).on('click','#edit',function(){
         $('input#edit').removeClass("dynamic")
        $(this).addClass('dynamic');
          var data = $(this).data('id');
          $.ajax({
            url: 'editcomplaint.php',
            type : 'POST',
            data : {cid_key : data},
            success : function(data){
              var edata = jQuery.parseJSON(data); 
              if(edata){
                  $('#hidden').val(edata.t_id);
                  $('#phone_number').val(edata.t_phone);
                  $('#address').val(edata.t_address);
                  $('textarea').text(edata.t_message);
                  var src = "image/"+edata.t_img_name;
                  $('img#dif').attr('src', src);
                  $('#myModal').fadeIn();
          
              }
              
            }
          })
      });

      $('.close').click(function(){
        $('#myModal').fadeOut();

      });



      $("#save-button").click(function(){
        
          var formData = new FormData(document.getElementById("form_data"));
        
        $.ajax({
            url : "updatecomplaint.php",
            type : "POST",
            data : formData,
            contentType : false,
            processData : false,
            success : function(data)
            {
             
                var value = data;
               
                  $("#res").show('slow');
               
                setTimeout(function(){
                  $("#res").hide('slow');
                }, 5000);
  if(value == 0)
  {
    $("#res").html('<div class="alert alert-warning mt-2 alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>Complaint is not created</div>');
    $("#form_data")[0].reset();
  }
  else if(value == 1)
  {
    $("#res").html('<div class="alert alert-warning mt-2 alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>Not have related record</div>');
    $("#form_data")[0].reset();
  }
  else if(value == 2){
    $("#res").html('<div class="alert alert-warning mt-2 alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>image size is not good</div>'); 
    $("#form_data")[0].reset();
  } 
  else if(value == 3){
    $("#res").html('<div class="alert alert-warning mt-2 alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>image type is not good</div>'); 
    $("#form_data")[0].reset();
  }
  
  else if(value == 4)
  {
    $("#res").html('<div class="alert alert-warning mt-2 alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>All fields required</div>');
    $("#form_data")[0].reset();
  }
  else
  {
    
    var  value = jQuery.parseJSON(data);
    $("#res").html('<div class="alert alert-warning mt-2 alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>Complaint is Updated</div>'); 

  var  data = '<td>' +value.t_id+'</td><td>' +value.t_name+'</td><td>' +value.t_email+'</td><td>' +value.t_phone+'</td><td>' +value.t_address+'</td><td>' +value.t_message+'</td><td>' +value.t_img_name+'</td><td><img height="100px" width="100px" src="image/'+value.t_img_name +'" /></td><td><input type="button" data-id ="'+ value.t_id +'" value="Delete" name ="delete" class="btn btn-danger"  id="delete"><input data-id ="'+ value.t_id +'" type="button" name ="edit" class="btn btn-info" value="edit" id="edit"></td>';

   $("input.dynamic").closest('tr').eq(0).html(data);
   $("#form_data")[0].reset();
    $('#myModal').slideUp();
    
  }
               
            }
        });
        });


    $(document).on('keyup','#search',function(){

      var data =  $('#search').val();
     
        $.ajax({
        url: 'search_record.php',
        method : 'POST',
        data:{ search : data },
        success:function(data){
        //  console.log(data);
          var data ;
            var  res = jQuery.parseJSON(data);
          if(0 == res ){
            $('#intable').empty();
            load_data();
              }
            else{
              $('#intable').empty();
                $.each(res ,function(i, value){
                 data = '<tr><td>' +value.t_id+'</td><td>' +value.t_name+'</td><td>' +value.t_email+'</td><td>' +value.t_phone+'</td><td>' +value.t_address+'</td><td>' +value.t_message+'</td><td>' +value.t_img_name+'</td><td><img height="100px" width="100px" src="image/'+value.t_img_name +'" /></td><td><input type="button" data-id ="'+ value.t_id +'" value="Delete" name ="delete" class="btn btn-danger"  id="delete"><input data-id ="'+ value.t_id +'" type="button" name ="edit" class="btn btn-info" value="edit" id="edit"></td><tr>';
                 $('#intable').append(data);
                });
            }
        }
      });

    });


    $(document).on('click','.pagination_link',function(){
      var current_num =  $(this).attr('id');
      load_data(current_num);

    });

    $(document).on('click','.load_data',function(e){
        e.preventDefault();
     var load_data =  $(this).attr('id');
     load_more(load_data);
   
    });
  
  });

</script>
</body>
</html>


