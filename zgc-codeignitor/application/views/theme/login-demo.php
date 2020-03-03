<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/css/style.css">
<style>
.cont {
    overflow: hidden;
    position: relative;
    width: 900px;
    margin: 0 auto 0;
    background: none;
    padding: 0;
    border-radius: 12px;
    height: auto;
	background:#d33;
}
.login-whitebg { background: #fff; padding: 30px; }
.loginTitle { font-weight: 600;
    margin-bottom: 15px;
    color: #161b30; }
	
.login-whitebg .form-control { border-radius: 0px; height: 45px; }
.login-whitebg .btn-primary { border-radius: 0;
    font-weight: 600;
    font-size: 18px;
    background-color: #161b30 !important;
    border-color: #161b30 !important; }
	
.login-whitebg .btn-info { border-radius: 0;
    font-weight: 600;
    font-size: 15px;
    background-color: #fff !important;
    color: #d33;
    padding-top: 9px;
    display: block; }
	
.user-style { display: flex;
    align-items: center;
    justify-content: center; }
	
.login-content { color: #fff;
    text-align: center;
    font-size: 20px;
    font-weight: 800;
    width: 100%; }
	
.login-content h3 { font-size: 40px;
    text-transform: uppercase;
    font-weight: 800; }
	
.signupLink { color: #1e73be;
    text-align: center;
    width: 100%;
    display: inline-block;
    font-weight: 700;
    font-size: 15px; }
	
.signupLink span { color:#000;}

@media (max-width:767px){
	.cont { width:100%; margin-top:25px; }
	.login-content h3 {     font-size: 25px;
    text-transform: uppercase;
    font-weight: 800;
    padding-top: 25px; }
	}
	
.btn-register {     background: #d33 !important;
    border: #d33 solid 1px !important;}
	
</style>
<div class="page-wrapper">
  <div class="container-fluid p-0"> 
    <!-- login page start-->
    <div class="authentication-main mt-0">
      <div class="row">
        <div class="col-md-12">
          <div class="auth-innerright auth-bg">
            <div class="authentication-box">
                <div class="row user-style cont text-left <?php echo (isMobile())?'s--signup':''; ?>">
                  <div class="col-lg-6"> 
                  <div class="login-content">
                  <h3> Login </h3>
                  <p> Get access to your orders</p>
                  </div>
                   </div>
                  <div class="col-lg-6 login-whitebg">
                    <form id="loginformnew" action="<?php echo base_url('Site/login');?>" method="POST" >
                      <?php if ($this->session->flashdata('msg')) {  echo $this->session->flashdata('msg');  } ?>
                      <h2 class="loginTitle">LOGIN</h2>
                      <h6>Hello, welcome to your account</h6>
                      <div id="loadmessagelogin"></div>
                      <div class="form-group">
                      <input class="form-control" type="text" name="username" id="username" 
                      placeholder="User Name" required autocomplete="off">
                      </div>
                      <div class="form-group">
                        <input class="form-control" type="password" placeholder="Your password" 
                        id="password" required name="password" autocomplete="off">
                      </div>





                      <div class="checkbox p-0">
                        <input id="checkbox1" type="checkbox">
                        <label for="checkbox1">REMEMBER ME</label>
						<a class="btn-info" style="float:right;" href="<?php echo base_url('resetpassword'); ?>">FORGOT PASSWORD? </a>
                      </div>
                      <div class="row">
                        <div class="form-group col-lg-6">
                          <button class="btn btn-primary btn-block" type="submit">LOGIN</button>
                        </div>
						 <div class="form-group col-lg-6"><a href="<?php echo base_url('register'); ?>"  class="btn btn-primary btn-block btn-register"> REGISTER</a></div>
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
<!-- login page end-->
</div>
</div>
<script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script> 
<script type="text/javascript">
     
$("#loginformnew").submit(function(e) {

    e.preventDefault(); // avoid to execute the actual submit of the form.

    var form = $(this);
    var url = form.attr('action');

    $.ajax({
           type: "POST",
           url: url,
           data: form.serialize(), // serializes the form's elements.
           success: function(data)
           {
                console.log(data);
                var obj = jQuery.parseJSON(data);
                console.log(obj);
                if(obj.status=='failure')
                $('#loadmessagelogin').html(obj.message);
                else
                { 
                    window.location.href=obj.message;
                }
               
           }
         });
}); 


   $('.refreshCaptcha').on('click', function(){
    $.get('<?php echo base_url('site/refresh'); ?>', function(data){
        $('#captImg').html(data);
    });
});
</script>          
