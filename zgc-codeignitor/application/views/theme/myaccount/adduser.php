
<div class="page-body vertical-menu-mt">

          <div class="container-fluid">
            <div class="page-header">
              <div class="row">
                <div class="col-lg-6">
                  <h3><?php echo $title;?></h3>
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Home</a></li>
                    <li class="breadcrumb-item active"><?php echo $title;?></li>
                  </ol>
                </div>
                <div class="col-lg-6">
                </div>
              </div>
            </div>
          </div>

           <?php if ($this->session->flashdata('msg')) { ?><?php echo $this->session->flashdata('msg'); } ?>
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
                            <form action="<?php  echo base_url('users/adduser'); ?>" method="post" id="usersadduser" novalidate="false">
                            <?php
                              if(isset($users))
                              {
                                $usersdata = $users[0];

                                $username = $usersdata->username;
                                $password = $usersdata->password;
                                $email = $usersdata->email;
                                $user_type = $usersdata->user_type;
                                $first_name = $usersdata->first_name;
                                $last_name = $usersdata->last_name;
                                $phone = $usersdata->phone;
                                $readonly= "disabled";

                                if($title!='Copy User')
                                {
                                ?>
                                  <input type="hidden" name="id" value="<?php echo $usersdata->user_id; ?>" >   
                              <?php
                               }
                              }
                              else
                              {
                                $username = $email = $user_type= $first_name = $last_name = $phone = $readonly ='';
                              }
                          ?>
                            <div class="form-group row">
                              <label class="col-lg-3 col-form-label">Username:</label>
                              <div class="col-lg-9">
                                <input type="text" class="form-control"  autocomplete="off" name="username"  value="<?php echo $username; ?>" <?php echo $readonly; ?> >
                              </div>
                            </div>
                          <?php if(!isset($users)){?>
                              <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Password:</label>
                                <div class="col-lg-9">
                                  <input type="password" class="form-control"  name="password" >
                                </div>
                              </div>
                        <?php } ?>
                            <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Role:</label>
                              <div class="col-lg-9">
                                <select class="form-control form-control-select2" name="user_type" <?php echo $readonly; ?> onchange="getuserType(this.value)">
                                  <option value="">--Select User Type --</option>
                                  <?php 
                                    foreach($roles as $key=>$role){?>
                                      <option value="<?php echo $key; ?>" <?php echo ($user_type!='' && $user_type==$key)?'selected':''; ?>><?php echo $role; ?></option>
                                  <?php } ?>
                                </select>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-lg-3 col-form-label">First Name:</label>
                              <div class="col-lg-9">
                                <input type="text" class="form-control" name="first_name"  value="<?php echo $first_name; ?>">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-lg-3 col-form-label">Last Name:</label>
                              <div class="col-lg-9">
                                <input type="text" class="form-control" name="last_name"   value="<?php echo $last_name; ?>">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-lg-3 col-form-label">Email:</label>
                              <div class="col-lg-9">
                                <input type="email" class="form-control" name="email"  value="<?php echo $email; ?>">
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-lg-3 col-form-label">Phone:</label>
                              <div class="col-lg-9">
                                <input type="text" class="form-control" name="phone" onKeypress="addDashesphone(this)" minlength="12" maxlength="12" value="<?php echo $phone; ?>">
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
