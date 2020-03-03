      <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/css/style.css">

    <div class="page-wrapper">
      <div class="container-fluid p-0">
        <!-- login page start-->
        <div class="authentication-main mt-0">
          <div class="row">
            <div class="col-md-12">
              <div class="auth-innerright auth-bg">
                <div class="authentication-box">
                  <div class="mt-4">
                    <div class="card-body p-0">
                      <div class="cont text-center">
                        <div> 
                    
                          <form role="form" method="POST" id="forgetpassword" class="theme-form" action="<?php echo base_url('Site/resetpassword');?>">
    <?php if ($this->session->flashdata('msg')) {  echo $this->session->flashdata('msg');  } ?>
                      
                     
                      <h6 class="f-14 mt-4 mb-3">RESET YOUR PASSWORD</h6>
                      <div class="form-group">
                        <label class="col-form-label">Username</label>
                        <input type="text" class="form-control" placeholder="Your Username" name="username" 
          required="required" autocomplete="off">
                      </div>
                     
                      <div class="form-group form-row mb-2">
                        <div class="col-md-2">
                          <button class="btn btn-primary" type="submit">Done</button>
                        </div>


                        <div class="col-sm-8">
                                  <div class="text-left mt-2 m-l-20"><a class="btn-link text-capitalize" href="<?php echo base_url('login'); ?>">Login</a></div>
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
        <!-- login page end-->
      </div>
    </div>