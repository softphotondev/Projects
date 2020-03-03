<div class="page-body-wrapper">
<div class="page-body">
<div class="container-fluid">
  <div class="myaccount-profile">
    <div class="row">
     <?php $this->load->view(MYACCOUNT_PATH.'front/sidebar_account',['page' => $page]);?>

    <div class="col-lg-9 card">

<div class="row" style="margin-bottom:25px;">

<div class="col-lg-12">
<h4 class="order-card-title"> <?php echo $title; ?> </h4>

  <div class="details-wrap">                                    
    <div class="details-box orders">

       <?php if ($this->session->flashdata('msg')) { ?><?php echo $this->session->flashdata('msg'); } ?>

       <div id="message"></div>

  <form name="addform" id="updateform" method="POST" action="<?php echo base_url('changepassword'); ?>" enctype="multipart/form-data">

          <div class="row">

            <div class="col-md-12">
            <div class="col-md-4">
            <div class="form-group">
            <label>Old Password</label>
            <input type="text" class="form-control"  autocomplete="off" name="old_password" id="old_password" required >
            </div>
            </div>
            </div>
            <div class="col-md-12">          
            <div class="col-md-4">
            <div class="form-group">
            <label>New Password</label>
            <input type="text" class="form-control" name="password" id="password"  required>
            </div>
            </div>
            </div>
            <div class="col-md-12">
            <div class="col-md-4">
            <div class="form-group">
            <label>Confirm New Password</label>
            <input type="text" class="form-control" name="last_name" id="confirm_password"   required>
            </div>
            </div>
            </div>

                        </div>


                <div class="clearfix"><br></div>
                <div class="col-md-12">
                <div class="box-footer">
                <button type="button" class="btn btn-primary" onclick="submitnewpass()">Submit</button>
                </div>
                </div>
          
          </form>
        </div>

     </div>
     </div> 
    </div> 

      </div>
    </div>
  </div>
</div>
</div>
</div>

<script>
function submitnewpass()
{
  var oldpass = $('#old_password').val();
  var newpass = $('#password').val();
  var confirm_password = $('#confirm_password').val();


  if(oldpass=='' || newpass=='' || confirm_password=='')
  {
       $('#message').html('<div class="alert alert-danger text-left">Please Fill all the values</div>');  
  }
  else if(newpass!=confirm_password)
  {
        $('#message').html('<div class="alert alert-danger text-left">New password and Confirm password are not same</div>');  
  }
  else if((newpass==confirm_password) && oldpass!='')
  {
        $.post("<?php echo base_url('Myaccount/checkpassword'); ?>",{oldpass:oldpass,newpass:newpass},function(data) 
        {
           if(data=='nomatch')
           {
                $('#message').html('<div class="alert alert-danger text-left">Old password Not correct</div>');  
           }
           else
           {

            $('#old_password').val('');
            $('#password').val('');
            $('#confirm_password').val('');

  $('#message').html(' <div class="alert alert-success text-left">Password has been updated Successfully!</div>');
           }
        }); 
  }



}
</script>
