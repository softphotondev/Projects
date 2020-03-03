<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/css/style.css">
<style>
.cont {
    overflow: hidden;
    position: relative;
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
.login-whitebg .btn-primary { border-radius: 50px;
    font-weight: 600;
    font-size: 18px;
	margin-top:15px;
 }
	
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
	.login-content h2 {     
	font-size: 22px;
    font-weight: 900;
    padding-top: 25px; }
	
	}
	
.register-links { margin-bottom:20px; padding:0;}	
.register-links li { list-style: none;
    font-size: 14px;
    display: inline-block;
    padding: 5px;
    background: #bf2929;
    margin: 2px; }
	
.authentication-main .auth-innerright {
    background-size: cover;
    padding: 50px 0px;
}
	
</style>
<div class="page-wrapper grayBg">
  <div class="container-fluid p-0"> 
    <!-- login page start-->
    <div class="authentication-main mt-0">
      <div class="row">
        <div class="container">
          <div class="auth-innerright auth-bg">
            <div class="authentication-box">
                <div class="row user-style cont text-left <?php echo (isMobile())?'s--signup':''; ?>">
                  <div class="col-lg-6"> 
					  <div class="login-content">
						<h2>CREATE NEW ACCOUNT</h2>
							<ul class="register-links">
								<li> CREDIT SWEEPS </li>
								<li> CREDIT BOOST </li>
								<li> PERSONAL FUNDING </li>
								<li> BUSINESS FUNDING </li>
								<li> HOME PURCHASES </li>
								<li> AUTO PURCHASES </li>
							</ul>
					  </div>
                   </div>
                  <div class="col-lg-6 login-whitebg">
				   <?php if ($this->session->flashdata('msg')) {  echo $this->session->flashdata('msg');  } ?>
					<form method="POST" action="<?php echo base_url('createaccount');?>" class="theme-form">
					<h5 class="loginTitle">CREATE NEW ACCOUNT</h5>
					<h6>Already have an account? <a href="<?php echo base_url('login');?>">Log In</a></h6>
                          <div id="loadmessage"></div>
							<div class="form-row">
								<div class="col-md-12">
									<div class="form-group">
										<input type="text" class="form-control" name="referal_code" placeholder="Referral Code" required />
									</div>
                                </div>
								<div class="col-md-12">
                                  <div class="form-group"><input type="text" class="form-control" placeholder="Username" name="username" required="" /></div>
                                </div>
                                <div class="col-md-12">
                                  <div class="form-group"><input type="text" class="form-control" placeholder="First name" name="first_name" required="">
                                  </div>
                                </div>
                                <div class="col-md-12">
                                  <div class="form-group">
                                      <input type="text" class="form-control" placeholder="Last name" name="last_name"  required=""> 
                                  </div>
                                </div>
                              </div>
                              <div class="form-group">
                                  <input type="email" class="form-control" placeholder="Your email" name="email"  required=""> 
                              </div>

                               <div class="form-group">
                                 <input type="text" class="form-control" placeholder="Mobile No" name="phone" onKeypress="addDashesphone(this)" minlength="12" maxlength="12"  required="">
                              </div>

                               <div class="form-group">
                                <input type="password" class="form-control" placeholder="Create password" name="password" id="password"  required="">
                              </div>
								<p align="justify-content">By creating an account, you agree to our Terms of Service and have read and understood the Privacy Policy</p>

                              <div class="form-row">
                                <div class="col-sm-4">
                                  <button class="btn btn-primary btn-block btn-login" type="submit">Sign Up</button>
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
<!-- login page end-->
</div>
</div>
<script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script> 
<script type="text/javascript">
    $('.refreshCaptcha').on('click', function(){
    $.get('<?php echo base_url('site/refresh'); ?>', function(data){
        $('#captImg').html(data);
    });
});
    </script>
