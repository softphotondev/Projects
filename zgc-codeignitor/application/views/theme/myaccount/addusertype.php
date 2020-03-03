<div class="page-body vertical-menu-mt">
          <div class="container-fluid">
            <div class="page-header">
              <div class="row">
                <div class="col-lg-6">
                  <h3><?php echo $title;?></h3>
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active"><?php echo $title;?></li>
                  </ol>
                </div>
                <div class="col-lg-6">
                </div>
              </div>
            </div>
          </div>
           <?php if ($this->session->flashdata('msg')) { ?><?php echo $this->session->flashdata('msg'); ?><?php } ?> 
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-12 col-xl-12">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="card">
                      <div class="card-header">
                        <h5><?php echo $title;?></h5>
                      </div>
                      <div class="card-body">
            
            <form action="<?php  echo base_url('users/addusertype'); ?>" method="post" id="usersaddusertype" novalidate="false">
              <?php
          if(isset($user_type))
          {
              $user_type_name =  $user_type->user_type_name;
              $status = $user_type->status;
              
              if($title!='Copy User Types')
               {     
              ?>
  <input type="hidden" name="id" value="<?php echo $user_type->user_type; ?>" >             
              <?php
              }
          }
          else
          {
              $user_type_name =  '';
              $status = '';
          }
          
          ?>
                    <div class="form-group row">
                    <label class="col-lg-3 col-form-label">User Type:</label>
                    <div class="col-lg-9">
              <input type="text" class="form-control"  autocomplete="off" name="user_type_name" value="<?php echo $user_type_name; ?>">
                    </div>
                    </div>
                    
                    
                    <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Status:</label>
                    <div class="col-lg-9">
                    <select class="form-control form-control-select2" name="status" >
                    <option value="">--Select Status --</option>
                    <option value="1" <?php echo ($status!='' && $status==1)?'selected':''; ?>>Active</option>
                    <option value="0" <?php echo ($status!='' &&  $status==0)?'selected':''; ?>>Inactive</option>
                    </select>
                    </div>
                    </div>

                    <div class="card-footer">
                      <button class="btn btn-primary" type="submit">Submit</button>
                      <input class="btn btn-light" type="reset" value="Cancel">
                    </div>
                    
     
                </form>


                      </div>
                        
                    </div>
                  </div>
                 
                </div>
              </div>

       </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>
  